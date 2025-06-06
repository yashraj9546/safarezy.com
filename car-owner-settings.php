<?php
    session_start();
    session_regenerate_id(true); // prevent session fixation
?>

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
        .hidden { display: none; }
        .fixed { position: fixed; top: 0; left: 0; width: 100%; height: 100%; }
        .container{
            max-width: 500px;
        }
        .bdy{
            display: grid;
            place-items: center;
            background-color: #f3f4f6;
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
        .card{
            max-width: calc(10/12 * 100%);
            margin: 40px;
            margin-inline: auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 16px;
        }
        .info{
            display: flex;
            align-items: center;
            margin-inline-start: 16px;

        }
        .dphoto{
            height: 64px;
            width: 64px;
            margin-left: -10px;
            margin-right: 20px;
            border-radius: calc(infinity * 1px);
            object-fit: cover;
        }
        .dname{
            font-size: 20px;
            font-weight: 600;
        }
        .vinfo{
            color: #4a5565;
        }
        .price{
            color: oklch(62.7% 0.194 149.214);
        }
        .carimg{
            display: grid;
            place-items: center;
        }
        .carimg-in{
            width: 192px;
            margin-top: 8px;
        }
        .freebtn{
            margin-top: 16px;
            text-align: right;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .freetxt{
            font-size: 24px;
        }
        .btn{
            background-color: #155dfc;
            color: #ffffff;
            font-weight: 600;
            padding-inline: 16px;
            padding-block: 8px;
            border-radius: 8px;
        }
        .dot-green {
      height: 10px;
      width: 10px;
      background-color: green;
      border-radius: 50%;
      display: inline-block;
      margin-right: 5px;
    }
    .dot-red {
      height: 10px;
      width: 10px;
      background-color: red;
      border-radius: 50%;
      display: inline-block;
      margin-right: 3px;
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
                <a href="car-owner-home.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Home</a>
                <a href="car-owner-settings.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                <a href="./logout.php" class="block px-4 py-2 font-semibold text-red-400 ">logout</a>
            </div>

            <div class="hidden sm:block">
                <ul class="sm:flex sm:flex-row sm:justify-center">
                    <li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="car-owner-home.php">Home</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4"><a href="car-owner-settings.php">Settings</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4 text-red-400"><a href="./logout.php">logout</a></li>
                </ul>
            </div>
            <h1 class="text-3xl mt-7">Settings</h1>
        </header>
        <hr class="w-4/5 mx-auto border-t-2 border-gray-500">
        <main>

        <?php
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
                $photourl = $_SESSION['photoURL'];
            }
                require 'db_connect.php';
                $stmt= $conn->prepare("SELECT * FROM `customer-info` WHERE `uid` = ?");
                $stmt->bind_param("s", $uid);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows > 0)
                {                                                                 
                    while($row = mysqli_fetch_assoc($result))
                    {                                        
                        $name = $row['name'];
                        $number= $row['mob.no'];
                        $status= $row['status'];
                        $veh_name = $row['veh_name'];
                        $veh_num = $row['veh_num'];
                        $fare = $row['fare'];
                        if(!$name)
                        {
                          break;
                        }
                        echo '<div class="card">
                            <div class="info">
                                <img class="dphoto" src="'.htmlspecialchars($photourl).'" alt="Driver Photo">
                                <div>
                                    <h2 class="dname">'.$name.'</h2>
                                    <p class="vinfo">'.$veh_name.'</p>
                                    <p class="vinfo">'.$veh_num.'</p>
                                    <p class="price">'.$fare.'</p>
                                </div>
                            </div>
                            <div class="carimg">
                                <img src="/image/pinpng.com-bolero-png-115186.png" alt="" class="carimg-in">
                            </div>
                            <div class="freebtn">
                                <div>';
                                if ($status == 1)
                                {
                                  echo "<p class=\"freetxt\">Free  <span class=\"dot-green\"></span></p>";
                                }
                                else
                                {
                                  echo "<p class=\"freetxt\">Busy  <span class=\"dot-red\"></span></p>";
                                }
                                echo '</div>
                                <p class="vinfo">'.$number.'</p>
                            </div>
                        </div>';
                    }
                }
                
            ?>
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
                        
                        <form id="storePhoneForm" action="car-owner-settings.php" method="post" style="display:none;">
                            <input type="hidden"  id="inputField1" name="inputField1" >
                            <input type="submit" value="continue">
                        </form>
                     
                </div>
            </div>
        </div>

        <div class="flex flex-row">
            <img class="max-w-8 m-5 ml-8 mt-5" src="../image/information_18526671.png" alt="image not found">
            <button class="text-2xl mt-2.5"><a href="./car_detail.php">Update your Details</a></button>
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