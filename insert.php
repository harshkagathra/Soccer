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
	<div id="forms" name="forms">
  
		<div id="add" name="add" class="add">
		   <form method = "post" action = "insertion.php" id="add_league" style="display: none; text-align: center" >	
			  <label for="League_name">League name:</label><br>
			  <input type="text" id="League_name" name="League_name" style="Color:#000;"><br><br>
			  <label for="Country">Country:</label><br>
			  <input type="text" id="Country" name="Country" style="Color:#000;"><br><br>
			  <input type="submit" value="Submit" id="add_league" name="add_league" style="Color:#000;">
		   </form>
		</div>
		
		
		<div id="add" name="add">
		   <form method = "post" action = "insertion.php" id="add_match" style="display: none; text-align: center" >
			  <label for="Home_Club_id">Home Club ID:</label><br>
			  <input type="text" id="Home_Club_id" name="Home_Club_id" style="Color:#000;"><br><br>
			  <label for="Away_Club_id">Away Club ID:</label><br>
			  <input type="text" id="Away_Club_id" name="Away_Club_id" style="Color:#000;"><br><br>
			  <label for="Home_Club_Goals">Home Club Goals:</label><br>
			  <input type="text" id="Home_Club_Goals" name="Home_Club_Goals" style="Color:#000;"><br><br>
			  <label for="Away_Club_Goals">Away Club Goals:</label><br>
			  <input type="text" id="Away_Club_Goals" name="Away_Club_Goals" style="Color:#000;"><br><br>
			  <input type="submit" value="Submit" id="add_match" name="add_match" style="Color:#000;">
		   </form>
		</div>
		
		<div id="add" name="add">
		   <form method = "post" action = "insertion.php" id="add_player" style="display: none; text-align: center">	
			  <label for="Club_id">Club ID:</label><br>
			  <input type="text" id="Club_id" name="Club_id" style="Color:#000;"><br><br>
			  <label for="Name">Name:</label><br>
			  <input type="text" id="Name" name="Name" style="Color:#000;"><br><br>
			  <label for="Age">Age:</label><br>
			  <input type="text" id="Age" name="Age" style="Color:#000;"><br><br>
			  <label for="Height">Height</label><br>
			  <input type="text" id="Height" name="Height" style="Color:#000;"><br><br>
			  <label for="Weight">Weight:</label><br>
			  <input type="text" id="Weight" name="Weight" style="Color:#000;"><br><br>
			  <label for="Rating">Rating:</label><br>
			  <input type="text" id="Rating" name="Rating" style="Color:#000;"><br>	
			  <label for="Number">Number:</label><br>
			  <input type="text" id="Number" name="Number" style="Color:#000;"><br><br>
			  <label for="Club_Country">Country:</label><br>
			  <input type="text" id="Club_Country" name="Club_Country" style="Color:#000;"><br><br>
			  <label for="Position">Position:</label><br>
			  <input type="text" id="Position" name="Position" style="Color:#000;"><br><br>
			  <label for="Market_Value">Market Value:</label><br>
			  <input type="text" id="Market_Value" name="Market_Value" style="Color:#000;"><br><br>
			  <label for="Goals">Goals:</label><br>
			  <input type="text" id="Goals" name="Goals" style="Color:#000;"><br><br>
			  <label for="Assists">Assists:</label><br>
			  <input type="text" id="Assists" name="Assists" style="Color:#000;"><br><br>
			  <input type="submit" value="Submit" id="add_player" name="add_player" style="Color:#000;">
		   </form>
		</div>

		<div id="add" name="add">
		   <form method = "post" action = "insertion.php" id="add_club" style="display: none; text-align: center">	
			  <label for="League_id">League ID:</label><br>
			  <input type="text" id="League_id" name="League_id" style="Color:#000;"><br><br>
			  <label for="Name">Name:</label><br>
			  <input type="text" id="Name" name="Name" style="Color:#000;"><br><br>
			  <label for="Ranking">Ranking:</label><br>
			  <input type="text" id="Ranking" name="Ranking" style="Color:#000;"><br><br>
			  <label for="Wins">Wins</label><br>
			  <input type="text" id="Wins" name="Wins" style="Color:#000;"><br><br>
			  <label for="Losses">Losses:</label><br>
			  <input type="text" id="Losses" name="Losses" style="Color:#000;"><br><br>
			  <label for="Draws">Draws:</label><br>
			  <input type="text" id="Draws" name="Draws" style="Color:#000;"><br>	
			  <label for="Points">Points:</label><br>
			  <input type="text" id="Points" name="Points" style="Color:#000;"><br><br>
			  <input type="submit" value="Submit" id="add_club" name="add_club" style="Color:#000;">
		   </form>
		</div>
	</div>
	<script>
	function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
	

    var showing = getParameterByName('showing');
	display(showing);
	function display(showing){
		
		document.getElementById(showing).style.display = "block";
	}
	
	</script>
	
	
   
   </body>
</html>