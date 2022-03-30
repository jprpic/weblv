<?php
function encrypt_data($data){
    /*Kriptiranje podataka i spremanje u session varijable*/
    session_start();
    //Ključ za enkripciju
    $encryption_key = md5('jed4n j4k0 v3l1k1 kljuc');

    //Odaber cipher metodu AES
    $cipher = "AES-128-CTR";

    //Stvori IV sa ispravnom dužinom
    $iv_length = openssl_cipher_iv_length($cipher);
    $options = 0;

    // Non-NULL inicijalizacijski vektor za enkripciju
    //Random dužine 16 byte
    $encryption_iv = random_bytes($iv_length);

    // Kriptiraj podatke sa openssl
    $data = openssl_encrypt($data, $cipher,
        $encryption_key, $options, $encryption_iv);

    // Vrati podatke
    $encrypted_data = array(
        'data'=> base64_encode($data),
        'iv' => $encryption_iv
    );

    return $encrypted_data;
}

function save_file($file_name, $data, $iv){
    $db_name = 'encrypt';

    // Save initialization vector to database
    $pdo = new PDO("mysql:dbname=$db_name;host=localhost;", 'root', '');
    $sql = "INSERT INTO documents (name, iv) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$file_name, $iv]);

    unset($pdo);

    // Save encrypted document to server
    $f=fopen("./documents/$file_name",'w');
    fwrite($f,$data);
    fclose($f);
}

function get_file($file_name){
    $db_name = 'encrypt';

    // Get initialization vector from database
    $pdo = new PDO("mysql:dbname=$db_name;host=localhost;", 'root', '');
    $sql = "SELECT iv FROM documents WHERE name LIKE '$file_name'";
    $decryption_iv = $pdo->query($sql)->fetch(PDO::FETCH_COLUMN, 0);

    unset($pdo);

    // Get encrypted data from document on server
    $encrypted_data = file_get_contents("./documents/$file_name");
    $data = base64_decode($encrypted_data);

    //Stvori ključ
    $decryption_key = md5('jed4n j4k0 v3l1k1 kljuc');
    //Odaber cipher metodu AES
    $cipher = "AES-128-CTR";
    $options = 0;

    // Dekriptiraj podatke:
    $data=openssl_decrypt ($data, $cipher,
        $decryption_key, $options, $decryption_iv);


    // Clean output buffer and force file download
    ob_end_clean();

    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Length: ". filesize("$file_name").";");
    header("Content-Disposition: attachment; filename=$file_name");
    header("Content-Type: application/octet-stream; ");
    header("Content-Transfer-Encoding: binary");

    echo trim($data);
    exit;


}
?>



