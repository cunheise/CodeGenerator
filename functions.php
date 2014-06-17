<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/18/14
 * Time: 12:03 AM
 */
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

function replace($files, $config)
{
    $data = $config->__toArray();
    foreach ($files as $file) {
        $content = file_get_contents($file);
        array_walk($data, function ($v, $k) use (&$content) {
            $content = str_replace($k, $v, $content);
        });
        array_walk($data, function ($v, $k) use (&$file) {
            $file = str_replace($k, $v, $file);
        });
        $path = str_replace($config->getBaseDir(), $config->getReleaseDir(), $file);
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($path, $content);
    }
}