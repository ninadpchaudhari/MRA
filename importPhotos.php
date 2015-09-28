<?php
/**
 * Created by PhpStorm.
 * User: Ninad
 * Date: 29/08/2015
 * Time: 4:55 PM
 */

echo "<html>";
$servername = "192.168.1.228";
$username = "root";
$password = "NINAD111";
$dbname = "nrai";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT shooterID,photo FROM ShooterM ;";
$result = mysqli_query($conn, $sql);
$count = 1;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo $count . " ";
        echo "ID: " . $row['shooterID'] . "</br>";
        //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
        file_put_contents("C:\\Sites\\laravel-2\\resources\\assets\\shooter_i_d_photos\\" . $row['shooterID'] . ".jpg", $row['photo']);
        $count++;
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
echo "</html>";
?>