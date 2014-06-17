<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 5/13/14
 * Time: 9:49 PM
 */
require 'config.php';
require 'functions.php';

$config = new Config(array(
    'Joomlacreator' => 'package_name',
    'Magazine' => 'module_name',
    'community' => 'code_pool',
    '0.0.1' => 'version',
    'Page' => 'model_name',
), './tpl', './src2', true);
$files = array();
getFiles($config->getBaseDir(), $files);
replace($files, $config);