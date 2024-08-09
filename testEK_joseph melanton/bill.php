<?php
header('Content-Type: application/json');
include 'db.php';

$conn = OpenCon();


$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;

if (!$id) {
    echo json_encode(['error' => 'No id provided']);
    CloseCon($conn);
    exit;
}

$query = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    echo json_encode(['error' => 'Error preparing query: ' . $conn->error]);
    CloseCon($conn);
    exit;
}

$stmt->bind_param('i', $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result === false) {
    echo json_encode(['error' => 'Error executing query: ' . $stmt->error]);
    CloseCon($conn);
    exit;
}

$order = $result->fetch_assoc();

if ($order) {
    $items = json_decode($order['items'], true);

    $response = [
        'meja' => $order['meja'],
        'items' => $items,
        'total' => $order['total']
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Order not found']);
}

$stmt->close();
CloseCon($conn);
?>
