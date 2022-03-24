<?php
function fetch_url($url){
    //Pokrećemo cURL spoj
    $curl = curl_init($url);
    //Zaustavi ako se dogodi pogreška
    curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
    //Dozvoli preusmjeravanja
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    //Spremi vraćene podatke u varijablu
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    //Postavi timeout
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);

    //Izvrši transakciju
    $r = curl_exec($curl);

    //Zatvori spoj
    curl_close($curl);

    //ispiši rezultate
    return $r;
}
?>