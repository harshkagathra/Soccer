
<?php
function connectDatabase() {
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "harsh";


    $conn = new mysqli($servername, $username, $password);
    $conn->select_db("Soccer");

    if ($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }
    return $conn;

}

function getData($table) {
    $conn = connectDatabase();
    $getRow = "SELECT * FROM %s";

    $sql = "";

    if ($table == "club") {
        $sql = sprintf($getRow, $table);
    } elseif ($table == "league") {
        $sql = sprintf($getRow, $table);
    } elseif ($table == "matches") {
        $sql = sprintf($getRow, $table);
    } elseif ($table == "player") {
        $sql = sprintf($getRow, $table);
    }

    $result = $conn->query($sql);
    $json = [];
    while ($row = $result->fetch_assoc()){
        $json[] = $row;
    }

    $conn->close();
    return $json;
}
if($_GET['leagueid'] != "") {
 $leagueid = $_GET['leagueid'];
 echo "<table>";
 echo "<tr>";
 echo "<th>Ranking</th>";
 echo "<th>Club</th>";
 echo "<th>Wins</th>";
 echo "<th>Losses</th>";
 echo "<th>Draw</th>";
 echo "<th>Points</th>";
 echo "<th>Edit</th>";
 echo "<th>Delete</th>";
 echo "</tr>";
 $clubs = getData('club');
 foreach($clubs as $club):
     if ($club['League_id'] == $leagueid) {

        echo "<tr>";
        echo '<td>'.$club['Ranking'].'</td>';
        echo '<td>'.$club['Name'].'</td>';
        echo '<td>'.$club['Wins'].'</td>';
        echo '<td>'.$club['Losses'].'</td>';
        echo '<td>'.$club['Draws'].'</td>';
        echo '<td>'.$club['Points'].'</td>';
        echo "<td>";
        // echo '<form name="edit"  method="post">';
        // echo '<input type="hidden" name="id" value="'.$id.'">';
        // echo '<input type="hidden" name="clubs">';
        // echo '<input class="padding_left_20" type="image" name="edit" value="edit" src="./images/pencil.svg" width="20px" height="20px">';
        // echo "</form>";
        echo '<button class="padding_left_20" onclick="updateclub('.$club['Club_id'].')">';
        echo '<img src="./images/pencil.svg" width="20px" height="20px" alt="Edit"/>';
        echo "</button>";
        echo "</td>";
        echo "<td>";
        echo '<button class="padding_left_20" onclick="deleteRecord(\'club\','.$club['Club_id'].')">';
        echo '<img src="./images/trash-can.svg" width="20px" height="20px" alt="Delete"/>';
        echo "</button>";
        echo "</td>";
        echo "</tr>";
    }
endforeach;
echo "</table>";
}
?>