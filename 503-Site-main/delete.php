<?php


function connectDatabase()
{
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "abcd1234";
    $dbname = "Soccer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;

}

function deleteData($table, $id)
{
    $conn = connectDatabase();
    $deleteRow = "DELETE FROM %s WHERE %s=%d";
    $sql = "";
    if ($table == "clubs") {
        $sql = sprintf($deleteRow, $table, 'clubid', $id);
    } elseif ($table == "leagues") {
        $sql = sprintf($deleteRow, $table, 'leagueid', $id);
    } elseif ($table == "matches") {
        $sql = sprintf($deleteRow, $table, 'matchid', $id);
    } elseif ($table == "players") {
        $sql = sprintf($deleteRow, $table, 'playerid', $id);
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

if ($_GET['id'] != "") {
    deleteData($_GET['table'], $_GET['id']);
}

