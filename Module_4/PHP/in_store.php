
<?php
require 'connect2.php';

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
session_start();

// Function to calculate and update the total amount
function updateTotalAmount($sellingList) {
    $total = 0;

    foreach ($sellingList as $item) {
        $total += $item['totalPrice'];
    }

    return $total;
}

// Initialize sellingList
$sellingList = [];

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $storeOrderID = $_POST["StoreOrderID"];
    $userID = $_POST["UserID"];
    $generalUserID = $_POST["GeneralUserID"];
    $foodVendorID = $_POST["FoodVendorID"];
    $menuID = $_POST["MenuID"];
    $OrderDate = $_POST["OrderDate"];

    // Calculate the total amount
    $totalAmount = updateTotalAmount($sellingList);

    // Insert data into the storeorder table
    $query = "INSERT INTO storeorder (StoreOrderID, UserID, GeneralUserID, FoodVendorID, MenuID, OrderDate, TotalAmount) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
    
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "iiiiid", $StoreOrderID, $UserID, $GeneralUserID, $FoodVendorID, $MenuID, $TotalAmount);

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Check for errors
    if (mysqli_errno($conn) > 0) {
        echo "Error: " . mysqli_error($conn);
    } else {
        echo "<script>alert('Data Inserted');</script>";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

if(!isset($_SESSION['foodVendor_name'])){
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Assignment/Module_4/CSS/mystyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Store Page</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Function to add a new row to the table
        function addRow() {
            var newRow = $("<tr>");
            var itemsDropdown = '<td><select name="selectedItem[]"><option value="item1">Sate Ikan Lokcing</option><option value="item2">Sepit Ketam</option><option value="item3">Chicken Sandwich</option><option value="item4">Sosej Bakar Pulut</option></select></td>';
            var quantityInput = '<td><input type="number" name="quantity[]"></td>';
            var priceInput = '<td><input type="text" name="price[]" oninput="updateTotal()"></td>';
            var removeButton = '<td><button type="button" onclick="removeRow(this)">Remove</button></td>';
            
            newRow.append(itemsDropdown, quantityInput, priceInput, removeButton);
            $("table tbody").append(newRow);
        }

        // Function to remove the current row
        function removeRow(button) {
            $(button).closest("tr").remove();
            updateTotal(); // Update total when a row is removed
        }

        // Function to update the total amount
        function updateTotal() {
            var total = 0;
            $("input[name='price[]']").each(function() {
                var price = parseFloat($(this).val()) || 0;
                total += price;
            });
            $("#totalAmount").text("Total Amount: " + total.toFixed(2));
        }
		
		function updateList() {
        $("form").submit(); 
		}
		
		function goToReceipt() {
            window.location.href = 'receipt.php'; //
        }
    </script>
</head>
<body>
<header>
    <div class="header"></div>
    <div class="header">
        <a href="/Assignment/Module_1/php/logout.php" style="text-decoration: none"><button class= "button1">Log Out</button></a>
    </div>
    <div id="photo" style="text-align: left">
        <img style="vertical-align:middle" src="/Assignment/Module_4/Image/umpsa-textcolor-145.gif" alt="Logo" height="100px" onclick="window.location.href='https://www.umpsa.edu.my/en';">
        <span style="vertical-align:bottom; font-size:3vw">KIOSK</span>
        <ul id="Navbar">
            <li id='liNav' class="<?php echo ($currentPage == 'foodVendorHome') ? 'active' : ''; ?>"><a href="/Assignment/Module_1/php/foodVendorHome.php" style="text-decoration: none"><b>HOME</b></a></li>
            <li id='liNav' class="<?php echo ($currentPage == 'foodVendorDashboard') ? 'active' : ''; ?>"><a href="/Assignment/Module_1/php/foodVendorDashboard.php" style="text-decoration: none"><b>DASHBOARD</b></a></li>
            <li id='liNav' class="<?php echo ($currentPage == 'menu') ? 'active' : ''; ?>"><b>MENU</b></a></li>
            <li id='liNav' class="<?php echo ($currentPage == 'foodVendorDailyMenu') ? 'active' : ''; ?>"><b>DAILY MENU</b></a></li>
            <li id='liNav' class="<?php echo ($currentPage == 'online_order') ? 'active' : ''; ?>"><b>ONLINE ORDER</b></a></li>
            <li id='liNav' class="<?php echo ($currentPage == 'in_store') ? 'active' : ''; ?>"><a href="in_store.php" style="text-decoration: none"><b>IN STORE</b></a></li>
            <li id='liNav' class="<?php echo ($currentPage == 'foodVendorHome') ? 'active' : ''; ?>"><a href="/Assignment/Module_1/php/foodVendorProfile.php" style="text-decoration: none"><b><?php echo $_SESSION['foodVendor_name'] ?></b></a></li>
        </ul>
    </div>
</header>
<br>

<hr class="solid"><br>

<h2>SELECT PAYMENT TYPE:</h2>
<input type="radio" name="paymentType" value="cash">CASH
<br>
<input type="radio" name="paymentType" value="card">CARD<br>
<br>



<h2>SELLING LIST:</h2>

<table border="1">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <select name="selectedItem[]">
                    <option value="item1">Sate Ikan Lokcing</option>
                    <option value="item2">Sepit Ketam</option>
                    <option value="item3">Chicken Sandwich</option>
                    <option value="item4">Sosej Bakar Pulut</option>
                </select>
            </td>
            <td><input type="number" name="quantity[]"></td>
            <td><input type="text" name="price[]" oninput="updateTotal()"></td>
        </tr>
    </tbody>
</table>

<button type="button" onclick="addRow()">Add New Row</button><br>
<br>

    <br>
	<form class="" action="" method="post">
	<label for="storeOrderID">Store Order ID:</label>
    <input type="text" name="StoreOrderID" required><br>
	
    <label for="userID">User ID:</label>
    <input type="text" name="UserID" required><br>

    <label for="generalUserID">General User ID:</label>
    <input type="text" name="GeneralUserID" required><br>

    <label for="foodVendorID">Food Vendor ID:</label>
    <input type="text" name="FoodVendorID" required><br>

	<label for="menuID">Menu ID:</label>
    <input type="text" name="MenuID" required><br>
	
	<label for="menuID">Order Date:</label>
    <input type="date" name="OrderDate" required><br>
	<br>
	<button type="button" onclick="updateList()" class="updateButton">Update List</button><br>
	
	</form>
<p id="totalAmount">Total Amount: 0.00</p>


<div>
    <button type="button" name="finishOrder" class="button" onclick="goToReceipt()">Finish order</button>
</div>
<br>
<div class="footer">
    <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector('.updateButton').addEventListener('click', updateList);
    });
</script>

</body>
</html>