<?php
require '../../include/db_conn.php';
page_protect();

if (isset($_POST['name'])) {
    $memid = mysqli_real_escape_string($con, $_POST['name']); // Sanitize the input

    // Query to fetch member details
    $query = "SELECT u.*, a.streetName, a.state, a.city, a.zipcode, h.calorie, h.height, h.weight, h.fat, h.remarks 
              FROM users u 
              LEFT JOIN address a ON u.userid = a.id
              LEFT JOIN health_status h ON u.userid = h.uid
              WHERE u.userid = '$memid'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Fetch member data
        $row = mysqli_fetch_assoc($result);

        $name       = htmlspecialchars($row['username']);
        $gender     = htmlspecialchars($row['gender']);
        $mobile     = htmlspecialchars($row['mobile']);
        $email      = htmlspecialchars($row['email']);
        $dob        = htmlspecialchars($row['dob']);
        $jdate      = htmlspecialchars($row['joining_date']);
        $streetname = htmlspecialchars($row['streetName']);
        $state      = htmlspecialchars($row['state']);
        $city       = htmlspecialchars($row['city']);
        $zipcode    = htmlspecialchars($row['zipcode']);
        $calorie    = htmlspecialchars($row['calorie']);
        $height     = htmlspecialchars($row['height']);
        $weight     = htmlspecialchars($row['weight']);
        $fat        = htmlspecialchars($row['fat']);
        $remarks    = htmlspecialchars($row['remarks']);
    } else {
        // Error: No member found
        echo "<html><head><script>alert('No member found with the given ID');</script></head></html>";
        exit();
    }
} else {
    // Error: No Member ID provided
    echo "<html><head><script>alert('No Member ID provided');</script></head></html>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | Edit Member</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">
    <style>
        #button1 {
            width: 126px;
        }
        #boxxe {
            width: 230px;
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
            <h3>Edit Member Details</h3>
            <hr/>
            <div class="a1-container a1-small a1-padding-32" style="margin-top:2px; margin-bottom:2px;">
                <div class="a1-card-8 a1-light-gray" style="width:600px; margin:0 auto;">
                    <div class="a1-container a1-dark-gray a1-center">
                        <h6>EDIT MEMBER PROFILE</h6>
                    </div>
                    <form id="form1" name="form1" method="post" class="a1-container" action="edit_mem_submit.php">
                        <table width="100%" border="0" align="center">
                            <tr>
                                <td>User ID:</td>
                                <td><input id="boxxe" type="text" name="uid" readonly required value="<?php echo $memid; ?>"></td>
                            </tr>
                            <tr>
                                <td>NAME:</td>
                                <td><input id="boxxe" type="text" name="uname" required value="<?php echo $name; ?>"></td>
                            </tr>
                            <tr>
                                <td>GENDER:</td>
                                <td>
                                    <select id="boxxe" name="gender" required>
                                        <option <?php if ($gender == 'Male') echo "selected"; ?> value="Male">Male</option>
                                        <option <?php if ($gender == 'Female') echo "selected"; ?> value="Female">Female</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>MOBILE:</td>
                                <td><input id="boxxe" type="number" name="phone" maxlength="10" required value="<?php echo $mobile; ?>"></td>
                            </tr>
                            <tr>
                                <td>EMAIL:</td>
                                <td><input id="boxxe" type="email" name="email" required value="<?php echo $email; ?>"></td>
                            </tr>
                            <tr>
                                <td>DATE OF BIRTH:</td>
                                <td><input type="date" id="boxxe" name="dob" required value="<?php echo $dob; ?>"></td>
                            </tr>
                            <tr>
                                <td>JOINING DATE:</td>
                                <td><input type="date" id="boxxe" name="jdate" required value="<?php echo $jdate; ?>"></td>
                            </tr>
                            <tr>
                                <td>STREET NAME:</td>
                                <td><input type="text" id="boxxe" name="stname" value="<?php echo $streetname; ?>"></td>
                            </tr>
                            <tr>
                                <td>STATE:</td>
                                <td><input type="text" id="boxxe" name="state" value="<?php echo $state; ?>"></td>
                            </tr>
                            <tr>
                                <td>CITY:</td>
                                <td><input type="text" id="boxxe" name="city" value="<?php echo $city; ?>"></td>
                            </tr>
                            <tr>
                                <td>ZIPCODE:</td>
                                <td><input type="text" id="boxxe" name="zipcode" value="<?php echo $zipcode; ?>"></td>
                            </tr>
                            <tr>
                                <td>CALORIE:</td>
                                <td><input type="text" id="boxxe" name="calorie" value="<?php echo $calorie; ?>"></td>
                            </tr>
                            <tr>
                                <td>HEIGHT:</td>
                                <td><input type="text" id="boxxe" name="height" value="<?php echo $height; ?>"></td>
                            </tr>
                            <tr>
                                <td>WEIGHT:</td>
                                <td><input type="text" id="boxxe" name="weight" value="<?php echo $weight; ?>"></td>
                            </tr>
                            <tr>
                                <td>FAT:</td>
                                <td><input type="text" id="boxxe" name="fat" value="<?php echo $fat; ?>"></td>
                            </tr>
                            <tr>
                                <td>REMARKS:</td>
                                <td>
                                    <textarea style="resize:none; margin:0; width:230px; height:53px;" name="remarks" id="boxxe"><?php echo $remarks; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="a1-btn a1-blue" type="submit" name="submit" value="UPDATE">
                                    <input class="a1-btn a1-blue" type="reset" value="RESET">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>