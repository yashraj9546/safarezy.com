<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>car owner's home</title>
    <link rel="stylesheet" href="./output.css">
    <style>
    .alert {
      padding: 15px;
      background-color: #f44336; /* Red */
      color: white;
      border-radius: 5px;
      margin: 10px 0;
      font-weight: bold;
    }
    .dot-green {
      height: 10px;
      width: 10px;
      background-color: green;
      border-radius: 50%;
      display: inline-block;
      margin-right: 8px;
    }
    .dot-red {
      height: 10px;
      width: 10px;
      background-color: red;
      border-radius: 50%;
      display: inline-block;
      margin-right: 8px;
    }
    .container{
        max-width: 500px;
    }
    .bdy{
        display: grid;
        place-items: center;
        background-color: white;
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
                                echo "<div class=\"alert\"><a href=\"car-owner-settings.php\">Please enter a valid mobile number in settings</a></div>"; 
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
                        if (isset($_SESSION['uid'])) {
                            $uid = $_SESSION['uid'];
                            $name = $_SESSION['name'];
                            echo  htmlspecialchars($name) ;
                        }
                    ?>
                    </h3>
            </div>
    
            <div class="bg-white mt-4 flex flex-row">
                <img class="static rounded-[80px] -ml-24 h-[360px]" src="../image/6387974.jpg" alt="image not found">
                <div class="bg-white min-h-7 mt-20 sm:border border-indigo-600 absolute right-0 sm:mr-[200px] md:mr-[300px] lg:mr-[450px] rounded-3xl overflow-visible max-w-1/2 flex flex-col">
                    <div class="m-3">
                        <div>
                            <p class="text-xl font-medium text-center">Current status</p>
                        </div>
                        <div>
                            <?php
                                $stmt = $conn->prepare("SELECT `status` FROM `customer-info` WHERE `uid` = ?");
                                $stmt->bind_param("s", $uid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                    
                                if ($result->num_rows > 0)
                                {
                                    $user = $result->fetch_assoc();
                                    $_SESSION['status'] = $user['status'];
                                    if ($_SESSION['status'] == 1)
                                    {
                                        echo "<p class=\"text-lg font-medium text-center\">Free<span class=\"dot-green\"></span></p>";
                                    }
                                    else
                                    {
                                        echo "<p class=\"text-lg font-medium text-center\">Busy<span class=\"dot-red\"></span></p>";
                                    }
                                }
                            ?>
                        </div>
                        <div>
                            <form action="car-owner-home.php" method="post">
                                <button type="submit" value="submit1" name="submitx" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-xl font-light">Free</button> 
                                <button type="submit" value="submit2" name="submitx" class="bg-gray-100 mt-2 p-1 w-full drop-shadow-md rounded-xl text-xl font-light">Busy</button>      
                            </form>
                        </div>     
                    </div>
                </div>
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
    </script>
</html>

<?php
    // Adding 1 to status column to denoted rider is free
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        if (isset($_POST["submitx"]) && $_POST["submitx"] == "submit1") {
            $a = 1;
            // **Important:** You need to define the `$uid` variable here.
            // It likely comes from a form submission, session, or some other source.
            // For example, if it's from a POST request:
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
                $insert_stmt = $conn->prepare("UPDATE `customer-info` SET `status` = '1' WHERE `customer-info`.`uid` = ?");
                $insert_stmt->bind_param("s", $uid);
                $executed = $insert_stmt->execute(); // Store the boolean result of execute()

                if ($executed) {
                    if ($insert_stmt->affected_rows > 0) {
                        // Data updated successfully
                        // echo json_encode(['success' => true, 'message' => 'Rider status updated.']);
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
            } else {
                // Handle the case where 'uid' is not provided in the POST request
                // echo json_encode(['success' => false, 'error' => 'User ID (uid) not provided.']);
            }
        }
        // Adding 0 to status column to denoted rider is busy
        elseif (isset($_POST["submitx"]) && $_POST["submitx"] == "submit2"){
             
            // **Important:** You need to define the `$uid` variable here.
            // It likely comes from a form submission, session, or some other source.
            // For example, if it's from a POST request:
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
                $insert_stmt = $conn->prepare("UPDATE `customer-info` SET `status` = '0' WHERE `customer-info`.`uid` = ?");
                $insert_stmt->bind_param("s", $uid);
                $executed = $insert_stmt->execute(); // Store the boolean result of execute()

                if ($executed) {
                    if ($insert_stmt->affected_rows > 0) {
                        // Data updated successfully
                        // echo json_encode(['success' => true, 'message' => 'car owner status updated.']);
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
            } else {
                // Handle the case where 'uid' is not provided in the POST request
                // echo json_encode(['success' => false, 'error' => 'User ID (uid) not provided.']);
            }
        }
        else{
            echo "expression not working";
        }
    }
?>