<?php
header('Content-Type: application/json');
include 'db.php';

$conn = OpenCon();

$data = json_decode(file_get_contents('php://input'), true);
$meja = $data['meja'];
$items = $data['items'];

$total = 0;
$printers = [
    'A' => [],
    'B' => [],
    'C' => []
];

foreach ($items as $item) {
    $nama = $item['nama'];
    $varian = $item['varian'] ?? '';
    $quantity = $item['quantity'] ?? 1;

    $query = "SELECT id, nama, varian, harga 
              FROM minuman 
              WHERE nama='$nama' AND varian='$varian'
              UNION ALL
              SELECT id, nama, varian, harga 
              FROM makanan 
              WHERE nama='$nama' AND varian='$varian'
              UNION ALL
              SELECT NULL AS id, nama, NULL AS varian, harga 
              FROM promo 
              WHERE nama='$nama'";

    // Print query debugging
    //echo "Executing query: $query\n";

    $result = $conn->query($query);

    if ($result === false) {
        echo json_encode(['error' => 'Error executing query: ' . $conn->error]);
        CloseCon($conn);
        exit;
    }

    $row = $result->fetch_assoc();

    if ($row) {
        $harga = $row['harga'];
        $total += $harga * $quantity;

        if (in_array($row['nama'], ['Nasi Goreng', 'Mie'])) {
            $printers['B'][] = $row['nama'];
        }
        if (in_array($row['nama'], ['Jeruk', 'Kopi', 'Teh'])) {
            $printers['C'][] = $row['nama'];
        }
    } else {
        echo json_encode(['error' => 'Item not found: ' . $nama]);
        CloseCon($conn);
        exit;
    }
}

$order_query = "INSERT INTO orders (meja, items, total) VALUES ('$meja', '" . json_encode($items) . "', $total)";
if (!$conn->query($order_query)) {
    // Print Error
    echo json_encode(['error' => 'Error inserting order: ' . $conn->error]);
    CloseCon($conn);
    exit;
}

$order_id = $conn->insert_id;

$response = [
    'order_id' => $order_id,
    'total' => $total,
    'printers' => $printers
];

echo json_encode($response);

CloseCon($conn);
?>
