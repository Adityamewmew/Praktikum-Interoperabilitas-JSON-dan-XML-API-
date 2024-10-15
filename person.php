<?php
header('Content-Type: application/xml');

// Membuat objek XML baru
$xml = new SimpleXMLElement('<persons/>');

// Menambahkan elemen person
$person = $xml->addChild('person');
$person->addChild('id', 1);
$person->addChild('name', 'John Doe');
$person->addChild('age', 30);

// Menambahkan elemen address
$address = $person->addChild('address');
$address->addChild('street', 'Jalan ABC');
$address->addChild('city', 'Jakarta');

// Menambahkan elemen hobbies
$hobbies = $person->addChild('hobbies');
$hobbies->addChild('hobby', 'membaca');
$hobbies->addChild('hobby', 'bersepeda');

// Mengembalikan data XML
echo $xml->asXML();
?>
