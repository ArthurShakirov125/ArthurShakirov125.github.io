<?php

if(file_exists("archive.zip")){ // удаляем старый архив если он существует
    unlink('archive.zip'); 
}

$rootPath = realpath('images');

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

$zip = new ZipArchive(); //Создаём объект для работы с ZIP-архивами
$zip->open("archive.zip", ZIPARCHIVE::CREATE); //Открываем (создаём) архив archive.zip

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}
if(isset($_POST["company"])){
    $zip->addFile("Company.html");
}
if(isset($_POST["private"])){
    $zip->addFile("private.html");
}
if(isset($_POST["Empty"])){
    $zip->addFile("Empty.html");
}
 //Добавляем в архив файл index.php
$zip->addFile("styles/main.css"); //Добавляем в архив файл styles/style.css
$zip->addFile("styles/styleLess.css"); //Добавляем в архив файл styles/style.css
$zip->close(); //Завершаем работу с архивом
?>

<div>
    <a href="archive.zip" download>скачать</a>
</div>