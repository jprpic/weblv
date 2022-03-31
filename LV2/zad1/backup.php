<?php

//Naziv baze podataka
$db_name = 'encrypt';

//Direktorij za backup
$dir = "backup/$db_name";

//Ako direktorij ne postoji stvori ga
if (!is_dir($dir)) {
    if (!@mkdir($dir)) {
        die("<p>Ne možemo stvoriti direktorij $dir.</p></body></html>");
    }
}

//Trenutno vrijeme
$time = time();

$pdo = new PDO("mysql:dbname=$db_name;host=localhost;", 'root', '');
$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN, 0);

if($tables){
    echo "<p>Backup za bazu podataka '$db_name'.</p>";

    foreach($tables as $table){
        $results = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

        if($results){
            //Otvori datoteku
            if ($fp = gzopen ("$dir/{$table}_{$time}.sql.gz", 'w9')) {

                foreach($results as $entry){
                    // Kreiranje string određenog formata
                    $backupString = "INSERT INTO $table (";
                    $backupString .= implode(', ', array_keys($entry));
                    $backupString .= ")\nVALUES (";
                    array_walk($entry, function(&$value){
                        $value = "'$value'";
                    });
                    $backupString .= implode(', ',$entry);
                    $backupString .= ");\n";

                    // Pisanje stringa u datoteku
                    gzwrite($fp, $backupString);
                }

                // Kraj gzopen()
                gzclose($fp);
            }else { //Ne možemo stvoriti datoteku
                echo "<p>Datoteka $dir/{$table}_{$time}.sql.gz se ne može otvoriti.</p>";
                break; //Prekini while petlju
            }

        }
    }
}
else {
    echo "<p>Baza $db_name ne sadrži tablice.</p>";
}




