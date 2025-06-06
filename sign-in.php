<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafarEZY.com</title>
    <link rel="stylesheet" href="output.css">
    <script src="./main.js"></script>
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
                    <div class="max-w-40">
                        <img src="../image/4957136.jpg" alt="image not found">
                    </div>
                </header>
                <main>
                    <div class="mt-8 p-10">
                        <div class="grid place-content-center">
                            <h3 class="text-2xl font-bold">SIGN-IN</h3>
                        </div>
                        <div class="p-8" id="auth-container">
                            <button id="login-button" onclick="signInWithGoogle()" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md text-lg font-light flex items-center justify-center"><img class="mr-2" src="../image/icons8-google-30.png" alt="image not found">Google</button>
                        </div>
                    </div>
                </main>
        </div>
</body>
</html>

<?php
    session_start();
    require 'db_connect.php';
    session_regenerate_id(true); // prevent session fixation

    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $photoURL = $_SESSION['photoURL'];

        // Check if user already exists
        $stmt = $conn->prepare("SELECT `uid`, `diff` FROM `customer-info` WHERE `uid` = ?");
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Insert new user
            $insert_stmt = $conn->prepare("INSERT INTO `customer-info` (`uid`, `email`, `name`, `photo_url`, `created_at`) VALUES (?, ?, ?, ?, NOW())");
            $insert_stmt->bind_param("ssss", $uid, $email, $name, $photoURL);
            $insert_stmt->execute();

            if ($insert_stmt->affected_rows > 0) {
                $insert_stmt->close();
                $conn->close();
                header("Location: reg.php");
                exit();
            } else {
                error_log("MySQL Insert Error: " . $insert_stmt->error);
                $insert_stmt->close();
                $conn->close();
                // You can show an error page here or redirect to a failure page
                die("Login successful but failed to store user data.");
            }
        } 
        else {
            
            $stmt = $conn->prepare("SELECT `diff` FROM `customer-info` WHERE `uid` = ?");
            $stmt->bind_param("s", $uid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0)
            {
                $user = $result->fetch_assoc();
                $_SESSION['diff'] = $user['diff'];

                // Redirect based on role
                if ($user['diff'] == '1') {
                    header("Location: Rider's-home.php");
                } 
                elseif ($user['diff'] == '2'){
                    header("Location: car-owner-home.php");
                }
                else {
                    header("Location: cust-choice.php");
                }
                exit();
            }

            $stmt->close();
        }
    }
    $conn->close();
?>
