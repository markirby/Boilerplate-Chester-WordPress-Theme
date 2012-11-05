<?php
//require the site controller we just created
require_once(dirname(__FILE__).'/mvc/controllers/site_controller.php');

//init the site controller
$siteController = new SiteController();

//call the showPostPreviews function
$siteController->showPostPreviews();

?>