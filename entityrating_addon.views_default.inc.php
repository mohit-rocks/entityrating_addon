<?php
function entityrating_addon_views_default_views() {
	$view = new view;
	$view->name = 'ratingaddone';
	$view->description = '';
	$view->tag = 'default';
	$view->base_table = 'node';
	$view->human_name = 'Rating Addon';
	$view->core = 7;
	$view->api_version = '3.0-alpha1';
	$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
	
	/* Display: Master */
	$handler = $view->new_display('default', 'Master', 'default');
	$handler->display->display_options['title'] = 'Articles';
	$handler->display->display_options['access']['type'] = 'perm';
	$handler->display->display_options['cache']['type'] = 'none';
	$handler->display->display_options['query']['type'] = 'views_query';
	$handler->display->display_options['query']['options']['query_comment'] = FALSE;
	$handler->display->display_options['exposed_form']['type'] = 'basic';
	$handler->display->display_options['pager']['type'] = 'full';
	$handler->display->display_options['pager']['options']['items_per_page'] = '10';
	$handler->display->display_options['style_plugin'] = 'default';
	$handler->display->display_options['row_plugin'] = 'node';
	/* Field: Content: Title */
	$handler->display->display_options['fields']['title']['id'] = 'title';
	$handler->display->display_options['fields']['title']['table'] = 'node';
	$handler->display->display_options['fields']['title']['field'] = 'title';
	$handler->display->display_options['fields']['title']['label'] = '';
	$handler->display->display_options['fields']['title']['alter']['alter_text'] = 0;
	$handler->display->display_options['fields']['title']['alter']['make_link'] = 0;
	$handler->display->display_options['fields']['title']['alter']['absolute'] = 0;
	$handler->display->display_options['fields']['title']['alter']['word_boundary'] = 0;
	$handler->display->display_options['fields']['title']['alter']['ellipsis'] = 0;
	$handler->display->display_options['fields']['title']['alter']['strip_tags'] = 0;
	$handler->display->display_options['fields']['title']['alter']['trim'] = 0;
	$handler->display->display_options['fields']['title']['alter']['html'] = 0;
	$handler->display->display_options['fields']['title']['hide_empty'] = 0;
	$handler->display->display_options['fields']['title']['empty_zero'] = 0;
	$handler->display->display_options['fields']['title']['link_to_node'] = 1;
	/* Sort criterion: Content: Popularity (field_article_current_rating) */
	$handler->display->display_options['sorts']['field_article_current_rating_value']['id'] = 'field_article_current_rating_value';
	$handler->display->display_options['sorts']['field_article_current_rating_value']['table'] = 'field_data_field_article_current_rating';
	$handler->display->display_options['sorts']['field_article_current_rating_value']['field'] = 'field_article_current_rating_value';
	$handler->display->display_options['sorts']['field_article_current_rating_value']['order'] = 'DESC';
	$handler->display->display_options['sorts']['field_article_current_rating_value']['exposed'] = TRUE;
	$handler->display->display_options['sorts']['field_article_current_rating_value']['expose']['label'] = 'Popularity';
	/* Filter criterion: Content: Published */
	$handler->display->display_options['filters']['status']['id'] = 'status';
	$handler->display->display_options['filters']['status']['table'] = 'node';
	$handler->display->display_options['filters']['status']['field'] = 'status';
	$handler->display->display_options['filters']['status']['value'] = 1;
	$handler->display->display_options['filters']['status']['group'] = 0;
	$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
	/* Filter criterion: Content: Type */
	$handler->display->display_options['filters']['type']['id'] = 'type';
	$handler->display->display_options['filters']['type']['table'] = 'node';
	$handler->display->display_options['filters']['type']['field'] = 'type';
	$handler->display->display_options['filters']['type']['value'] = array(
			'article' => 'article',
	);
	
	/* Display: Page */
	$handler = $view->new_display('page', 'Page', 'page');
	$handler->display->display_options['path'] = 'articles';
	$handler->display->display_options['menu']['type'] = 'normal';
	$handler->display->display_options['menu']['title'] = 'Articles';
	$handler->display->display_options['menu']['name'] = 'main-menu';
	
}