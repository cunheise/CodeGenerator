<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/18/14
 * Time: 12:00 AM
 */
require 'config.php';
require 'functions.php';

$configObj = new Config(array(
    'Joomlacreator' => 'package_name',
    'Slideshow' => 'module_name',
    'community' => 'code_pool',
    '0.0.1' => 'version',
    'Item' => 'model_name',
    'Image' => 'attribute_name_1',
    'Url' => 'attribute_name_2',
));
$baseDir = './src';
$releaseDir = './template';
$files = array();
$start = strlen(rtrim($baseDir, DIRECTORY_SEPARATOR)) + 1;
getFiles($baseDir, $files);
$paths = $files;
$config = $configObj->__toArray();
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