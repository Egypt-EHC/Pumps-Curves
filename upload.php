<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $uploadDir = 'uploads/';  // Create a directory named 'uploads' in your project

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            echo "File uploaded successfully.";

            // Add, commit, and push changes to GitHub
            exec("git add .");
            exec("git commit -m 'Add $fileName'");
            exec("git push origin main");  // Replace 'main' with your branch name

        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: " . $file['error'];
    }
}
?>
