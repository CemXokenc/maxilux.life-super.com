<?php
session_start();
include_once(dirname(__FILE__)."/kernel/cms.php");
include_once(dirname(__FILE__)."/site/route.php");
include_once(dirname(__FILE__)."/site/class/system_classes.php");


use Core\Service\AjaxRoute as RouteService;

echo (new RouteService())->route($_REQUEST);