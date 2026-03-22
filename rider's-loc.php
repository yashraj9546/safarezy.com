<?php
    session_start();
    session_regenerate_id();
    include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rider's location</title>
    <link rel="stylesheet" href="./output.css">
    <style>
        .container{
            max-width: 500px;
        }
        .bdy{
            display: grid;
            place-items: center;
        }
        .mn{
        margin-top: 4px;
        }
        .intro{
            margin:  20px;
            padding-top: 24px;
            padding-bottom: 24px;
        }
        .hello{
            font-size: 36px;
            font-weight: 700;
            color: black;
        }
        .name{
            font-size: 30px;
            font-weight: 600;
            color: oklch(87.9% 0.169 91.605);
        }
        .container2{
            margin: 24px;
        }
        .para{
            font-size: 24px;
            font-weight: 300;
            text-align: center;
            margin: 4px;
            margin-bottom: 10px;
        }
        .inbox-cont{
            display: grid;
            place-items: center;
        }
        .loc{
            margin-top: 24px;
            font-size: 20px;
        }
        .bgbutton{
            display: grid;
            place-items: center;
        }
        .button{
            margin: 20px;
            border-width: 2px;
            border-color: oklch(80.9% 0.105 251.813);
            background-color: oklch(70.7% 0.165 254.624);
            color: #ffffff;
            font-weight: 600;
            border-radius: calc(infinity * 1px);
            width: calc(11/12 * 100%);
            margin-left: 12px;
            margin-right: 12px;
            margin-top: 40px;
            height: 40px;
            text-align: center;
        }
        .curr{
            font-size: 24px;
            text-align: center;
        }
        .site{
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            color: oklch(87.9% 0.169 91.605);
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
                <a href="Rider's-home.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Home</a>
                <a href="rider-settings.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                <a href="./logout.php" class="block px-4 py-2 font-semibold text-red-400 ">logout</a>
            </div>

            <div class="hidden sm:block">
                <ul class="sm:flex sm:flex-row sm:justify-center">
                    <li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="Rider's-home.php">Home</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4"><a href="rider-settings.php">Settings</a></li>
                    <li class="sm:text-xl sm:font-semibold sm:m-4 text-red-400"><a href="./logout.php">logout</a></li>
                </ul>
            </div>
        </header>
        <hr class="w-xl hidden md:block">
        <main class= "mn">
            <div class="intro">
                <h1 class="hello">Hey</h1>
                <h3 class="name">
                <?php // display_user_data.php
                         
                         if (isset($_SESSION['uid'])) {
                             $uid = $_SESSION['uid'];
                             $name = $_SESSION['name'];
                             echo  htmlspecialchars($name) ;
                         }
                     ?>
                </h3>
            </div>
            <div class="container2">
                <form action="rider's-loc.php" method="post">
                    <p class="para">Throw your location and wait for customer to call you</p>
                    <div class="inbox-cont">
                        <h2 class="loc">Location</h2>
                        <input type="text" id="dropdownInput" name="dropdownInput"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                        placeholder="Enter your location" readonly>
                    </div>

                    <!-- Dropdown Options -->
                    <div id="loc-dropdownMenu" class="hidden absolute w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg">
                        <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">College</p>
                        <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Station</p>
                        <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Dedor mod</p>
                        <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Highway</p>
                        <p class="option-item px-4 py-2 hover:bg-gray-200 cursor-pointer">Market</p>
                    </div>
                    <div class="bgbutton">
                        <button type="submit" id="submit" name="submit" class="button">Submit</button>
                    </div>
                </form>
                <p class="curr">Your current location is 
                    <div class="site">
                    <?php
                        $stmt = $conn->prepare("SELECT `location` FROM `customer-info` WHERE `uid` = ?");
                        $stmt->bind_param("s", $uid);
                        $stmt->execute();
                        $result = $stmt->get_result();
            
                        if ($result->num_rows > 0)
                        {
                            $user = $result->fetch_assoc();
                            $_SESSION['location'] = $user['location'];
                            echo  htmlspecialchars($_SESSION['location']) ;
                        }
                    ?>
                    </div>
                </p>
            </div>
        </main>
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
        const inputField = document.getElementById('dropdownInput');
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
    </script>
</html>

<?php
    // Adding 1 to status column to denoted rider is free
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    
        if (isset($_POST["free"])) {
            // **Important:** You need to define the `$uid` variable here.
            // It likely comes from a form submission, session, or some other source.
            // For example, if it's from a POST request:
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
                $a = 1;
                $insert_stmt = $conn->prepare("UPDATE `customer-info` SET `status` = ? WHERE `customer-info`.`uid` = ?");
                $insert_stmt->bind_param("ss",$a,$uid);
                $executed = $insert_stmt->execute(); // Store the boolean result of execute()
    
                if ($executed) {
                    if ($insert_stmt->affected_rows > 0) {
                            // Data updated successfully
                            // echo json_encode(['success' => true, 'message' => 'Rider status updated.']);
                        } else {
                            // No rows were updated (e.g., if the UID doesn't exist)
                            // echo json_encode(['success' => false, 'error' => 'No user found with that UID to update.']);
                        }
                    } 
                    else {
                        // Error during query execution
                        // error_log("MySQL Update Error: " . $insert_stmt->error);
                        // echo json_encode(['success' => false, 'error' => 'Failed to update rider status: ' . $insert_stmt->error]);
                    }
                    $insert_stmt->close();
                } 
                else {
                    // Handle the case where 'uid' is not provided in the POST request
                    // echo json_encode(['success' => false, 'error' => 'User ID (uid) not provided.']);
                }
        }
        if (isset($_POST["submit"])) {
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
                $loc = $_POST["dropdownInput"];
                $insert_stmt = $conn->prepare("UPDATE `customer-info` SET `location` = ? WHERE `customer-info`.`uid` = ?");
                $insert_stmt->bind_param("ss", $loc,$uid);
                $executed = $insert_stmt->execute(); // Store the boolean result of execute()

                if ($executed) {
                    if ($insert_stmt->affected_rows > 0) {
                    // Data updated successfully
                    // echo json_encode(['success' => true, 'message' => 'Rider status updated.']);
                    } else {
                    // No rows were updated (e.g., if the UID doesn't exist)
                    // echo json_encode(['success' => false, 'error' => 'No user found with that UID to update.']);
                    }
                    $insert_stmt->close();
                    } 
                else {
                    // Error during query execution
                    // error_log("MySQL Update Error: " . $insert_stmt->error);
                    // echo json_encode(['success' => false, 'error' => 'Failed to update location: ' . $insert_stmt->error]);
                }
            }
        }
    }
?>