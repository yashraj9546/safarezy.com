<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth-compat.js"></script>
    <script src="./otp.js"></script>
    <style>
        .container{
            max-width: 500px;
        }
        .bdy{
            display: grid;
            place-items: center;
        }
        .phnb{
            margin-top:  25px;
            margin-bottom: 15px;
            font-size: large;
            font-weight: 700;
        }
        .alert {
        padding: 15px;
        background-color: #f44336; /* Red */
        color: white;
        border-radius: 5px;
        margin: 10px 0;
        font-weight: bold;
        }
        .lg{
            display: grid;
            place-items: center;
        }
        .logo{
            max-width: 200px;
            margin-top: 100px;
        }
    </style>
</head>
<body class="bdy">
        <div class="container">
            <header class="flex">
            <div>
                <button id="dropdownButton" class="m-4 text-5xl font-medium sm:hidden">&#8801;</button>
            </div>
                <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                <a href="Rider's-home.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Home</a>
                <a href="Rider-settings.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                <a href="./logout.php" class="block px-4 py-2 font-semibold text-red-400 ">logout</a>
            </div>

            <div class="hidden sm:block">
                <ul class="sm:flex sm:flex-row sm:justify-center">
                    <li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="Rider's-home.php">Home</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4"><a href="rider-settings.php">Settings</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4 text-red-400"><a href="./logout.php">logout</a></li>
                </ul>
            </div>
            <h1 class="text-3xl mt-7">Settings</h1>
        </header>
        <hr class="w-4/5 mx-auto border-t-2 border-gray-500">
        <main>
            <div class="flex flex-row">
                <div>
                    <img class="max-w-14 m-5 ml-8 rounded-full" src="<?php // display_user_data.php
                            session_start();
                            session_regenerate_id(true); // prevent session fixation
                            if (isset($_SESSION['uid'])) {
                                $photourl = $_SESSION['photoURL'];
                                echo  htmlspecialchars($photourl) ;
                            }
                        ?>" alt="image not found">
                </div>
                <div class="mt-5">
                    <h2 class="text-2xl">
                        <?php // display_user_data.php
                            if (isset($_SESSION['uid'])) {
                                $uid = $_SESSION['uid'];
                                $name = $_SESSION['name'];
                                echo  htmlspecialchars($name) ;
                            }
                        ?>
                    </h2>
                    <p>
                        <?php
                            require 'db_connect.php';
                            $stmt = $conn->prepare("SELECT `mob.no` FROM `customer-info` WHERE `uid` = ?");
                            $stmt->bind_param("s", $uid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                
                            if ($result->num_rows > 0)
                            {
                                $user = $result->fetch_assoc();
                                $_SESSION['mob.no'] = $user['mob.no'];
                                echo  htmlspecialchars($_SESSION['mob.no']) ;
                            }
                        ?>
                    </p>
                </div>
            </div>
        </main>
        <hr class="w-4/5 mx-auto border-t-2 border-gray-500">
        <footer>
        <div class="flex flex-row">
            <img class="max-w-8 m-5 ml-8 mt-8" src="../image/phone.png" alt="image not found">
            <button class="text-2xl mt-4" onclick="showPopup()">Change number</button>

            <div id="popup" class="hidden fixed inset-0 bg-opacity-100 flex justify-center items-center shadow-2xl">
                <div class="p-6 bg-white rounded shadow-lg w-4/5">
                        <label class="phnb" for="phone">Enter your number</label>
                        <br>
                        <!-- send OTP -->
                        <input type="text"  id="phoneNumber" class="bg-gray-100 mt-1 p-1 pl-3" placeholder="+91XXXXXXXXXX" pattern="[6-9]{1}[0-9]{9}" value="+91" required>
                        <div id="recaptcha-container"></div>
                         
                        <button id="sendOTPButton" onclick="sendOTP()" class="mt-4 bg-blue-300 text-white px-4 py-2 rounded">Send OTP</button>
                        <br><br>
                        <!-- verify OTP -->
                        <div id="otpSection" style="display: none;">
                            <input type="text" id="otp" class="bg-gray-100 mt-1 p-1 pl-3" placeholder="Enter OTP - XXXXXX">
                            <button onclick="verifyOTP()" class="mt-4 bg-blue-300 text-white px-4 py-2 rounded">Verify OTP</button>
                        </div> 
                         
                        <button onclick="closePopup()" type="button" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
                        
                        <form id="storePhoneForm" action="rider-settings.php" method="post" style="display:none;">
                            <input type="hidden"  id="inputField1" name="inputField1" >
                            <input type="submit" value="continue">
                        </form>
                     
                </div>
            </div>
        </div>

        <div class="flex flex-row">
            <img class="max-w-8 m-5 ml-8 mt-5" src="../image/coding (1).png" alt="image not found">
            <button class="text-2xl mt-2.5"><a href="./developer.html">About the Developer</a></button>
        </div>
        
        <div class="flex flex-row">
            <img class="max-w-8 m-5 ml-8 mt-5" src="../image/trash.png" alt="image not found">
            <button class="text-2xl text-red-400 mt-2.5" onclick="showPopup2()">Delete Account</button>

            <div id="popup2" class="hidden fixed inset-0 bg-opacity-100 flex justify-center items-center shadow-2xl">
                <div class="p-6 bg-white rounded shadow-lg w-4/5">
                    <h4 class="text-xl font-bold">Are you sure you want to delete your account?</h4>
                    <br>
                    <form action="deletedata.php" method="post">
                        <button onclick="closePopup2()" type="button" class="mt-4 bg-blue-300 text-white px-4 py-2 rounded">No</button>
                        <button type="submit" name="submit" id="submit" class="mt-4  bg-red-500 text-white px-4 py-2 rounded">Yes</button>
                    </form>
                </div>
            </div>
        </div>
        </footer>
        <div class="lg">
            <img src="../image/safarezy.com.png" alt="Your Logo" class="logo" />
        </div>
        </div>
</body>

<script>
    const button = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');

    button.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    // Script for pop-up
    function showPopup() {
    document.getElementById("popup").classList.remove("hidden");
    }

    function closePopup() {
        document.getElementById("popup").classList.add("hidden");
         
    }

    // Script for pop-up2
    function showPopup2() {
    document.getElementById("popup2").classList.remove("hidden");
    }

    function closePopup2() {
        document.getElementById("popup2").classList.add("hidden");
    }
</script>

<style>
    .hidden { display: none; }
    .fixed { position: fixed; top: 0; left: 0; width: 100%; height: 100%; }
</style>

</html>
 
<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $number = $_POST['inputField1'];
        $number = preg_replace('/^\+91/', '', $number); // Remove +91 prefix if present
        if (preg_match('/^[6-9][0-9]{9}$/', $number)) {
            $insert_stmt = $conn->prepare("UPDATE `customer-info` SET `mob.no` = ? WHERE `customer-info`.`uid` = ?");
            $insert_stmt->bind_param("ss",$number,$uid);
            $executed = $insert_stmt->execute(); // Store the boolean result of execute()

            if ($executed) {
                if ($insert_stmt->affected_rows > 0) {
                    // Data updated successfully
                    // echo json_encode(['success' => true, 'message' => 'number updated.']);
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
        } 
        else {
            echo "<div class=\"alert\">Invalid phone number format</div>";
        }
    }
?>