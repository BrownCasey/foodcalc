<html>
<head>
    <meta charset="utf-8">
</head>
<?php

$handle = fopen("Food_Table.xml", "r");
$content = fread($handle, filesize("output.txt"));

$severname = "localhost";
$username = "foodie";
$password = "secret_pass";
$dbname = "food";

// make connection
$conn = mysql_connect($servername, $username, $password);
@mysql_select_db($dbname);

// check connection
if ($conn->connect_error){
    die("connection failed" . $conn->connect_error);
}

echo "Connected to database!" . "<br>";

if (file_exists("Food_Table.xml")) {
    $fp = fopen("output.txt", "w");

    $xml = simplexml_load_file("Food_Table.xml");
    
    $food = '';
   
    foreach($xml->Food_Display_Row as $a){
        $prefix = $a->Display_Name;
        $suffix = $a->Portion_Display_Name;
        $calories = intval($a->Calories);
        
        foreach($a->Portion_Display_Name as $b){
            if (strpos($b, "'") !== false ){
                $suffix = str_replace("'", "''", $b);
            }
        }
        foreach($a->Display_Name as $b){
            if (strpos($b, "'") !== false ){
                $prefix = str_replace("'", "''", $b);
            }
        }        
    
        $food = $food . "('$prefix" . " $suffix'," . "$calories),"; 
    }
    
    $food = rtrim($food,",");
    
//    $sql = "INSERT INTO food (name, calories) VALUES $food";   
//    if(!($result = mysql_query($sql))) {
 //       echo "insert failed";
  //  }
    $sql = "SELECT * FROM food WHERE name LIKE '%cookie%'";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)){
        echo $row['name'] . "<br>" . $row['calories'] . "<br>";
    }

    fclose($fp);
}
else {
    exit("Failed to open Food_Table.xml");
}


// $sql = "INSERT INTO people (name, job, salary) VALUES ('Harry', 'Owner', 50000),('Larry', 'Partner', 50000),
// ('Mo', 'Dog washer', 20000)";
// if(!($result = mysql_query($sql))) {
//     echo "insert failed";
// };

// $sql = "SELECT * FROM people";
// $result = mysql_query($sql);
// while($row = mysql_fetch_array($result)){
//     echo $row['name'] . "&nbsp" . $row['job'] . "&nbsp" . $row['salary'] . "<br>";
// };

$conn->close();
?>
</html>
