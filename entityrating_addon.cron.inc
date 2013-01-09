<?php

/**
 * Helper function for the cron hook.
 */
function _entityrating_addon_cron(){
  //Search for all articles that are not printed, and add them to the queue if they
  //do not exist.
  $result = db_select('node', 'n')
          ->fields('n', array('nid', 'type'))
          ->fields('rating_queue', array('rating_id'));
  $result->leftJoin('entity_ext_rating_queue', 'rating_queue', "n.nid = rating_queue.entity_id AND rating_queue.rating_id = CONCAT('n.type_',n.nid)");
  //We add the article in the queue for this week if it is not already added and
  //it has not any assigned issue (it has already been published).
  $result->condition('rating_queue.rating_id', NULL, "IS");
  $result = $result->execute();
  foreach ($result as $data){
    entityrating_addon_add_to_queue($data->nid);
  }
}

/**
 * Updates the current rating fields for all articles.
 */
function _entityrating_addon_entity_ext_rating_updates(){
	print 'coming';
  //Update the current_rating field for all articles.
  //@todo
  /**
   * Use function statistics_get($nid) to get the access stetistics of the node.
   * Use if and make new rank according to facebook share, twitter share and node statistics.
   * @var unknown_type
   */
  $result = db_select('node', 'n')
          ->fields('n', array('nid', 'vid', 'type'))
          ->fields('fdfacr', array('field_article_current_rating_value'))
          ->fields('rating_total', array('rating'));
  $result->join('entity_ext_rating_total', 'rating_total', "n.nid = rating_total.entity_id AND rating_total.rating_id = CONCAT(n.type,'_',n.nid)");
  $result->leftJoin('field_data_field_article_current_rating', 'fdfacr', 'fdfacr.entity_id = n.nid');
  $result = $result->execute();
  //Make custom queries for speed.
  foreach ($result as $data){
    //TO DO: Use some general function, as it is
    //used in user_stats module
    // We are going to fetch the statistics for the node, which will have 50% weightage in calculation of rating of node.
    // statistic_get() will return array of three elements: [0]=totalcount, [1]=daycount, [2]=timestamp
  	$node_stat = statistics_get($data->nid);
  	$data->rating = $node_stat['totalcount']*0.5 + $data->rating*0.5;
    if ($data->field_article_current_rating_value != $data->rating){
      db_delete('field_data_field_article_current_rating')
        ->condition('entity_id', $data->nid)
        ->execute();
      db_insert('field_data_field_article_current_rating')
        ->fields(array(
            'entity_type' => 'node',
            'bundle' => $data->type,
            'deleted' => 0,
            'entity_id' => $data->nid,
            'revision_id' => $data->vid,
            'language' => 'und',
            'delta' => 0,
            'field_article_current_rating_value' => $data->rating
          ))->execute();
      db_delete('field_revision_field_article_current_rating')
        ->condition('entity_id', $data->nid)
        ->execute();
      db_insert('field_revision_field_article_current_rating')
        ->fields(array(
            'entity_type' => 'node',
            'bundle' => $data->type,
            'deleted' => 0,
            'entity_id' => $data->nid,
            'revision_id' => $data->vid,
            'language' => 'und',
            'delta' => 0,
            'field_article_current_rating_value' => $data->rating
          ))->execute();
      //Clear the cache for this field.
      cache_clear_all('field:node:'.$data->nid, 'cache_field');
    }
  }
}
