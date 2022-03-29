<?php
function save_file($file_name, $data, $iv){
    $db_name = 'encrypt';
    $pdo = new PDO("mysql:dbname=$db_name;host=localhost;", 'root', '');
    $sql = "INSERT INTO documents VALUES (?, ?)";



    file_put_contents("./documents/$file_name", $data);
}


if(isset($_FILES['userfile']) && $_FILES['userfile']['type'] == 'text/plain'){
    require_once('./encrypt.php');
    $file_name = $_FILES['userfile']['name'];
    $file_contents = file_get_contents($_FILES['userfile']['tmp_name']);
    $encrypted_data = encrypt_data($file_contents);

    $files = scandir('./documents/');
    if(!in_array($file_name, $files)){
        save_file("./documents/$file_name", $encrypted_data['data'], $encrypted_data['iv']);
    }
    else{
        echo 'Document with the same name already exists!';
    }
}
else{
    echo 'Invalid type format. Accepting only .txt files';
}

?>

<form enctype="multipart/form-data" action="./upload.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
