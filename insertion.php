<html>
   
   <head>
	<title>Soccer Leagues</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
	
	
   
   <body>
   <header>
		<div id="logo">
			<a href="https://www.sdsu.edu/">
				<img src="./images/football.svg">
			</a>
			<a href="index.php">
				<h1>Soccer Leagues</h1>
			</a>
		</div>
		<nav id="nav">
			<ul class="navigation">
				<li><a href="index.php">Home</a></li>
				<li><a href="index.php#leagues">Leagues</a></li>
				<li><a href="index.php#clubs">Clubs</a></li>
				<li><a href="index.php#matches">Matches</a></li>
				<li><a href="index.php#players">Players</a></li>
			</ul>
		</nav>
	</header>
<?php
	if(isset($_POST['add_league'])) { 
            add_league(); 
        } 
       else if(isset($_POST['add_match'])) { 
            add_match(); 
        } 
		else if(isset($_POST['add_player'])){
			add_player();
		}else if(isset($_POST['add_club'])){
			add_club();
		}
		

	
	function add_league(){
		 
	$servername = "127.0.0.1:3306";
	$username = "root";
	$password = "harsh";
		
	$conn = new mysqli($servername, $username, $password);
	$conn->select_db("soccer");

	if ($conn->connect_error){
		die("connection failed: " . $conn->connect_error);
	}
		$League_name = $_POST['League_name'];
		$Country = $_POST['Country'];
		
		$sql = "INSERT INTO league(League_Name, League_Country) VALUES('$League_name','$Country')";
		   
		$retval = mysqli_query($conn,$sql);
		
		if(! $retval ) {
		   die('Could not enter data: ' . mysqli_error($conn));
		}
		
		echo "Entered data successfully\n";
		
		mysqli_close($conn);
	}
	
	
	
	function add_match(){
	$servername = "127.0.0.1:3306";
	$username = "root";
	$password = "harsh";
	$conn = new mysqli($servername, $username, $password);
	$conn->select_db("soccer");

	if ($conn->connect_error){
		die("connection failed: " . $conn->connect_error);
	}
		$Home_Club_id = $_POST['Home_Club_id'];
		$Away_Club_id = $_POST['Away_Club_id'];
		$Home_Club_Goals = $_POST['Home_Club_Goals'];
		$Away_Club_Goals = $_POST['Away_Club_Goals'];
		
		$sql = "INSERT INTO matches(Home_club_id, Away_club_id, Home_Goals, Away_Goals) VALUES('$Home_Club_id','$Away_Club_id','$Home_Club_Goals','$Away_Club_Goals')";
		   
		$retval = mysqli_query($conn,$sql);
		
		if(! $retval ) {
		   die('Could not enter data: ' . mysqli_error($conn));
		}
		
		echo "Entered data successfully\n";
		
		mysqli_close($conn);
	}
	
	
	function add_player(){
		$servername = "127.0.0.1:3306";
	$username = "root";
	$password = "harsh";
	$conn = new mysqli($servername, $username, $password);
	$conn->select_db("soccer");

	if ($conn->connect_error){
		die("connection failed: " . $conn->connect_error);
	}
		$Club_id = $_POST['Club_id'];
		$Name = $_POST['Name'];
		$Age = $_POST['Age'];
		$Height = $_POST['Height'];
		$Weight = $_POST['Weight'];
		$Rating = $_POST['Rating'];
		$Number = $_POST['Number'];
		$Country = $_POST['Club_Country'];
		$Position = $_POST['Position'];
		$Market_Value = $_POST['Market_Value'];
		$Goals = $_POST['Goals'];
		$Assists = $_POST['Assists'];
		
		$sql = "INSERT INTO player (Club_id,Name, Age, Height, Weight, Rating, Number, Player_Country, Position, Market_Value, Goals, Assists) VALUES ('$Club_id','$Name','$Age','$Height','$Weight','$Rating','$Number','$Country','$Position','$Market_Value','$Goals','$Assists')";
		   
		$retval = mysqli_query($conn,$sql);
		
		if(! $retval ) {
		   die('Could not enter data: ' . mysqli_error($conn));
		}
		
		echo "Entered data successfully\n";
		
		mysqli_close($conn);
	}
	
	function add_club(){
		$servername = "127.0.0.1:3306";
		$username = "root";
		$password = "harsh";
		$conn = new mysqli($servername, $username, $password);
		$conn->select_db("soccer");
	
		if ($conn->connect_error){
			die("connection failed: " . $conn->connect_error);
		}
			$League_id = $_POST['League_id'];
			$Name = $_POST['Name'];
			$Ranking = $_POST['Ranking'];
			$Wins = $_POST['Wins'];
			$Losses = $_POST['Losses'];
			$Draws = $_POST['Draws'];
			$Points = $_POST['Points'];

			
			$sql = "INSERT INTO club(League_id,Name,Ranking,Wins,Losses,Draws,Points) VALUES('$League_id','$Name','$Ranking','$Wins','$Losses','$Draws','$Points')";  
			$retval = mysqli_query($conn,$sql);
			
			if(! $retval ) {
			   die('Could not enter data: ' . mysqli_error($conn));
			}
			
			echo "Entered data successfully\n";
			
			mysqli_close($conn);
		}
?>