<?php
$targetDir = "files/";
$targetFile = $targetDir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($targetFile, PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size (optional)
if ($_FILES["file"]["size"] > 1000000000) { // Limit to 5MB
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'html', 'mp3', 'mp4', 'php', 'rar', 'zip'];
if (!in_array($fileType, $allowedTypes)) {
    echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, HTML, MP3, MP4 & PHP files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk === 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // Update JSON metadata
        $files = [];
        if (file_exists('files/files.json')) {
            $files = json_decode(file_get_contents('files/files.json'), true);
        }
        $files[] = ['name' => basename($_FILES["file"]["name"])];
        file_put_contents('files/files.json', json_encode($files, JSON_PRETTY_PRINT));
        echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
