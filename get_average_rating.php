<?php
include './db_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'average_rating' => 0];

if (isset($_GET['rider_id'])) {
    $riderId = $_GET['rider_id'];

    $stmt = $conn->prepare("SELECT AVG(`rating`) AS `average_rating` FROM `rider-rating` WHERE `rider_id` = ?");
    $stmt->bind_param("s", $riderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['success'] = true;
        $response['average_rating'] = $row['average_rating'] ? round($row['average_rating'], 1) : 0;
    } else {
        $response['message'] = 'No ratings found for this product.';
    }
    $stmt->close();
} else {
    $response['message'] = 'Product ID not provided.';
}

$conn->close();
echo json_encode($response);
?>