<?php
@include 'connect.php';

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

session_start();

if(!isset($_SESSION['foodVendor_name'])){
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/Assignment/Module_1/CSS/mystyle.css">
        <title>Administrator Dashboard</title>
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
                    <li id='liNav' class="<?php echo ($currentPage == 'foodVendorHome') ? 'active' : ''; ?>"><a href="foodVendorHome.php" style="text-decoration: none"><b>HOME</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'foodVendorDashboard') ? 'active' : ''; ?>"><a href="foodVendorDashboard.php" style="text-decoration: none"><b>DASHBOARD</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'foodVendorMenu') ? 'active' : ''; ?>"><b>MENU</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'foodVendorDailyMenu') ? 'active' : ''; ?>"><b>DAILY MENU</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'foodVendorOnlineOrder') ? 'active' : ''; ?>"><b>ONLINE ORDER</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'foodVendorInStore') ? 'active' : ''; ?>"><a href="/Assignment/Module_4/PHP/in_store.php" style="text-decoration: none"><b>IN STORE</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'foodVendorProfile') ? 'active' : ''; ?>"><a href="foodVendorProfile.php" style="text-decoration: none"><b><?php echo $_SESSION['foodVendor_name'] ?></b></a></li>
                </ul>

            </div>
            
        </header>
        <br>

        <hr class="solid">

        <article class="all-browsers">
            <h1>LOGIN</h1>
            <h3>Sign in to continue</h3>
            
        </article>


        <div class="footer">
            <div class="navbar_footer">
                <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
            </div>
        </div>

    </body>
</html>
