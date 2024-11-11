<?php

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

require 'connect.php';

session_start();

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
                <table id="userlistTable" class="userlistTable">
                    <thead>
                        <tr>
                            <th >USER ID</th>
                            <th >USERNAME</th>
                            <th >USER TYPE</th>
                            <th >APPROVAL</th>
                            <th >OPERATIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql="SELECT * FROM user WHERE status = 'Pending'";
                        $result = mysqli_query($conn, $sql);

                        if(!mysqli_num_rows($result) > 0){
                            echo '<td colspan="7"><center>No User-Data!</center></td>';
                        }else
                        {				
                                    while($rows=mysqli_fetch_array($result))
                                        {
                                                    
                                                
                                                
                                                    echo ' <tr><td>'.$rows['UserId'].'</td>
                                                                <td>'.$rows['Username'].'</td>
                                                                <td>'.$rows['UserType'].'</td>
                                                                <td>'.$rows['status'].'</td>
                                
                                                                     <td><a href="adminApprovalDelete.php?user_del='.$rows['UserId'].'" class="userbtn">REJECT</a> 
                                                                     <a href="adminApprovalUpdate.php?user_upd='.$rows['UserId'].'"  class="userbtn">UPDATE</a> 
                                                                    </td></tr>';
                                                     
                                                        
                                                        
                                        }	
                        }
                

                        ?>
                        
                    </tbody>
                </table>

                
        </article>

        


        <div class="footer">
            <div class="navbar_footer">
                <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
            </div>
        </div>

    </body>
</html>
