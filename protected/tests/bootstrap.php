<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../../../../XAMPP/xamppfiles/htdocs/apptestlab/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
