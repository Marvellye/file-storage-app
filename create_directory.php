<?php
if (!empty($_POST['directory'])) {
    $dirName = trim($_POST['directory']);
    if (!is_dir("files/$dirName")) {
        mkdir("files/$dirName");
        echo "Directory '$dirName' created.";
    } else {
        echo "Directory '$dirName' already exists.";
    }
} else {
    echo "Directory name cannot be empty.";
}
?>
