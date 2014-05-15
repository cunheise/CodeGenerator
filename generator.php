<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 5/13/14
 * Time: 9:49 PM
 */
$baseDir = './src';
$releaseDir = './template';

$baseDir = './template';
$releaseDir = '/home/nathan/Sites/kjl';
$files = array();
function getFiles($dir, &$files)
{
    foreach (scandir($dir) as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $file = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($file)) {
            getFiles($file, $files);
        } else {
            array_push($files, $file);
        }
    }
}

$start = strlen(rtrim($baseDir, DIRECTORY_SEPARATOR)) + 1;
getFiles($baseDir, $files);
$config = require 'config.php';
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