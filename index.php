<?php
$files = json_decode(file_get_contents('files/files.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Storage</title>
</head>
<body>
    <h1>File Storage Application</h1>

    <h2>Upload File</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <h2>Create Directory</h2>
    <form action="create_directory.php" method="POST">
        <input type="text" name="directory" placeholder="Directory Name" required>
        <button type="submit">Create</button>
    </form>

    <h2>Uploaded Files</h2>
    <ul>
        <?php if ($files): ?>
            <?php foreach ($files as $file): ?>
                <li><a href="<?= 'files/' . $file['name'] ?>" target="_blank"><?= $file['name'] ?></a></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No files uploaded.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
