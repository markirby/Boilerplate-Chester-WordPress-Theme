<?php 
require_once(dirname(__FILE__).'/lib/chester/require.php');

$adminSettings = array(
	'customPostTypes' => array(
		array(
			'name' => 'gallery',
			'displayName' => 'Gallery',
			'pluralDisplayName' => 'Galleries',
			'enablePostThumbnailSupport' => true,
			'fieldBlocks' => array(
				'blockTitle' => 'Gallery Location',
				'fields' => array(
					array(
						'fieldName' => 'location',
						'labelTitle' => 'Location',
						'fieldType' => 'textField',
					),
					array(
						'fieldName' => 'map',
						'labelTitle' => 'Link to a map',
						'fieldType' => 'textField',
					),
				)
	    )
    )
  )
);

$adminController = new ChesterAdminController($adminSettings);

?>