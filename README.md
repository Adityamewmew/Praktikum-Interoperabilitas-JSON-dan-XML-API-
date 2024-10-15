Praktikum Interoperabilitas 
JSON dan XML API

Nama : Aditya Purnama Herlambang
NIM   : 362358302009
Kelas  : 2A TRPL

1.	Instalasi Node.js dan Express.js
![image](https://github.com/user-attachments/assets/556e834a-b5ff-47e4-8e07-b6c1a62fce6a)
2.Membuat Server Express.js
•	const express = require('express');
•	const app = express();
•	const port = 3000;
•	
•	app.use(express.json());
•	
•	let persons = [
•	  { id: 1, name: "John Doe", gender: "male", location: "Jakarta" },
•	  { id: 2, name: "Jane Doe", gender: "female", location: "Bandung" },
•	];
•	
•	app.get('/person', (req, res) => {
•	  res.json(persons);
•	});
•	
•	app.post('/person', (req, res) => {
•	  const newPerson = req.body;
•	  newPerson.id = persons.length + 1;
•	  persons.push(newPerson);
•	  res.status(201).json(newPerson);
•	});
•	
•	app.delete('/person/:id', (req, res) => {
•	  const id = parseInt(req.params.id);
•	  persons = persons.filter(person => person.id !== id);
•	  res.status(204).send();
•	});
•	
•	app.listen(port, () => {
•	  console.log(`Server berjalan di http://localhost:${port}`);
•	});
•	

3.Menjalankan server
![image](https://github.com/user-attachments/assets/2142677b-49ce-4948-90f6-f1aaee11f074)
4.Menjalankan API
•	GET
![image](https://github.com/user-attachments/assets/da2351ed-8303-44a6-8077-ed0c8a4a055b)
•	POST
![image](https://github.com/user-attachments/assets/98c67adc-489d-45f0-9fa4-ebc6c261affe)
•	DELETE
![image](https://github.com/user-attachments/assets/02907ed0-204d-4cbc-b411-8947eef96ff8)
5.Membuat file API.php 
<?php
header('Content-Type: application/json');

// Data dummy
$persons = [
    [
        "id" => 1,
        "nama" => "John Doe",
        "umur" => 30,
        "alamat" => [
            "jalan" => "Jalan ABC",
            "kota" => "Jakarta"
        ],
        "hobi" => ["membaca", "bersepeda"]
    ],
    [
        "id" => 2,
        "nama" => "Jane Doe",
        "umur" => 25,
        "alamat" => [
            "jalan" => "Jalan DEF",
            "kota" => "Bandung"
        ],
        "hobi" => ["menulis", "berenang"]
    ]
];

// Mendapatkan metode HTTP yang digunakan (GET, POST, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Mengatur respon berdasarkan metode HTTP
switch ($method) {
    case 'GET':
        // Mengembalikan semua data persons
        echo json_encode($persons);
        break;

    case 'POST':
        // Mendapatkan data dari body request
        $input = json_decode(file_get_contents('php://input'), true);
        $input['id'] = end($persons)['id'] + 1; // Menambahkan ID baru
        $persons[] = $input; // Menambahkan data baru ke array
        echo json_encode($input);
        break;

    case 'DELETE':
        // Mendapatkan ID dari URL
        $url_parts = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url_parts);
        // Menghapus data berdasarkan ID
        $persons = array_filter($persons, function ($person) use ($id) {
            return $person['id'] != $id;
        });
        echo json_encode(["message" => "Data dengan ID $id telah dihapus"]);
        break;

    default:
        // Metode HTTP tidak didukung
        http_response_code(405);
        echo json_encode(["message" => "Metode HTTP tidak didukung"]);
        break;
}
?>


6.Mengakses API
•	GET
![image](https://github.com/user-attachments/assets/3d4fd9de-b9f4-4a60-9589-60193d84ff45)
•	POST
![image](https://github.com/user-attachments/assets/bd197383-f2e6-4444-afa7-f161d333cb91)
•	DELETE
![image](https://github.com/user-attachments/assets/1e631c80-cb1a-478c-b69e-acdbba8f1e4b)
7.Membuat Endpoint XML
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

 8.Menjalankan server
![image](https://github.com/user-attachments/assets/197f78c2-4aba-4bc5-8b1d-49a4241a2c43)
9.Mengakses API
![image](https://github.com/user-attachments/assets/f814f693-fccf-451b-a729-35fbd15c7676)

