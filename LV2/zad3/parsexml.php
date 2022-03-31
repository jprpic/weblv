<?php
//Učitaj datoteku
$xml = simplexml_load_file('LV2.xml');

foreach ($xml->record as $record) {

    // Get first letter of gender only
    $gender = substr($record->spol, 0, 1);
    // Get size dimensions
    $image = @getimagesize ($record->slika);

    // Show profile with bootstrap
    echo '<div class="w-50 d-inline-flex bd-highlight align-items-center">';
        echo "<div class='p-2 bd-highlight '><img src=$record->slika $image[3]></div>";
        echo "<div class='p-2 bd-highlight'>";
            echo "<div class='d-flex flex-column bd-highlight mb-3'>";
                echo "<div class='p-2 bd-highlight'><b>#$record->id $record->ime $record->prezime [$gender]</b></div>";
                echo "<div class='p-2 bd-highlight'>$record->email</div>";
                echo "<div class='p-2 bd-highlight'>$record->zivotopis</div>";
            echo '</div>';
        echo '</div>';
    echo '</div>';

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Records</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
<body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>