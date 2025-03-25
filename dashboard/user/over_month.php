<?php
require '../../include/db_conn.php';
page_protect();

if (isset($_GET['mm']) && isset($_GET['yy'])) {
    $month = $_GET['mm'];
    $year = $_GET['yy'];

    $query = "SELECT COUNT(*) as count, joining_date 
              FROM users 
              WHERE MONTH(joining_date) = '$month' AND YEAR(joining_date) = '$year' 
              GROUP BY joining_date";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Date</th>
                    <th>Number of Members</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['joining_date'] . "</td>
                    <td>" . $row['count'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No members found for the selected month and year.";
    }
} else {
    echo "Invalid request.";
}
?>