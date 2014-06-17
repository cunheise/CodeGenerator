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