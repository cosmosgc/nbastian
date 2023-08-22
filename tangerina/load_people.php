<?php
$peopleDirectory = 'people/';
$people = [];

foreach (scandir($peopleDirectory) as $file) {
  if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'html') {
    $personTitle = pathinfo($file, PATHINFO_FILENAME);
    $personImagePath = $peopleDirectory . $personTitle . '.jpg'; // Change the image extension accordingly
    $personImagePath = file_exists($personImagePath) ? $personImagePath : 'default-image.jpg'; // Provide a default image if not found
    $people[] = [
      'title' => $personTitle,
      'path' => $peopleDirectory . $file,
      'image' => $personImagePath
    ];
  }
}

header('Content-Type: application/json');
echo json_encode($people);
?>
