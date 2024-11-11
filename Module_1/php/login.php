<?php

require 'connect.php';

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

session_start();

if(isset($_POST['submit']))
{

    $username = $_POST['Username'];
    $password =$_POST['Password'];

 

	$loginquery ="SELECT * FROM user WHERE Username='$username' AND Password='$password'";

        
	$result=mysqli_query($conn, $loginquery);
	$row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) 
    {
        if ($password == $row['Password']) 
        {
            if ($row['status'] == 'Pending') 
            {
                echo "<div class='message'>
					<p>Your account is pending approval. Please wait for admin approval.</p>
				</div> <br>";
                //echo "<a href='login.php'><button class='btn'>Go    
            } 
            
            else 
            {
                $_SESSION["login"] = true;
                $_SESSION["Username"] = $row["Username"];

                if ($row['UserType'] == 'Administrator') 
                {
                    $_SESSION['admin_name'] = $row['Username'];
                    header('location:adminDashboard.php');
                } 
                
                else if ($row['UserType'] == 'Staff' || $row['UserType'] == 'Student') 
                {
                    $_SESSION['registered_name'] = $row['Username'];
                    header('location:registeredDashboard.php');
                } 
                

                else if ($row['UserType'] == 'FoodVendor') 
                {
                    $_SESSION['foodVendor_name'] = $row['Username'];
                    header('location:foodVendorDashboard.php');
                }
            }
        } else {
            echo "<div class='message'>
				<p>Invalid user ID or Password!</p>
			</div> <br>";
        }
    } else {
        echo "<div class='message'>
				<p>User Not Registered!</p>
			</div> <br>";
    }
}
?>

    
<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet" type="text/css" href="/Assignment/Module_1/CSS/mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
    </head>
    <body>
        <header>
            
            <div class="header">
                
            </div>

            <div id="photo" style="text-align: left">
                <img style="vertical-align:middle" src="/Assignment/Module_1/Image/umpsa-textcolor-145.gif" alt="Logo" height="100px" onclick="window.location.href='https://www.umpsa.edu.my/en';">
                <span style="vertical-align:bottom; font-size:4vw">KIOSK</span>


                <ul id="Navbar">
                    <li id='liNav' class="<?php echo ($currentPage == 'homePage') ? 'active' : ''; ?>"><a href="homePage.php" style="text-decoration: none"><b>HOME</b></a></li>
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
            <h1>LOGIN</h1>
            <h3>Sign in to continue</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
            };
            };
            ?>
            <form action="" method="post">
                <div>
                    <P style="text-indent: -175px;">
                        USERNAME<br>
                        <input type="text" name="Username" placeholder="USERNAME"><br>
                    </P>
                    
                </div>

                <div>
                    <P style="text-indent: -175px;">
                        PASSWORD<br>
                        <input type="password" name="Password"
                        minlength="8" required placeholder="PASSWORD"><br>
                    </P>
                    
                </div>
                
                <input type="submit" name="submit" value="Login" class="submitbtn" onclick=""/><br>

                <br><a href="register.php">REGISTER</a>

            </form>
        </article>


        <div class="footer">
            <div class="navbar_footer">
                <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
            </div>
        </div>

    </body>
</html>
