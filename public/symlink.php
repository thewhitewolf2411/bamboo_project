<?php

$targetFolder = '/home/bamboore/bamboo_app/storage/app/public';
$linkFolder = '/home/bamboore/bamboo_app/public/storage';
symlink($targetFolder,$linkFolder);
echo 'Symlink process successfully completed';
?>