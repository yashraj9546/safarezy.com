<?php
include './db_connect.php'; // Ensure this path is correct

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $riderId = $_POST['rider_id'] ?? 0; // Changed from product_id
    $rating = $_POST['rating'] ?? 0;
    $userIp = $_SERVER['REMOTE_ADDR'];

    // Validate input
    if ($riderId && $rating >= 1 && $rating <= 5) {
        // Check if the user has already rated this rider
        // Assuming riderId uniquely identifies a rider. Adjust table/column if needed.
        $stmt = $conn->prepare("SELECT * FROM `rider-rating` WHERE `rider_id`= ? and `user_ip`= ?");
        $stmt->bind_param("ss", $riderId, $userIp); // 'i' for integer, 's' for string
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $response['message'] = 'You have already rated this rider.';
        } else {
            // Insert the new rating
            $stmt = $conn->prepare("INSERT INTO `rider-rating` (`rider_id`, `rating`, `user_ip`) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $riderId, $rating, $userIp);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Rating submitted successfully!';
            } else {
                $response['message'] = 'Error submitting rating: ' . $stmt->error;
            }
        }
        $stmt->close();
    } else {
        $response['message'] = 'Invalid rider ID or rating.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

$conn->close();
echo json_encode($response);
?>