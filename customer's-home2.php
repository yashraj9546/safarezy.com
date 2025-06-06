<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer's home</title>
    <link rel="stylesheet" href="output.css">
    <style>
        .alert {
        padding: 15px;
        background-color: #f44336; /* Red */
        color: white;
        border-radius: 5px;
        margin: 10px 0;
        font-weight: bold;
        }
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
        <header>
            <div>
                <button id="dropdownButton" class="m-4 text-5xl font-medium sm:hidden">&#8801;</button>
            </div>
                <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                <a href="cust-choice.php" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-200">Home</a>
                <a href="cust-settings.php" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-200">Settings</a>
                <a href="./logout.php" class="block px-4 py-2 font-semibold text-red-400 ">logout</a>
            </div>

            <div class="hidden sm:block">
                <ul class="sm:flex sm:flex-row sm:justify-center">
                    <li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="cust-choice.php">Home</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4"><a href="cust-settings.php">Settings</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4 text-red-400"><a href="./logout.php">logout</a></li>
                </ul>
            </div>
                <div>
                    <?php
                        session_start();
                        session_regenerate_id(true); // prevent session fixation
                        require 'db_connect.php';
                        if (isset($_SESSION['uid'])) {
                            $uid = $_SESSION['uid'];
                            $stmt = $conn->prepare("SELECT `mob.no` FROM `customer-info` WHERE `uid` = ?");
                            $stmt->bind_param("s", $uid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                
                            if ($result->num_rows > 0)
                            {
                                $user = $result->fetch_assoc();
                                $_SESSION['mob.no'] = $user['mob.no'];
                                if ($_SESSION['mob.no'] == 0){
                                    echo "<div class=\"alert\"><a href=\"cust-settings.php\">Please enter a valid mobile number in settings</a></div>"; 
                                }
                            }
                        }
                    ?>
            </div>
        </header>

        <hr class="w-xl hidden md:block">
        <main class= "mt-1">
            <div class="m-5 pt-6 pb-6">
                <h1 class="text-4xl font-bold text-black ">Welcome</h1>
                <h3 class="text-3xl font-semibold text-amber-300">
                <?php // display_user_data.php

use Firebase\Auth\Token\Exception\IssuedInTheFuture;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;

                    if (isset($_SESSION['uid'])) {
                        $name = $_SESSION['name'];
                        echo  htmlspecialchars($name) ;
                    }
                ?>
                </h3>
            </div>
            <p class="text-xl text-center">Where do you wanna go ?</p>

                <form action="car-list.php" method="post" onsubmit="return validateForm()">
                    <div class="m-6">
                        
                        <div class="grid place-items-center">
                            
                            <input type="text" id="dropdownInput1" name="dropdownInput1" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-center" 
                            placeholder="From" readonly>
                        </div>

                        <!-- Dropdown Options -->
                        <div id="loc-dropdownMenu" class="hidden relative w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg">
                            <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">College</p>
                            <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Patna</p>
                            <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Chandi</p>
                            <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Nalanda</p>
                            <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Deo-Ghar</p>
                        </div>
                    </div>
                    
                    <hr class="w-2xs mx-auto">

                    <div class="m-6">
                    
                        <div class="grid place-items-center">
                            
                            <input type="text" id="dropdownInput2" name="dropdownInput2" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-center" 
                            placeholder="To" readonly>
                        </div>

                        <!-- Dropdown Options -->
                        <div id="loc-dropdownMenu2" class="hidden relative w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg">
                            <p class="option-item2 px-4 py-2 hover:bg-gray-200 cursor-pointer">College</p>
                            <p class="option-item2 px-4 py-2 hover:bg-gray-200 cursor-pointer">Patna</p>
                            <p class="option-item2 px-4 py-2 hover:bg-gray-200 cursor-pointer">Chandi</p>
                            <p class="option-item2 px-4 py-2 hover:bg-gray-200 cursor-pointer">Nalanda</p>
                            <p class="option-item2 px-4 py-2 hover:bg-gray-200 cursor-pointer">Deo-Ghar</p>
                        </div>
                    </div>

                    <button type="submit" class="bg-gray-100 static mb-2 p-1 w-full drop-shadow-md rounded-xl text-xl font-light">Find</button>
                </form>
        </main>

        <footer>
            <div class="m-6">
                <img src="../image/undraw_travelers_kud9.png" alt="image not found">
            </div>
        </footer>    
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

    // location dropdown menu
    const inputField = document.getElementById('dropdownInput1');
        const dropdownMenu = document.getElementById('loc-dropdownMenu');

        // Show dropdown on input click
        inputField.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Select an option
        document.querySelectorAll('.option-item').forEach(item => {
            item.addEventListener('click', (e) => {
                inputField.value = e.target.textContent;
                dropdownMenu.classList.add('hidden');
            });
        });

        // Close dropdown if clicking outside
        window.addEventListener('click', (e) => {
            if (!inputField.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // location dropdown menu-2
        const inputField2 = document.getElementById('dropdownInput2');
        const dropdownMenu2 = document.getElementById('loc-dropdownMenu2');

        // Show dropdown on input click
        inputField2.addEventListener('click', () => {
            dropdownMenu2.classList.toggle('hidden');
        });

        // Select an option
        document.querySelectorAll('.option-item2').forEach(item => {
            item.addEventListener('click', (e) => {
                inputField2.value = e.target.textContent;
                dropdownMenu2.classList.add('hidden');
            });
        });

        // Close dropdown if clicking outside
        window.addEventListener('click', (e) => {
            if (!inputField2.contains(e.target) && !dropdownMenu2.contains(e.target)) {
                dropdownMenu2.classList.add('hidden');
            }
        });

        function validateForm() {
            const fromLocation = document.getElementById('dropdownInput1').value.trim();
            const toLocation = document.getElementById('dropdownInput2').value.trim();

            if (fromLocation === "" || toLocation === "") {
                alert("Please select both 'From' and 'To' locations.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission if both are selected
        }

        function no_mobno() {
            alert("Please update your mobile number in settings");
        }
</script>
</html>

<?php
    $stmt = $conn->prepare("SELECT `mob.no` FROM `customer-info` WHERE `uid` = ?");
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
            
    if ($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();
        $_SESSION['mob.no'] = $user['mob.no'];
        if ($_SESSION['mob.no'] == 0 )
        {
            echo "<script>no_mobno();</script>";
        }
    }
?>