<?php
$appsDirectory = 'apps/';
$apps = [];

foreach (scandir($appsDirectory) as $file) {
  if ($file !== '.' && $file !== '..') {
    $pathInfo = pathinfo($file);
    $fileExtension = strtolower($pathInfo['extension']);
    
    // Check if the file is an HTML file
    if ($fileExtension === 'html') {
      $appName = $pathInfo['filename'];
      $appImagePath = $appsDirectory . $appName . '.png'; // Assume image is in the same directory with .png extension

      // Check if the image file exists, otherwise use a default image
      if (!file_exists($appImagePath)) {
        $appImagePath = 'default-app-image.png';
      }

      $apps[] = [
        'title' => $appName,
        'image' => $appImagePath,
        'path' => $appsDirectory . $file
      ];
    }
  }
}

header('Content-Type: application/json');
echo json_encode($apps);
?>
