<?php
  session_start();
  session_regenerate_id(true); // prevent session fixation
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider's Lists</title>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="./rating.js"></script>
  </head>

<style>
  .container{
        max-width: 500px;
  }
  .bdy{
    display: grid;
    place-items: center;
    background-color: #f3f4f6;
  }
          .ddb{
            margin: 16px;
            font-size: 48px;
            font-weight: 500;
        }
        @media (width >= 640px) {
            .ddb{
                display: none;
            }
            .card{
                max-width: 25vw;
            }
        }
        .ddb-cont{
            display: hidden;
            position: absolute;
            left: 0px;
            margin-top: 8px;
            width: 192px;
            background-color: white;
            border-width: 1px;
            border-color: #e5e7eb;
            border-radius: 6px;
            box-shadow: #e5e7eb;
        }
        @media (width >= 640px) {
            .ddb-cont{
                display: hidden;
            }
        }
        .back{
            display: block;
            padding-inline: 16px;
            padding-block: 8px;
            color: #1e2939;
        }
        .back:hover {
            background-color: #e5e7eb;
        }
        .logout{
            display: block;
            padding-inline: 16px;
            padding-block: 8px;
            font-weight: 600;
            color: oklch(70.4% 0.191 22.216);
        }
        .hey{
            font-size: 36px;
            font-weight: 700;
            color: #000000;
        }
        .name{
            font-size: 30px;
            font-weight: 600;
            color: oklch(87.9% 0.169 91.605);
        }
        .here{
            font-size: 20px;
            font-weight: 300;
            text-align: center;
            margin: 20px;
        }
        .card{
            width: 80vw;
            margin: 40px;
            margin-inline: auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: var(--tw-inset-shadow), var(--tw-inset-ring-shadow), var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow);
            overflow: hidden;
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
            margin-right: 15px;
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
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .freetxt{
            font-size: 24px;
        }
        .btn{
            margin-top: 30px;
            background-color: #155dfc;
            color: #ffffff;
            font-weight: 600;
            padding-inline: 16px;
            padding-block: 8px;
            border-radius: 8px;
        }

        .rating-section {
            margin-top: 20px;
            border-top: 1px solid #eee;
        }

        .stars {
            font-size: 2em;
            color: #ccc; /* Default star color (unfilled) */
            cursor: pointer;
            margin-bottom: 15px;
        }

        .stars i {
            transition: color 0.2s ease-in-out;
        }

        .stars i:hover,
        .stars i.hovered {
            color: #ffc107; /* Gold color on hover */
        }

        .stars i.filled {
            color: #ffc107; /* Gold color for filled stars */
        }

        #rating-message {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        .average-rating {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .display-stars-container i {
            font-size: 1.5em;
            color: #ffc107; /* Gold color for display stars */
        }
        .downarr{
            display: grid;
            place-items: center;
        }
</style>
<body class="bdy">
  <div class="container">
    <header>
      <div>
          <button id="dropdownButton" class="m-4 text-5xl font-medium sm:hidden">&#8801;</button>
      </div>
          <!-- Dropdown Menu -->
      <div id="dropdownMenu" class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
          <a href="customer's-home.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Back</a>
          <a href="cust-settings.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
          <a href="./logout.php" class="block px-4 py-2 font-semibold text-red-400 ">logout</a>
      </div>

      <div class="hidden md:block">
          <ul class="sm:flex sm:flex-row sm:justify-center">
              <li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="customer's-home.php">Back</a></li>
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
                          $uid = $_SESSION['uid'];
                          $name = $_SESSION['name'];
                          echo  htmlspecialchars($name) ;
                      }
              ?>
          </h3>
      </div>

      <p class="text-xl font-light text-center m-5">Here is the list of auto-drivers available from 
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
      
      <div class="mt-7">
                <?php
                  require 'db_connect.php';
                  $a = 1;
                  $b = 1;
                  $stmt= $conn->prepare("SELECT * FROM `customer-info` WHERE `status`= ? and `diff`= ? and `location`= ? ");
                  $stmt->bind_param("sss",$a,$b, $from);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if($result->num_rows > 0)
                  {                                                                 
                  while($row = mysqli_fetch_assoc($result))
                  {   
                    if ($row['mob.no'] != 0)                                     
                    {
                        $name = $row['name'];
                        $number= $row['mob.no'];
                        $riderId = $row['uid'];
                        if(!$name)
                        {
                          break;
                        }
                        echo '<div class="card" data-rider-id="'.htmlspecialchars($riderId).'">
                              <div class="info">
                                  <img class="dphoto" src="/image/user.png" alt="Driver Photo">
                                  <div>
                                      <h2 class="dname">'.$name.'</h2>
                                  </div>
                              </div>
                              <div class="freebtn">
                                  <div class="average-rating">
                                          <h3>Average Rating: <span class="avg-rating-display"></span></h3>
                                          <div class="display-stars-container">
                                              </div>
                                  </div>
                                  <a href="tel:' . $number . '"><button class="btn">
                                      Book Now
                                  </button></a>
                              </div>
                              <div class="downarr">
                                  <span style="font-size:20px;" class="dwn-arrow">&#9660;</span>
                              </div>
                              <div class="rating-section hidden">
                                  <h2>Rate this rider</h2>
                                  <div class="stars">
                                      <i class="fa-regular fa-star" data-rating="1"></i>
                                      <i class="fa-regular fa-star" data-rating="2"></i>
                                      <i class="fa-regular fa-star" data-rating="3"></i>
                                      <i class="fa-regular fa-star" data-rating="4"></i>
                                      <i class="fa-regular fa-star" data-rating="5"></i>
                                  </div>
                                  <div class="rating-message"></div>
                              </div>
                          </div>';
                    }
                    
                  }
                }
                
              ?>
      </div>
    </main>
  </div>
</body>
</html>