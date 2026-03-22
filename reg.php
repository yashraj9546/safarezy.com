<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafarEZY.com</title>
    <link rel="stylesheet" href="output.css">
    <style>
        .container{
            max-width: 500px;
        }
        .bdy{
            display: grid;
            place-items: center;
        }
    </style>
</head>
<body class="bdy">
    <div class="container">
        <header class="grid place-items-center mt-36 min-h-1/4">
            <div>
                <h1 class="text-4xl font-semibold">REGISTER</h1>
            </div>
            <br>
            <div>
                <h1 class="text-4xl font-semibold">YOURSELF</h1>
            </div>
        </header>
        <main>
            <div class="mt-8 p-10">
                <div class="p-8">
                    <button class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-lg font-semibold"><a href="cust-choice.php">CUSTOMER</a></button> 
                </div>

                <hr>

                <div class="p-8">
                    <form action="reg.php" method="post">
                        <button type="submit" value="submit1" name="submitx" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-lg font-semibold">AUTO OWNER</button>
                    </form>
                </div>

                <hr>

                <div class="p-8">
                    <form action="reg.php" method="post">
                        <button type="submit" value="submit2" name="submitx" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-lg font-semibold">CAR OWNER</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php
    session_start();
    require 'db_connect.php';
    // Adding 1 to status column to denoted rider is free
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_POST["submitx"]) && $_POST["submitx"] == "submit1") {
            // **Important:** You need to define the `$uid` variable here.
            // It likely comes from a form submission, session, or some other source.
            // For example, if it's from a POST request:
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
                $insert_stmt = $conn->prepare("UPDATE `customer-info` SET `diff` = '1' WHERE `customer-info`.`uid` = ?");
                $insert_stmt->bind_param("s", $uid);
                $executed = $insert_stmt->execute(); // Store the boolean result of execute()

                if ($executed) {
                    if ($insert_stmt->affected_rows > 0) {
                        // Data updated successfully
                        echo json_encode(['success' => true, 'message' => 'Rider status updated.']);
                    } else {
                        // No rows were updated (e.g., if the UID doesn't exist)
                        echo json_encode(['success' => false, 'error' => 'No user found with that UID to update.']);
                    }
                } else {
                    // Error during query execution
                    error_log("MySQL Update Error: " . $insert_stmt->error);
                    echo json_encode(['success' => false, 'error' => 'Failed to update rider status: ' . $insert_stmt->error]);
                }
                $insert_stmt->close();
                header("Location: Rider's-home.php");
            } else {
                // Handle the case where 'uid' is not provided in the POST request
                echo json_encode(['success' => false, 'error' => 'User ID (uid) not provided.']);
            }
        }
        elseif (isset($_POST["submitx"]) && $_POST["submitx"] == "submit2"){
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
                $insert_stmt = $conn->prepare("UPDATE `customer-info` SET `diff` = '2' WHERE `customer-info`.`uid` = ?");
                $insert_stmt->bind_param("s", $uid);
                $executed = $insert_stmt->execute(); // Store the boolean result of execute()

                if ($executed) {
                    if ($insert_stmt->affected_rows > 0) {
                        // Data updated successfully
                        echo json_encode(['success' => true, 'message' => 'car owner status updated.']);
                    } else {
                        // No rows were updated (e.g., if the UID doesn't exist)
                        echo json_encode(['success' => false, 'error' => 'No user found with that UID to update.']);
                    }
                } else {
                    // Error during query execution
                    error_log("MySQL Update Error: " . $insert_stmt->error);
                    echo json_encode(['success' => false, 'error' => 'Failed to update car owner status: ' . $insert_stmt->error]);
                }
                $insert_stmt->close();
                header("Location: car-owner-home.php");
            } else {
                // Handle the case where 'uid' is not provided in the POST request
                echo json_encode(['success' => false, 'error' => 'User ID (uid) not provided.']);
            }
        }
        else{
            echo "expression not working";
        }
    }
    $conn->close(); // Close the database connection
?>