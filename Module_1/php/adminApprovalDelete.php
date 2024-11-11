<?php
@include 'connect.php';
error_reporting(0);
session_start();

// Fetch the profile picture file path from the database
$query = "SELECT profilePicture FROM user WHERE UserId = '".$_GET['user_del']."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$profilePicturePath = $row['profilePicture'];

// sending query
mysqli_query($conn,"DELETE FROM registereduser WHERE UserId = '".$_GET['user_del']."'");
mysqli_query($conn,"DELETE FROM foodvendor WHERE UserId = '".$_GET['user_del']."'");
mysqli_query($conn,"DELETE FROM administrator WHERE UserId = '".$_GET['user_del']."'");
mysqli_query($conn,"DELETE FROM user WHERE UserId = '".$_GET['user_del']."'");
mysqli_query($conn, "DELETE FROM membershipcard WHERE MemberShipCardId = '$membershipCardIdToDelete'");



// Delete the profile picture file if it exists
$defaultProfilePicture = '../Image/profile.jpg';
if (!empty($profilePicturePath) && $profilePicturePath !== $defaultProfilePicture && file_exists($profilePicturePath)) {
    unlink($profilePicturePath);
}

header("location:adminApproval.php");  

?>


