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

function deleteData($table, $id) {
    $conn = connectDatabase();
    $deleteRow = "DELETE FROM %s WHERE id=%d";

    if ($table == "Club") {
        $sql = sprintf($deleteRow, $table, $id);
    } elseif ($table == "League") {
        $sql = sprintf($deleteRow, $table, $id);
    } elseif ($table == "Matches") {
        $sql = sprintf($deleteRow, $table, $id);
    } elseif ($table == "Player") {
        $sql = sprintf($deleteRow, $table, $id);
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

function displayEdit($table, $id){
    $almid = "$table";
    $specid = rtrim($almid, 's');
    $finid = $specid."_id";

    $conn = connectDatabase();
    $query = "SELECT * FROM $table WHERE $finid = $id";
    $result =  $conn->query($query);
    return $result->fetch_assoc();
}

function displayMatchEdit($id){
    $finid = "Match_id";
    $conn = connectDatabase();
    $query = "SELECT Match_id, Home_Goals, Away_Goals FROM matches WHERE $finid = $id";
    $result =  $conn->query($query);
    return $result->fetch_assoc();

}

function updateLeagues($table, $id, $name, $country){
    $success=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/final/success.php";
    $failed=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/final/fail.php";
    $conn = connectDatabase();
    $query = "UPDATE $table SET League_Name= '$name', League_Country= '$country' WHERE League_id = $id";
    if ($conn->query($query) === TRUE) {
        echo "<script language='javascript'>
        window.location.replace(\"success.php\");
        </script>";
    
        
    } else {
        echo "<script language='javascript'>
        window.location.replace(\"fail.php\");
        </script>";
    }
}

function updateClubs($table, $id, $name, $ranking, $wins, $losses, $draws, $points){
    $conn = connectDatabase();
    $query = "UPDATE $table SET Name= '$name', Ranking= $ranking, Wins= $wins, Losses= $losses, Draws=$draws, Points= $points WHERE Club_id = $id";
    if ($conn->query($query) === TRUE) {
        echo "<script language='javascript'>
        window.location.replace(\"success.php\");
        </script>";
    } else {
        echo "<script language='javascript'>
        window.location.replace(\"fail.php\");
        </script>";
    }
}

function updateMatches($table, $id, $homescore, $visitorscore){
    $conn = connectDatabase();
    $query = "UPDATE $table SET Home_Goals= $homescore, Away_Goals= $visitorscore WHERE Match_id = $id";
    if ($conn->query($query) === TRUE) {
        echo "<script language='javascript'>
        window.location.replace(\"success.php\");
        </script>";
    } else {
        echo "<script language='javascript'>
        window.location.replace(\"fail.php\");
        </script>";
    }
}



function updatePlayers($table, $id, $name, $position, $age, $height, $weight, $country, $goals, $assists, $marketval){
    $conn = connectDatabase();
    $query = "UPDATE $table SET Name= '$name', Player_Country= '$country', Position = '$position', Age= $age, Height= '$height', Weight= $weight, Goals= '$goals', Assists= $assists, Market_Value=$marketval WHERE Player_id = $id";
    if ($conn->query($query) === TRUE) {
        echo "<script language='javascript'>
        window.location.replace(\"success.php\");
        </script>";
    } else {
        echo "<script language='javascript'>
        window.location.replace(\"fail.php\");
        </script>";
    }
}


function getClub($id) {
    $conn = connectDatabase();
    $query = "SELECT Name FROM club WHERE club.Club_id = $id";
    $result = $conn->query($query);
    $name = $result->fetch_array()[0];
    return $name;
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

    return $conn->query($sql);
}


