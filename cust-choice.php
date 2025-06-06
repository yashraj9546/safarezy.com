<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./output.css">
    <style>
        .container{
            max-width: 500px;
            padding-bottom: auto;
            padding-bottom: 40vh;
        }
        .bdy{
            display: grid;
            place-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, #dbeafe, #ccfbf1);
        }
        #menu {
            /* Smooth animation styles */
            overflow: hidden;
            transition-property: all;
            transition-duration: 300ms;
            transition-timing-function: ease-in-out;
            transform-origin: top;
            transform: scaleY(0);
        }

        #menu.hidden {
        opacity: 0;
        visibility: hidden;
        }
        .outcard{
            display: grid;
            place-items: center;
            gap: 24px;
            width: 100%;
            max-width: 320px;
            margin-top: 50px;
        }
        .card{
            transition-property: transform, translate, scale, rotate;
            transition-timing-function: var(--tw-ease, var(--default-transition-timing-function) /* cubic-bezier(0.4, 0, 0.2, 1) */);
            transition-duration: var(--tw-duration, var(--default-transition-duration) /* 150ms */);
            width: 80vw;
            padding: calc(var(--spacing) * 6);
            box-shadow: #6a7282;
            border-radius: 16px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10vw;
            margin-right: 10vw;

        }
        .card:hover {
            scale: 105%;
        }
        .txauto{
            font-size: 20px;
            font-weight: 600;
        }
        .sv{
            width: calc(var(--spacing) * 6);
            height: calc(var(--spacing) * 6);
            color: #6a7282;
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
        </header>
        <main>
            <div class="grid place-items-center mt-20 min-h-1/4">

                <h1 class="text-4xl font-bold text-black ">Hey 
                <?php // display_user_data.php
                        session_start();
                        session_regenerate_id(true); // prevent session fixation
                        if (isset($_SESSION['uid'])) {
                            $name = $_SESSION['name'];
                            echo  htmlspecialchars($name) ;
                        }
                ?>
                </h1>
                <p class="text-lg text-gray-600 mb-8">Choose Your Ride</p>
            </div>
             
            <div class="outcard">
                <div class="card">
                    <span class="txauto"><a href="customer's-home.php">🛺 Auto</a></span>
                    <svg class="sv" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="card">
                    <span class="txauto"><a href="customer's-home2.php">🚗 Car</a></span> 
                    <svg class="sv" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
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

    // Add or remove classes for smooth animation
    if (!menu.classList.contains('hidden')) {
      menu.classList.remove('scale-y-0');
    } else {
      menu.classList.add('scale-y-0');
    }

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
</html>
