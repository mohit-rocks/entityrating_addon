<?php

/**
 * @file
 *  The file contains the administration settings for this module.
 */

function entityrating_addone_admin_settings() {
	$form['entityrating_addone_content_type'] = array(
			'#type' => 'fieldset',
			'#title' => t('Select content type for Entity Rating'),
			'#description' => t('Select Yes for the content type on which you want to display external entity rating widget .'),
			'#collapsible' => TRUE,
			'#collapsed' => FALSE,
	);
	
	$node_types = _node_types_build()->names;
	foreach ($node_types as $node_type => $node_type_label) {
		$form['entityrating_addone_content_type']['entityrating_addone_content_type_value_' . $node_type] = array(
				'#type' => 'select',
				'#title' => $node_type_label,
				'#default_value' => variable_get('entityrating_addone_content_type_value_' . $node_type, 'yes'),
				'#options' => array('yes' => t('Yes'), 'no' => t('No')),
		);
	}
	return system_settings_form($form);
}