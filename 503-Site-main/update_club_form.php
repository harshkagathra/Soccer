<?php
function connectDatabase() {
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "abcd1234";


    $conn = new mysqli($servername, $username, $password);
    $conn->select_db("Soccer");

    if ($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }
    return $conn;

}


function displayEdit($table, $id){
    $almid = "$table";
    $specid = rtrim($almid, 's');
    $finid = $specid."id";

    $conn = connectDatabase();
    $query = "SELECT * FROM $table WHERE $finid = $id";
    $result =  $conn->query($query);
    return $result->fetch_assoc();
}

if ($_GET['clubid'] != '') {
    $id = $_GET['clubid'];
    $editRow = displayEdit("clubs", $id);
    echo "<form method=\"POST\" class='editC'>";
    echo "<br>";
    echo "<h2>Edit this Club</h2>";
    echo "<br>";
    echo "<input style=\"color: black\" value=\"$editRow[clubid]\" type=\"hidden\" size=\"20\" name=\"id\" >";
    echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Club Ranking:&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[ranking]\" type=\"text\" size=\"20\" name=\"ranking\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Club Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[name]\" type=\"text\" size=\"20\" name=\"name\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Club Wins:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[wins]\" type=\"text\" size=\"20\" name=\"wins\" ></p><br>";
    echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Club Losses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[losses]\" type=\"text\" size=\"20\" name=\"losses\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Club Draws:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[draws]\" type=\"text\" size=\"20\" name=\"draws\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Club Points:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[points]\" type=\"text\" size=\"20\"  name=\"points\"></p><br>";
    echo "<p><input class=\"padding_left_20\" type=\"image\" name=\"push_edits2\" value=\"edit\" src=\"./images/pencil.svg\" width=\"40px\" height=\"40px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onClick=\"window.location.reload();\"><img  src=\"./images/cancel.png\" width=\"40px\" height=\"40px\"></p>";
    echo "</form>";
}

?>