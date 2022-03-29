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
        'data'=>base64_encode($data),
        'iv' => $encryption_iv
    );

    return $encrypted_data;
}
?>

