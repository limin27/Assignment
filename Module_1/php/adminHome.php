<?php
@include 'connect.php';

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

session_start();

if(!isset($_SESSION['admin_name'])){
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
                <span style="vertical-align:bottom; font-size:4vw">KIOSK</span>
                


                <ul id="Navbar">
                    <li id='liNav' class="<?php echo ($currentPage == 'adminHome') ? 'active' : ''; ?>"><a href="adminHome.php" style="text-decoration: none"><b>HOME</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'adminDashboard') ? 'active' : ''; ?>"><a href="adminDashboard.php" style="text-decoration: none"><b>DASHBOARD</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'adminMenu') ? 'active' : ''; ?>"><b>MENU</b></a></li>
                    <li id='liNav' class="<?php echo in_array($currentPage, ['adminUserProfile', 'adminUserProfileUpdate(FoodVendor)', 'adminUserProfileUpdate']) ? 'active' : ''; ?>"><a href="adminUserProfile.php" style="text-decoration: none"><b>USER PROFILE</b></a></li>
                    <li id='liNav' class="<?php echo in_array($currentPage, ['adminApproval', 'adminApprovalUpdate']) ? 'active' : ''; ?>"><a href="adminApproval.php" style="text-decoration: none"><b>APPROVAL</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'adminProfile') ? 'active' : ''; ?>"><a href="adminProfile.php" style="text-decoration: none"><b><?php echo $_SESSION['admin_name'] ?></b></a></li>
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
                      <img src="/Assignment/Module_1/Image/ais kacang.jpeg" alt="satay ikan lokcing" width="200" height="200" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                    </div>

                    <div class="column1">
                      <img src="/Assignment/Module_1/Image/ayam masak merah.jpeg" alt="satay ikan lokcing" width="200" height="200" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                    </div>
                    
                    <div class="column1">
                      <img src="/Assignment/Module_1/Image/Nasi Briyani.jpeg" alt="satay ikan lokcing" width="200" height="200" onclick="window.location.href='https://www.umpsa.edu.my/en';">
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
