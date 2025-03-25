<?php
require '../../include/db_conn.php';
page_protect();
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>SPORTS CLUB | Dashboard</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <style>
        .page-container .sidebar-menu #main-menu li#dash > a {
            background-color: #2b303a;
            color: #ffffff;
        }
    </style>
</head>
<body class="page-body page-fade" onload="collapseSidebar()">

    <div class="page-container sidebar-collapsed" id="navbarcollapse">	
        <div class="sidebar-menu">
            <header class="logo-env">
                <div class="logo">
                    <a href="main.php">
                        <img src="logo1.png" alt="" width="192" height="80" />
                    </a>
                </div>
                <div class="sidebar-collapse" onclick="collapseSidebar()">
                    <a href="#" class="sidebar-collapse-icon with-animation">
                        <i class="entypo-menu"></i>
                    </a>
                </div>
            </header>
            <?php include('nav.php'); ?>
        </div>

        <div class="main-content">
            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix"></div>
                <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                    <ul class="list-inline links-list pull-right">
                        <li>Welcome <?php echo $_SESSION['full_name']; ?></li>					
                        <li>
                            <a href="logout.php">
                                Log Out <i class="entypo-logout right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <h2>Mora Sports Club</h2>
            <hr>

            <!-- Existing Tiles -->
            <div class="col-sm-3"><a href="revenue_month.php">			
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num">
                        <h2>Paid Income This Month</h2><br>	
                        <?php
                        date_default_timezone_set("Asia/Calcutta"); 
                        $date  = date('Y-m');
                        $query = "select * from enrolls_to WHERE paid_date LIKE '$date%'";
                        $result  = mysqli_query($con, $query);
                        $revenue = 0;
                        if (mysqli_affected_rows($con) != 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $query1 = "select * from plan where pid='" . $row['pid'] . "'";
                                $result1 = mysqli_query($con, $query1);
                                if ($result1) {
                                    $value = mysqli_fetch_row($result1);
                                    $revenue = $value[4] + $revenue;
                                }
                            }
                        }
                        echo "KSH" . $revenue;
                        ?>
                    </div>
                </div></a>
            </div>

            <!-- New Tile for Viewing All Users -->
            <div class="col-sm-3"><a href="../../view_users.php">			
                <div class="tile-stats tile-purple">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num">
                        <h2>View All Users</h2><br>
                        <p>Click to view all registered users</p>
                    </div>
                </div></a>
            </div>

            <!-- Other Existing Tiles -->
            <div class="col-sm-3"><a href="table_view.php">			
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num">
                        <h2>Total Members</h2><br>	
                        <?php
                        $query = "select COUNT(*) from users";
                        $result = mysqli_query($con, $query);
                        if (mysqli_affected_rows($con) != 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo $row['COUNT(*)'];
                            }
                        }
                        ?>
                    </div>
                </div></a>
            </div>

            <div class="col-sm-3"><a href="over_members_month.php">			
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-mail"></i></div>
                    <div class="num">
                        <h2>Joined This Month</h2><br>	
                        <?php
                        $date  = date('Y-m');
                        $query = "select COUNT(*) from users WHERE joining_date LIKE '$date%'";
                        $result = mysqli_query($con, $query);
                        if (mysqli_affected_rows($con) != 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo $row['COUNT(*)'];
                            }
                        }
                        ?>
                    </div>
                </div></a>			
            </div>

            <div class="col-sm-3"><a href="view_plan.php">			
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-rss"></i></div>
                    <div class="num">
                        <h2>Total Plan Available</h2><br>	
                        <?php
                        $query = "select COUNT(*) from plan where active='yes'";
                        $result  = mysqli_query($con, $query);
                        if (mysqli_affected_rows($con) != 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo $row['COUNT(*)'];
                            }
                        }
                        ?>
                    </div>
                </div></a>
            </div>

            <marquee direction="right"><img src="fball.gif" width="88" height="70" alt="Tutorials" border="0"></marquee>
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>