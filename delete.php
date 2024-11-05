<?php
if (!empty($_POST['filename'])) {
    $filename = basename($_POST['filename']);
    $filePath = "files/" . $filename;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Delete the file
        unlink($filePath);

        // Update JSON metadata
        $files = json_decode(file_get_contents('files/files.json'), true);
        $files = array_filter($files, function ($file) use ($filename) {
            return $file['name'] !== $filename;
        });
        file_put_contents('files/files.json', json_encode(array_values($files), JSON_PRETTY_PRINT));

        echo "The file " . htmlspecialchars($filename) . " has been deleted.";
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}

// Redirect back to the index page after deletion
header("Location: index.php");
exit();
?>
