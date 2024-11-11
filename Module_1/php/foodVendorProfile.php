<?php
@include 'connect.php';

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

session_start();

if(!isset($_SESSION['foodVendor_name'])){
   header('location:login.php');
}

if (isset($_POST['submit'])) {
    $userId = $_POST['UserId'];
    $username = $_SESSION['foodVendor_name'];
    $name = $_POST['foodVendorName'];
    $email = $_POST['Email'];
    $password =  $_POST['Password'];
    $businessname =  $_POST['BusinessName'];
    $registerno =  $_POST['RegisterNo'];
    $newProfile = '';

    // Fetch the old profile picture path from the database
    $oldProfileQuery = mysqli_query($conn, "SELECT profilePicture FROM user WHERE UserId='$userId'");
    $row = mysqli_fetch_assoc($oldProfileQuery);
    $oldProfile = $row['profilePicture'];
    $defaultProfilePicture = '../Image/profile.jpg';

    // Check if a new file is selected
    if (!empty($_FILES['newProfile']['name'])) {
        $file_name = $_FILES['newProfile']['name'];
        $temp_name = $_FILES['newProfile']['tmp_name'];
        $file_type = $_FILES['newProfile']['type'];

        // Specify the folder where you want to save the uploaded profile pictures
        $folder = '../Picture/';

        // Create a unique name for the uploaded file
        $newProfile = $folder . $userId . '_' . $file_name;

        // Move the uploaded file to the specified folder
        move_uploaded_file($temp_name, $newProfile);

        // Delete the old profile picture file from the file system
        if (!empty($oldProfile) && file_exists($oldProfile) && $oldProfile !== $defaultProfilePicture) {
            unlink($oldProfile);
        }
    } else {
        if (!empty($oldProfile) && $oldProfile !== $defaultProfilePicture) {
            $newProfile = $oldProfile;
        }
    }

    $result1 = mysqli_query($conn, "UPDATE user u 
                                   JOIN foodVendor fv ON u.UserId = fv.UserId
                                   SET u.Email = '$email', u.Password = '$password', u.profilePicture = '$newProfile', foodVendorName = '$name', fv.BusinessName  = '$businessname', fv.RegisterNo = '$registerno'
                                   WHERE u.Username = '$username';");
    


    if ($result1) {
        echo "<div class='message'>
            <p>Update Successfully</p>
            </div> <br>";
    }
    else{
        die(mysqli_error($conn));
    }
}

if (isset($_POST['deletePicture'])) {
    // Assuming you have a database connection named $conn

    $userId = $_POST['UserId'];
    $deletePicture_query = mysqli_query($conn, "SELECT profilePicture FROM user WHERE UserId='$userId'");

    if ($deletePicture_query) {
        $row = mysqli_fetch_assoc($deletePicture_query);
        $oldProfile = $row['profilePicture'];
        $defaultProfilePicture = '../Image/profile.jpg';

        // Delete the old profile picture file from the file system
        if (!empty($oldProfile) && file_exists($oldProfile) && $oldProfile !== $defaultProfilePicture) {
            unlink($oldProfile);
        }

        // Set the new profile picture path
        $newProfilePicture = "../Image/profile.jpg";

        // Update the database
        $updatePicture_query = mysqli_query($conn, "UPDATE user SET profilePicture = '$newProfilePicture' WHERE UserId='$userId'");

        if ($updatePicture_query) {
            echo "<div class='message'>
                <p>Profile Picture Deleted</p>
                </div> <br>";
        } else {
            echo "Error updating profile picture in the database: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching old profile picture path: " . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/Assignment/Module_1/CSS/mystyle.css">
        <title>Food Vendor Profile</title>
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
        <table>
        <?php
        $username = $_SESSION['foodVendor_name'];
        
        $sql = "SELECT u.UserId, u.Username, u.Email, u.Password, u.profilePicture, fv.foodVendorName, fv.BusinessName, fv.RegisterNo, fv.foodVendorCode, fv.FoodVendorId
                     FROM user u
                     JOIN foodVendor fv ON u.UserId = fv.UserId
                     WHERE u.Username = '$username'";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Error in SQL query: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <script>
                // Set a global variable to store the current profile picture path
                var currentProfilePicture = "<?php echo isset($row['profilePicture']) ? $row['profilePicture'] : ''; ?>";
            </script>
            <form name="fromUser" method="post" action="" enctype="multipart/form-data">
                

                <div>
                    <?php
                    $userQR = '<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $row['Username'] .'">';
                    echo $userQR; ?>
                </div>
                <br>

                <div style="padding-top:5px; padding-bottom:5px">
                    <label for="newProfile"><p>Update Profile Picture </p></label>
                    <div style="padding-top:5px; padding-bottom:5px">
                        <?php
                        $imageFileName = $row['profilePicture'];
                        $imagePath = "../Picture/$imageFileName"; // Change this to the actual path

                        if (file_exists($imagePath)) {
                            echo '<img id="preview" src="' . $imageFileName . '" alt="Profile Picture" style="max-width: 100px; max-height: 100px; display: block; margin: auto;">';
                        } else {
                            // If the file doesn't exist or the filename is empty, show a default image
                            echo '<img id="preview" src="../Image/profile.jpg" alt="Default Profile Picture" style="max-width: 100px; max-height: 100px; display: block; margin: auto;">';
                        }
                        ?>
                        <input type="file" name="newProfile" id="newProfile" onchange="previewImage(this);"><br>
                        <br>
                        </div>

                <input type="hidden" id="currentProfilePicture" value="<?php echo isset($row['profilePicture']) ? $row['profilePicture'] : ''; ?>">

                <div>
                <input type="submit" class="submitbtn" style="width: 200px"  name="deletePicture" value="Delete Profile Picture">
				</div><br>

                <div class="profile input">
                    <label for="UserId">Food Vendor Id</label><br>
                    <input type="text" name="FoodVendorId" value="<?php echo $row['FoodVendorId']; ?>" readonly>
                </div>
                <br>

                <div class="profile input">
                    <label for="UserId">User ID</label><br>
                    <input type="text" name="UserId" value="<?php echo $row['UserId']; ?>" readonly>
                </div>
                <br>

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

                <div class="profile input">
                    <label for="Password">Password</label><br>
                    <input type="text" name="Password" value="<?php echo $row['Password']; ?>" required>
                </div>
                <br>

                <div class="profile input">
                    <label for="BusinessName">Business Name</label><br>
                    <input type="text" name="BusinessName" value="<?php echo $row['BusinessName']; ?>" required>
                </div>
                <br>
            
                <div class="profile input">
                    <label for="RegisterNo">Register No</label><br>
                    <input type="text" name="RegisterNo" value="<?php echo $row['RegisterNo']; ?>" required>
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

    <script>
    
    function previewImage(input) {
    var preview = document.getElementById('preview');
    var currentProfilePicture = document.getElementById('currentProfilePicture').value;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // If no file is selected, show the current profile picture
        preview.src = currentProfilePicture;
        preview.style.display = 'block';
    }
    }
    </script>
</html>
