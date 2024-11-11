<?php

require 'connect.php';

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

session_start();
if(!isset($_SESSION['registered_name'])){
    header('location:login.php');
 }
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="/Assignment/Module_1/CSS/mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
    </head>
    <body>
        <header>
            
            <div class="header">
                <a href="logout.php" style="text-decoration: none"><button class= "button">Log Out</button></a>
            </div>


            <div id="photo" style="text-align: left">
                <img style="vertical-align:middle" src="/Assignment/Module_1/Image/umpsa-textcolor-145.gif" alt="Logo" height="100px" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                <span style="vertical-align:bottom; font-size:3vw">KIOSK</span>


                <ul id="Navbar">
                    <li id='liNav' class="<?php echo ($currentPage == 'registeredHome') ? 'active' : ''; ?>"><a href="registeredHome.php" style="text-decoration: none"><b>HOME</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'registeredDashboard') ? 'active' : ''; ?>"><a href="registeredDashboard.php" style="text-decoration: none"><b>DASHBOARD</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'adminMenu') ? 'active' : ''; ?>"><b>MENU</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'adminUserProfile') ? 'active' : ''; ?>"><b>ORDER ONLINE</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'adminApproval') ? 'active' : ''; ?>"><b>MEMBERSHIP</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'registeredProfile') ? 'active' : ''; ?>"><a href="registeredProfile.php" style="text-decoration: none"><b><?php echo $_SESSION['registered_name'] ?></b></a></li>
                    </li>
                </ul>

            </div>
            
        </header>
        <br>

        <hr class="solid">

        <div>
            <article class="all-browsers">
                <img id="photo" src="/Assignment/Module_1/Image/satay ikan lokcing.png" alt="satay ikan lokcing" width="1300" height="600" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                <br>
                <br>
                <br>
                <div>
                    <h1 style="text-align: left;">Popular Food</h1>
                </div>

                <div class="row">
                    <div class="column">
                        <p style="text-align: right;"><a href="login.html" class="button1">SHOP NOW</a></p>
                    </div>

                    <div class="column1">
                      <img src="/Assignment/Module_1/Image/ais kacang.jpeg" alt="ais kacang" width="200" height="200" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                    </div>

                    <div class="column1">
                      <img src="/Assignment/Module_1/Image/ayam masak merah.jpeg" alt="ayam masak merah" width="200" height="200" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                    </div>
                    
                    <div class="column1">
                      <img src="/Assignment/Module_1/Image/Nasi Briyani.jpeg" alt="Nasi Briyani" width="200" height="200" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                    </div>

                    
                </div>



                
                
                   
                
            </article>
        </div>


        <div class="footer">
            <div class="navbar_footer">
                <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
            </div>
        </div>

    </body>
</html>
