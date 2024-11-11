<?php

require 'connect.php';

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

session_start();

if(isset($_POST['submit']))
{
    $name = $_POST['Name'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $usertype = $_POST['UserType'];
    $userQR = "";
    $defaultStatus = null;
    $FoodVendorId = "";
    $result1 = "";
    $userProfile = '';
    $menuId = "NULL";
    $defaultProfilePicture = "../Image/profile.jpg";

    if (!empty($_FILES['userProfile']['name'])) {
        $file_name = $_FILES['userProfile']['name'];
        $temp_name = $_FILES['userProfile']['tmp_name'];
        $file_type = $_FILES['userProfile']['type'];

        // Specify the folder where you want to save the uploaded profile pictures
        $folder = '../Picture/';

        // Create a unique name for the uploaded file
        $userProfile = $folder . $username . '_' . $file_name;

        // Move the uploaded file to the specified folder
        move_uploaded_file($temp_name, $userProfile);
    } else {
        // Use the default picture
        $userProfile = $defaultProfilePicture;
    }

    if ($usertype == "FoodVendor") 
    {
        $defaultStatus = "Pending";
    }

	$verify_query = mysqli_query($conn, "SELECT Email FROM user where Email = '$email' ");
    $verify1_query = mysqli_query($conn, "SELECT Username FROM user where Username = '$username' ");

    if(mysqli_num_rows($verify_query) != 0)
     {
    	echo "<div class = 'message'>
                <p> 'Email Already exists!'</p>
            </div><br>";

    } else {
        if(mysqli_num_rows($verify1_query) != 0)
        {
    	    echo "<div class = 'message'>
                <p> 'Username Already exists!'</p>
                </div><br>";

        } else {
            $highest_userId_Query3 = mysqli_query($conn, "SELECT MAX(SUBSTRING(UserId, 2)) AS maxnumeric_id3 FROM user");
		    $row3 = mysqli_fetch_assoc($highest_userId_Query3);
		    $highest_numeric_id3 = (int)$row3['maxnumeric_id3'];

		    $new_numeric_id3 = $highest_numeric_id3 + 1;

		    $newuser_id3 = 'U' . str_pad($new_numeric_id3, 4, '0', STR_PAD_LEFT);   

            $query = "INSERT INTO user (UserId, Username, Password, Email, UserType, status, profilePicture) VALUES ('$newuser_id3', '$username', '$password', '$email','$usertype', '$defaultStatus', '$userProfile')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Error Occurred" . mysqli_error($conn));
            }
        
            $userQR = '<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $username .'">';
            $query2 = "";

            if ($usertype == "Administrator") {
                $highest_AdminId_Query = mysqli_query($conn, "SELECT MAX(SUBSTRING(AdminId, 3)) AS maxnumeric_id FROM administrator");
                $row = mysqli_fetch_assoc($highest_AdminId_Query);
                $highest_numeric_id = (int)$row['maxnumeric_id'];

                $new_numeric_id = $highest_numeric_id + 1;

                $newadmin_id = 'AD' . str_pad($new_numeric_id, 4, '0', STR_PAD_LEFT);

                $query1 = "INSERT INTO administrator (AdminId, UserId, adminName) VALUES ('$newadmin_id', '$newuser_id3', '$name')";

            } elseif ($usertype == "Staff" || $usertype == "Student") {
                $highest_rUserId_Query = mysqli_query($conn, "SELECT MAX(SUBSTRING(rUserId, 3)) AS maxnumeric_id FROM registereduser");
		        $row = mysqli_fetch_assoc($highest_rUserId_Query);
		        $highest_numeric_id = (int)$row['maxnumeric_id'];

		        $new_numeric_id = $highest_numeric_id + 1;

		        $newruser_id = 'RU' . str_pad($new_numeric_id, 4, '0', STR_PAD_LEFT); 

                $highest_MemberShipCardId_Query = mysqli_query($conn, "SELECT MAX(SUBSTRING(MemberShipCardId, 3)) AS maxnumeric_id1 FROM membershipcard");
		        $row1 = mysqli_fetch_assoc($highest_MemberShipCardId_Query);
		        $highest_numeric_id1 = (int)$row1['maxnumeric_id1'];

		        $new_numeric_id1 = $highest_numeric_id1 + 1;

		        $newMemberShipCard_id = 'MP' . str_pad($new_numeric_id1, 4, '0', STR_PAD_LEFT); 

                $query1 = "INSERT INTO registereduser (rUserId, UserId, MemberShipCardId, registeredName, registeredCode) VALUES ('$newruser_id', '$newuser_id3', '$newMemberShipCard_id', '$name', '$userQR')";
                $query2 = "INSERT INTO membershipcard (MemberShipCardId) VALUES ('$newMemberShipCard_id')";

            
            } elseif ($usertype == "FoodVendor") {
                $highest_FoodVendorId_Query = mysqli_query($conn, "SELECT MAX(SUBSTRING(FoodVendorId, 3)) AS maxnumeric_id FROM foodvendor");
		        $row = mysqli_fetch_assoc($highest_FoodVendorId_Query);
		        $highest_numeric_id = (int)$row['maxnumeric_id'];

		        $new_numeric_id = $highest_numeric_id + 1;

		        $newfoodvendor_id = 'FV' . str_pad($new_numeric_id, 4, '0', STR_PAD_LEFT);

                $query1 = "INSERT INTO foodvendor (FoodVendorId, UserId, foodVendorName, foodVendorCode) VALUES ('$newfoodvendor_id', '$newuser_id3', '$name', '$userQR')";
            }

            if (!empty($query2)) {
                $result2 = mysqli_query($conn, $query2);
            
                if (!$result2) {
                    die("Error Occurred" . mysqli_error($conn));
                }
            }
            $result1 = mysqli_query($conn, $query1);


        
            if (!$result1) {
                die("Error Occurred" . mysqli_error($conn));
            }

            
            echo "<div class='message'>
            <p>Registration successful!</p>
            </div><br>";
        }    
    }
}
?>

    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/Assignment/Module_1/CSS/mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Page</title>
    </head>
    <body>
        <header>
            
            <div class="header">
                
            </div>

            <div id="photo" style="text-align: left">
                <img style="vertical-align:middle" src="/Assignment/Module_1/Image/umpsa-textcolor-145.gif" alt="Logo" height="100px" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                <span style="vertical-align:bottom; font-size:4vw">KIOSK</span>


                <ul id="Navbar">
                    <li id='liNav' class="<?php echo ($currentPage == 'home') ? 'active' : ''; ?>"><a href="home.php" style="text-decoration: none"><b>HOME</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'adminDashboard') ? 'active' : ''; ?>"><a href="adminDashboard.php" style="text-decoration: none"><b>DASHBOARD</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'menu') ? 'active' : ''; ?>"><b>MENU</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'online_order') ? 'active' : ''; ?>"><b>ONLINE ORDER</b></a></li>
                    <li id='liNav' class="<?php echo ($currentPage == 'in_store') ? 'active' : ''; ?>"><b>IN STORE</b></a></li>
                    <li id='liNav' class="<?php echo in_array($currentPage, ['login', 'register']) ? 'active' : ''; ?>"><a href="login.php" style="text-decoration: none"><b>LOGIN</b></a></li>
                </ul>

            </div>
            
        </header>
        <br>

        <hr class="solid">

        <article class="all-browsers">
        <h1>Create New Account</h1>
            <h3>Already Regiested? <a href="login.php">Login</a></h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div>
                    <P style="text-indent: -215px;">
                        NAME<br>
                        <input type="text" name="Name" placeholder="Name"><br>
                    </P>                     
                </div>
                <div>
                    <P style="text-indent: -175px;">
                        USERNAME<br>
                        <input type="text" name="Username" placeholder="Username"><br>
                    </P>                     
                </div>

                <div>
                    <P style="text-indent: -215px;">
                        EMAIL<br>
                        <input type="text" name="Email" placeholder="xxx@gmail.com"><br>
                    </P>                    
                </div>

                <div>
                    <P style="text-indent: -175px;">
                        PASSWORD<br>
                        <input type="password" name="Password"
                        minlength="8" required placeholder="Password"><br>
                    </P>                    
                </div>

                <label for="userProfile"><p style="text-indent: -180px;">Profile Picture</p></label><br>
                <div style="text-align: center;">
                    <img id="preview" src="../Image/profile.jpg" alt="Preview" style="max-width: 100px; max-height: 100px; display: block; margin: auto;"><br>
                    <input type="file" name="userProfile" id="userProfile" onchange="previewImage(this);"><br>
                </div>


                <div>
                    <P style="text-indent: -180px;">
                        USER TYPE<br>
                        <select name="UserType" class="select" >
                            <option value="selected" disabled selected required>Select User Type</option>
                            <option value="Staff">Staff</option>
                            <option value="Student">Student</option>
                            <option value="FoodVendor">Food Vendor</option>
                        </select><br>
                    </P>                 
                </div>
                
                <input type="submit" name="submit" value="Register" class="submitbtn" onclick=""/><br>

            </form>
        </article>


        <div class="footer">
            <div class="navbar_footer">
                <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
            </div>
        </div>

    </body>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }else {
                // If no file is selected, show the default image
                preview.src = '../Image/profile.jpg';
                preview.style.display = 'block';
            }            
        }
    </script>


</html>
