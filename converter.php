<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/18/14
 * Time: 12:00 AM
 */
require 'config.php';
require 'functions.php';

$config = new Config(array(
    'Joomlacreator' => 'package_name',
    'Slideshow' => 'module_name',
    'community' => 'code_pool',
    '0.0.1' => 'version',
    'Item' => 'model_name',
));
$files = array();
getFiles($config->getBaseDir(), $files);
replace($files, $config);
