<?php
  session_start();
  session_regenerate_id(true); // prevent session fixation
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Lists</title>
    <link rel="stylesheet" href="output.css">
    <style>
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
    .container{
        max-width: 500px;
    }
    .bdy{
        display: grid;
        place-items: center;
        background-color: #f3f4f6;
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
        .cs{
            font-size: x-large;
            font-weight: 600;
            color: blue;
            text-align: center;
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
          <a href="customer's-home2.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Back</a>
          <a href="cust-settings.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
          <a href="./logout.php" class="block px-4 py-2 font-semibold text-red-400 ">logout</a>
      </div>

      <div class="hidden sm:block">
          <ul class="sm:flex sm:flex-row sm:justify-center">
              <li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="customer's-home2.php">Back</a></li>
              <li class="sm:text-xl sm:font-semibold sm:m-4"><a href="cust-settings.php">Settings</a></li>
              <li class="sm:text-xl sm:font-semibold sm:m-4 text-red-400"><a href="./logout.php">logout</a></li>
          </ul>
      </div>
    </header>
    <hr class="w-xl hidden md:block">
    <main class= "mt-1">
      <div class="m-5 pt-6 pb-6">
          <h1 class="text-4xl font-bold text-black ">Hey</h1>
          <h3 class="text-3xl font-semibold text-amber-300">
              <?php // display_user_data.php
                      if (isset($_SESSION['uid'])) {
                          $name = $_SESSION['name'];
                          echo  htmlspecialchars($name) ;
                      }
              ?>
          </h3>
      </div>

      <p class="text-xl font-light text-center m-5">Here is the list of cars available from 
          <?php             
              if ($_SERVER['REQUEST_METHOD'] == 'POST')
              {
                  $from = $_POST['dropdownInput1'];
                  $to = $_POST['dropdownInput2'];
                  echo htmlspecialchars($from); 
              }
          ?> 
          to
          <?php
              echo htmlspecialchars($to);
          ?>
      </p>

        <?php
                require 'db_connect.php';
                $a = 2;
                $stmt= $conn->prepare("SELECT * FROM `customer-info` WHERE `diff`= ?");
                $stmt->bind_param("s", $a);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($from == 'College')
                {
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
                                    <img class="dphoto" src="/image/user.png" alt="Driver Photo">
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
                                    <a href="tel:' . $number . '"><button class="btn">
                                        Book Now
                                    </button></a>
                                </div>
                            </div>';
                        }
                    }                                                                 
                }
                else{
                    echo "<p class=\"cs\">Coming Soon</p>";
                }
                
            ?>
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