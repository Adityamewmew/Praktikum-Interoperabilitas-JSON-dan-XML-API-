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
