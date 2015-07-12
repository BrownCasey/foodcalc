<?php

$query = $_GET["searchbox"];

$severname = "localhost";
$username = "foodie";
$password = "secret_pass";
$dbname = "food";

// make connection
$conn = mysql_connect($servername, $username, $password);
@mysql_select_db($dbname);


$sql = "SELECT * FROM food WHERE name LIKE '%$query%'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){
    $name = $row['name'];
    $calories = $row['calories'];
    echo "<li class='list-group-item' onclick='add($(this).text(), $calories);'>";
    echo '<span class="glyphicon glyphicon-plus-sign"></span> ' . $name . ' <span class="badge"> ' . $calories . '</span><br>';
    echo '</li>';
}
?>
