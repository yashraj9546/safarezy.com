<?php
    session_start();
    require 'db_connect.php';
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_POST["submit"])){
            $insert_stmt = $conn->prepare("DELETE FROM `customer-info` WHERE `customer-info`.`uid` = ?");
            $insert_stmt->bind_param("s",$uid);
            $executed = $insert_stmt->execute(); // Store the boolean result of execute()

            if ($executed) {
                if ($insert_stmt->affected_rows > 0) {
                    echo "Data deleted successfully";
                } else {
                    // No rows were updated (e.g., if the UID doesn't exist)
                    // echo json_encode(['success' => false, 'error' => 'No user found with that UID to update.']);
                }
            } else {
                // Error during query execution
                // error_log("MySQL Update Error: " . $insert_stmt->error);
                // echo json_encode(['success' => false, 'error' => 'Failed to update rider status: ' . $insert_stmt->error]);
            }
            $insert_stmt->close();
            header("Location: index.html");
            exit();
        }
        else{
            echo "expression not working";
        }
    }
?>