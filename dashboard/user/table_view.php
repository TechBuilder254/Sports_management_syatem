<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB  | View Member</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">
    
    <style>
    #button1 {
        width:126px;
    }

    .page-container .sidebar-menu #main-menu li#hassubopen > a {
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

            <h3>Member Detail</h3>
            <hr />
            
            <table class="table table-bordered datatable" id="table-1" border=1>
                <thead>
                    <tr><h2>
                        <th>Sl.No</th>
                        <th>Membership Expiry</th>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>E-Mail</th>
                        <th>Gender</th>
                        <th>Joining Date</th>
                        <th>Action</th></h2>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT u.*, e.expire 
                              FROM users u 
                              LEFT JOIN enrolls_to e ON u.userid = e.uid AND e.renewal = 'yes' 
                              ORDER BY u.joining_date";
                    $result = mysqli_query($con, $query);
                    $sno = 1;

                    if (mysqli_affected_rows($con) != 0) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<tr><td>".$sno."</td>";
                            echo "<td>" . ($row['expire'] ? $row['expire'] : 'N/A') . "</td>";
                            echo "<td>" . $row['userid'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['mobile'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>" . $row['joining_date'] ."</td>";
                            echo "<td><form action='viewall_detail.php' method='post'><input type='hidden' name='name' value='" . $row['userid'] . "'/><input type='submit' class='a1-btn a1-blue' id='button1' value='View All ' class='btn btn-info'/></form></td></tr>";
                            $sno++;
                        }
                    }

                    $res = mysqli_query($con, "CALL `countGender`();") or die("query fail:" . mysqli_error($con));
                    echo "<table><tr><th>gender</th><th>count</th></tr>";
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<tr><td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['COUNT(*)'] . "</td></tr>";
                    }
                    echo "</table>";
                    ?>
                </tbody>
            </table>

            <script>
                function ConfirmDelete(name) {
                    var r = confirm("Are you sure! You want to Delete this User?");
                    if (r == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
            
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>