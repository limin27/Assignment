<?php

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

require 'connect.php';

session_start();

if (isset($_POST['submit'])) {

    $userId = mysqli_real_escape_string($conn, $_GET['user_upd']);
    $name = $_POST['foodVendorName'];
    $email = $_POST['Email'];
    $status =  $_POST['status'];
    
   

    $result1 = mysqli_query($conn, "UPDATE user u
                                   JOIN foodVendor fv ON u.UserId = fv.UserId
                                   SET u.Email = '$email', fv.foodVendorName = '$name', u.status = '$status'
                                   WHERE fv.UserId = '$userId'");
    


    if ($result1) {
        echo "<div class='message'>
            <p>Update Successfully</p>
            </div> <br>";
            header('location:adminUserProfile.php');
    }
    else{
        die(mysqli_error($conn));
    }
}

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}


?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/Assignment/Module_1/CSS/mystyle.css">
        <title>Administrator Approval</title>
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
        <article class="all-browsers">    
        <h1><u>APPROVAL LIST</u></h1>
        <table>
        <?php
        $userId = mysqli_real_escape_string($conn, $_GET['user_upd']);
        echo "User Id: $userId"; // Add this line for debugging
        
        $sql = "SELECT u.Username, u.Email, u.status, fv.foodVendorName
                     FROM user u
                     JOIN foodVendor fv ON u.UserId = fv.UserId
                     WHERE fv.UserId = '$userId'";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Error in SQL query: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form name="fromUser" method="post" action="">
                
                <div class="profile input">
                    <label for="Username">Username</label><br>
                    <input type="text" name="Username" value="<?php echo $row['Username']; ?>" readonly>
                </div>
                <br>

                <div class="profile input">
                    <label for="foodVendorName">Name</label><br>
                    <input type="text" name="foodVendorName" value="<?php echo $row['foodVendorName']; ?>" required>
                </div>
                <br>

                <div class="profile input">
                    <label for="Email">Email</label><br>
                    <input type="text" name="Email" value="<?php echo $row['Email']; ?>" required>
                </div>
                <br>

                <div>
                    <P>
                        Status<br>
                        <select name="status" class="select1" >
                            <option value="selected" disabled selected required>Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Approve">Approve</option>
                        </select><br>
                    </P>                 
                </div>
                <br>
            
                <input type="submit" name="submit" value="UPDATE" class="submitbtn" />
            
            </form>
            <?php
        }
        ?>
        </table>

                
        </article>

        


        <div class="footer">
            <div class="navbar_footer">
                <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
            </div>
        </div>

    </body>
</html>
