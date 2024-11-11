<?php
@include 'connect.php';

// Define $currentPage based on the current file name
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}

$sql="SELECT count(UserId) AS total FROM user ";
                    $result=mysqli_query($conn,$sql);
                    $values = mysqli_fetch_assoc($result);
                    $num_rows = $values['total'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administration Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
        <!-- Datatables -->
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.5/fc-4.3.0/fh-3.4.0/datatables.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.5/fc-4.3.0/fh-3.4.0/datatables.min.js"></script>
   
        <!-- Apex Chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 
        <!-- Font-Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link rel="stylesheet" type="text/css" href="/Assignment/Module_1/CSS/mystyle.css">
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
            <table class="calTable" style="font-size: 20px; text-align: center;">
                <form id="resultForm">
                    <div class="row mb-3">

                        <div class="col-lg-3">
                            <div class="card bg-primary mb-2">
                                <div class="card-body text-white">
                                    <p class="h3 text-muted">Total Number of User</p>
                                    <p class="h2"><?php echo $num_rows;?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="card bg-secondary mb-2">
                                <div class="card-body text-white">
                                    <p class="h3 text-muted">Admin</p>
                                    <p class="h2"><?php
												$sql = "SELECT count(*) FROM user WHERE usertype='Administrator'";
												$result = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($result)) {
													echo $row['count(*)'];
												}?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="card bg-danger mb-2">
                                <div class="card-body text-white">
                                    <p class="h3 text-muted">Staff</p>
                                    <p class = "h2"><?php
												$sql = "SELECT count(*) FROM user u
                                                INNER JOIN registereduser ru WHERE u.UserId = ru.UserId && u.usertype ='Staff'";
												$result = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($result)) {
													echo $row['count(*)'];
												}?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="card bg-success mb-2">
                                <div class="card-body text-white">
                                    <p class="h3 text-muted">Student</p>
                                    <p class="h2"><?php
												$sql = "SELECT count(*) FROM user u
                                                INNER JOIN registereduser ru WHERE u.UserId = ru.UserId && u.usertype ='Student'";
												$result = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($result)) {
													echo $row['count(*)'];
												}?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card bg-success mb-2">
                                <div class="card-body text-white">
                                    <p class="h3 text-muted">Approve/ Total Food Vendor</p>
                                    <div class="h2">
                                        <span id="ship_total" class="fw-bold"></span><?php
												$sql = "SELECT count(*) FROM user u
                                                INNER JOIN foodvendor  fv WHERE u.UserId = fv.UserId && u.status ='Approve'";
												$result = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($result)) {
													echo $row['count(*)'];
												}?></span>
                                                /
                                        <span id="ship_total" class="fw-bold"></span><?php
                                                 $sql = "SELECT count(*) FROM user u
                                                INNER JOIN foodvendor  fv WHERE u.UserId = fv.UserId";
												$result = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($result)) {
													echo $row['count(*)'];
												}?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Chart 1 -->
                        <div class="col-lg-6">
                            <div class="card text-primary bg-primary-subtle mb-3">
                                <div class="card-header h4">ALL USER</div>
                                <div class="card-body">
                                    <div id="myChart"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart 2 -->
                        <div class="col-lg-6">
                            <div class="card text-warning bg-info mb-3">
                                <div class="card-header h4">FOOD VENDOR</div>
                                <div class="card-body">
                                    <div id="barchart"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $query = "SELECT * FROM administrator" or die(mysqli_connect_error());
                        $result = mysqli_query($conn, $query);
                        $query1 = "SELECT * FROM user u INNER JOIN foodvendor  fv WHERE u.UserId = fv.UserId && u.status ='Pending'" or die(mysqli_connect_error());
                        $result1 = mysqli_query($conn, $query1);
                        $query2 = "SELECT * FROM user u INNER JOIN foodvendor  fv WHERE u.UserId = fv.UserId && u.status ='Approve'" or die(mysqli_connect_error());
                        $result2 = mysqli_query($conn, $query2);
                        $query3 = "SELECT * FROM user u INNER JOIN registereduser ru WHERE u.UserId = ru.UserId && u.usertype ='Staff'" or die(mysqli_connect_error());
                        $result3 = mysqli_query($conn, $query3);
                        $query4 = "SELECT * FROM user u INNER JOIN registereduser ru WHERE u.UserId = ru.UserId && u.usertype ='Student'" or die(mysqli_connect_error());
                        $result4 = mysqli_query($conn, $query4);
                        $query5 = "SELECT * FROM user u INNER JOIN foodvendor  fv WHERE u.UserId = fv.UserId" or die(mysqli_connect_error());
                        $result5 = mysqli_query($conn, $query5);
            
                        $adminCount = 0;
                        $fvPendingCount = 0;
                        $fvApproveCount = 0;
                        $staffCount = 0;
                        $studentCount = 0;
                        $fvCount = 0;

            
                        if (mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $adminCount++;
                            }
                        }
                        if (mysqli_num_rows($result1) > 0){
                            while($row = mysqli_fetch_assoc($result1)){
                                $fvPendingCount++;
                            }
                        }
                        if (mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_assoc($result2)){
                                $fvApproveCount++;
                            }
                        }
                        if (mysqli_num_rows($result3) > 0){
                            while($row = mysqli_fetch_assoc($result3)){
                                $staffCount++;
                            }
                        }
                        if (mysqli_num_rows($result4) > 0){
                            while($row = mysqli_fetch_assoc($result4)){
                                $studentCount++;
                            }
                        }
                        if (mysqli_num_rows($result5) > 0){
                            while($row = mysqli_fetch_assoc($result5)){
                                $fvCount++;
                            }
                        }

                            
                        mysqli_close($conn);
                        ?>	
                    </div>                          
                        
            <script>
                var adminCount = <?php echo $adminCount; ?>;
                var fVApproveCount = <?php echo $fvApproveCount; ?>;
                var fVPendingCount = <?php echo $fvPendingCount; ?>;
                var staffCount = <?php echo $staffCount; ?>;
                var studentCount = <?php echo $studentCount; ?>;
                var fvCount = <?php echo $fvCount; ?>;

                //chart
                var seriesData = [
                    { name: 'Admin', data: adminCount },
                    { name: 'Food Vendor (Approved)', data: fVApproveCount },
                    { name: 'Food Vendor (Pending)', data: fVPendingCount },
                    { name: 'Staff', data: staffCount },
                    { name: 'Student', data: studentCount }
                ];

                var options = {
                    series: seriesData.map(item => item.data),
                    labels: seriesData.map(item => item.name),  // This adds labels/names to the chart
                    chart: {
                        type: 'polarArea',
                        toolbar: {
                            show: false
                        }
                    },
                    stroke: {
                        colors: ['#fff']
                    },
                    fill: {
                        opacity: 1
                    },
                    plotOptions: {
                        polarArea: {
                            polygons: {
                                radialLines: {
                                    strokeWidth: 1,
                                }
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#myChart"), options);
                chart.render();

                //bar
                var options = {
                    series: [{
                        data: [fvCount,fVApproveCount, fVPendingCount]
                    }],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    xaxis: {
                        categories: ['Food Vendor', 'Food Vendor Approve', 'Food Vendor Pending'],
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    yaxis: {
                        reversed: true,
                        axisTicks: {
                            show: true
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#barchart"), options);
                chart.render();
      
      

            </script>

            
        </article>


        <div class="footer">
            <div class="navbar_footer">
                <b>Copyright &COPY; Universiti Malaysia Pahang Al-Sultan Abdullah</b>
            </div>
        </div>

    </body>
</html>
