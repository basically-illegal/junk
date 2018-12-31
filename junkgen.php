<?php

$junktoloop = 1; // Number of times to add junk
$scan_location = "Source/Core/"; // Where to add junk
$file_extention = "cpp"; // File type to add junk to

echo "Basically Illegal's Junk\n";
echo "Scanning ".$scan_location.' for '.$file_extention . " files\n";

$files = scanAllDir($scan_location);

$currentLoop = 0;

while($currentLoop < $junktoloop){
    foreach($files as $file){
        $c_f_ext = substr($file, strlen($file) - strlen($file_extention));
        if($c_f_ext === $file_extention){
            addJunk($scan_location.$file);
        }
    }
    $currentLoop++;
}

echo "Junk Added";

function addJunk($file){
    $junk = htmlspecialchars_decode(strip_tags(file_get_contents("https://junkcode.gehaxelt.in/")));
    //$junk = str_replace(['#include <string>', '#include <iostream>'],"", $junk);
    file_put_contents($file, "\r\n".$junk."\r\n", FILE_APPEND);
    echo "Added junk to ".$file."\n";
}

function scanAllDir($dir) {
    $result = [];
    foreach(scandir($dir) as $filename) {
      if ($filename[0] === '.') continue;
      $filePath = $dir . '/' . $filename;
      if (is_dir($filePath)) {
        foreach (scanAllDir($filePath) as $childFilename) {
          $result[] = $filename . '/' . $childFilename;
        }
      } else {
        $result[] = $filename;
      }
    }
    return $result;
}
