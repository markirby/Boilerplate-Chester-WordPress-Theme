<?php

require_once(dirname(__FILE__).'/mvc/controllers/site_controller.php');

$siteController = new SiteController();
$siteController->showPost();

?>