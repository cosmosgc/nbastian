<?php
$postsDirectory = 'posts/';
$posts = [];

foreach (scandir($postsDirectory) as $file) {
  if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'html') {
    $posts[] = [
      'title' => pathinfo($file, PATHINFO_FILENAME),
      'path' => $postsDirectory . $file
    ];
  }
}

header('Content-Type: application/json');
echo json_encode($posts);
?>
