<?php
require_once('./iRadovi.php');
require_once('./Curl.php');
require_once ('./simple_html_dom.php');
require_once ('./dbcreate.php');

class DiplomskiRadovi implements iRadovi
{
    private $naziv_rada;
    private $tekst_rada;
    private $link_rada;
    private $oib_tvrtke;

    function __construct($data) {
        $this->naziv_rada = $data['naziv_rada'];
        $this->tekst_rada = $data['tekst_rada'];
        $this->link_rada = $data['link_rada'];
        $this->oib_tvrtke = $data['oib_tvrtke'];
    }

    function create($data) {
        self::__construct($data);
    }

    public function save()
    {
        $pdo = new PDO('mysql:dbname=radovi;host=localhost;', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO diplomski_radovi (naziv_rada, tekst_rada, link_rada, oib_tvrtke) VALUES(?,?,?,?)";

        $stmt= $pdo->prepare($sql);
        $stmt->execute([$this->naziv_rada, $this->tekst_rada, $this->link_rada, $this->oib_tvrtke]);
        $pdo = null;
        unset($pdo);
    }

    function read() {
        $pdo = new PDO('mysql:dbname=radovi;host=localhost;', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM diplomski_radovi";
        $stmt = $pdo->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<b>' . 'Naslov Rada: ' . '</b>'. $row['naziv_rada'] . '</br>';
            echo '<b>' . 'Tekst Rada: ' . '</b>'. $row['tekst_rada'] . '</br>';
            echo '<b>' . 'URL: ' . '</b>'. $row['link_rada'] . '</br>';
            echo '<b>' . 'OIB: ' . '</b>'. $row['oib_tvrtke'] . '</br>' . '</br>';
        }
        $pdo = null;
        unset($pdo);
    }
}

// Kako bi se skripta izvršila, potrebno je napraviti bazu podataka 'radovi'.
// Dodatnim pokretanjem skripte ponovno se dohvaćaju diplomski radovi i spremaju u tablicu.
// Za dohvaćanje različitih diplomskih radova, potrebno je promijeniti $pageNumber.


// Nakon što je tablica prvobitno kreirana, ponovnim pokretanjem se neće ništa dogoditi.
createTable();

// Dohvaćanje sadržaja stranice koja sadrži teme diplomskih radova

$pageNumber = 2;
$url = "https://stup.ferit.hr/index.php/zavrsni-radovi/page/{$pageNumber}";
$response = fetch_url($url);

// Kreiranje HTML DOM-a za mogućnost pretraživanja i dohvaćanja traženog sadržaja

$html = new simple_html_dom();
$html->load($response,true, false);

$names = [];
$links = [];

// Dohvaćanje svakog <h2 class=...> </h2> u kojemu se nalazi dijete <a href=URL> Naslov Rada </a>

foreach ($html->find('h2[class=blog-shortcode-post-title entry-title]') as $element){
    $child = $element->children(0);
    $name = trim(preg_replace('/\t+/', '', $child->innertext));
    array_push($names, $name);
    array_push($links, $child->href);
}

// Dohvaćanje svakog <img> elementa koji sadrži /logos i OIB tvrtke

$oibs = [];
foreach($html->find('img') as $element)
    if(str_contains($element->src,'logos')){
        // ex. https://stup.ferit.hr/wp-content/logos/53943536946.png
        $oib = $element->src;
        $oib = explode('/',$oib);
        $oib = end($oib);
        // ex. 53943536946.png
        $oib = substr($oib, 0, -4);
        array_push($oibs,$oib);
    }

// Oslobađanje zauzete memorije
$html->clear();
unset($html);

// Posjećivanjem svakog URL-a rada može se dohvatiti tekst svakog rada

$texts = [];
foreach($links as $url){
    $response = fetch_url($url);
    $html = new simple_html_dom();
    $html->load($response,true, false);

    // Tekst zadatka su svi tekstovi unutar <div class="post-content"></div>

    $element = $html->find('div[class=post-content]');
    $text = '';
    foreach ($element[0]->find('text') as $childText){
        $text .= html_entity_decode(trim($childText)) . ' ';
    }
    array_push($texts, trim($text," \n\r\t\v\x00"));

    $html->clear();
    unset($html);
}

// Popunjavanje baze podataka s kreiranim objektima

$radovi = [];
for($i = 0; $i<sizeof($names); $i++){
    $data = array(
        'naziv_rada' => $names[$i],
        'tekst_rada' => $texts[$i],
        'link_rada' => $links[$i],
        'oib_tvrtke' => $oibs[$i],
    );

    array_push($radovi, new DiplomskiRadovi($data));
    $rad = new DiplomskiRadovi($data);
    $rad->save();
}

// Ispis

$rad->read();








