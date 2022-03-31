<?php
require_once('./encrypt.php');
require_once ('./dbcreate.php');

// Create necessary documents table
createTable();

// Get available files
$files = preg_grep('/^([^.])/', scandir('./documents/'));

if(isset($_GET['document'])){
    // Download file from link
    get_file($_GET['document']);
}

if(isset($_FILES['userfile']['name'])){

    // Check if a file with the same name already exists
    $file_name = $_FILES['userfile']['name'];
    if(!in_array($file_name, $files)){
        // Create encrypted data and initialization vector
        $file_contents = file_get_contents($_FILES['userfile']['tmp_name']);
        $encrypted_data = encrypt_data($file_contents);

        // Save file to server and initialization vector to database
        save_file($file_name, $encrypted_data['data'], $encrypted_data['iv']);

        // Refresh available files with new one included
        $files = preg_grep('/^([^.])/', scandir('./documents/'));
    }
    else{
        echo 'Document with the same name already exists!';
    }

}

?>

<form enctype="multipart/form-data" action="./upload.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>

<?php

    foreach($files as $file_name){
        echo "<a href='./upload.php?document=$file_name'>" . "$file_name" . '</a>'. '</br>';
    }

?>
