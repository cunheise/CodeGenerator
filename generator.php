<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 5/13/14
 * Time: 9:49 PM
 */
require 'config.php';
require 'functions.php';

$configObj = new Config(array(
    'Joomlacreator' => 'package_name',
    'Celebrity' => 'module_name',
    'community' => 'code_pool',
    '0.0.1' => 'version',
    'Profile' => 'model_name',
    'Photo' => 'attribute_name_1',
    'Fullname' => 'attribute_name_2',
));
$baseDir = './template';
$releaseDir = '/home/nathan/Sites/kjl';
$files = array();
$start = strlen(rtrim($baseDir, DIRECTORY_SEPARATOR)) + 1;
getFiles($baseDir, $files);
$config = $configObj->__toArray(true);
$paths = $files;
foreach ($paths as &$file) {
    $content = file_get_contents($file);
    array_walk($config, function ($v, $k) use (&$content) {
        $content = str_replace($k, $v, $content);
    });
    array_walk($config, function ($v, $k) use (&$file) {
        $file = str_replace($k, $v, $file);
    });
    $path = str_replace($baseDir, $releaseDir, $file);
    $dir = dirname($path);
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents($path, $content);
}