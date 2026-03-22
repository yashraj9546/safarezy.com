<?php
$file = __DIR__ . '/resources/views/listing/car-list.blade.php';
$content = file_get_contents($file);
$content = str_replace('@forelse($carOwners as $carOwners)', '@forelse($carOwners as $owner)', $content);
file_put_contents($file, $content);
echo "Fixed car-list.blade.php\n";
