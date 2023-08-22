<?php
$peopleDirectory = 'people/';
$people = [];

$validImageExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Add other valid image extensions

foreach (scandir($peopleDirectory) as $file) {
  if ($file !== '.' && $file !== '..') {
    $pathInfo = pathinfo($file);
    $fileExtension = strtolower($pathInfo['extension']);
    if (in_array($fileExtension, $validImageExtensions) && $pathInfo['extension'] !== 'html') {
      $personTitle = $pathInfo['filename'];
      $personImagePath = $peopleDirectory . $personTitle . '.' . $fileExtension;
      $defaultImagePath = 'default-image.jpg'; // Provide a default image if not found
      if (!file_exists($personImagePath)) {
        $personImagePath = $defaultImagePath;
      }
      $people[] = [
        'title' => $personTitle,
        'path' => $peopleDirectory . $personTitle . '.html', // Assuming HTML file has same name
        'image' => $personImagePath
      ];
    }
  }
}

header('Content-Type: application/json');
echo json_encode($people);

?>
