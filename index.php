<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Soccer Leagues</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
    function showClubs() {
    			var leagueid = document.getElementById("select_league").value;
    			$.get({
    				url: 'clubs.php?leagueid=' + leagueid,
    				success: function(data) {
    					$('#selectedLeague').html(data);
    				}
    			}
    			);
    			return false;
    		}
    		function updateclub(id) {
            			$.get({
            				url: 'update_club_form.php?clubid=' + id,
            				success: function(data) {
            					$('#updateform').html(data);
            				}
            			}
            			);
            			return false;
            		}
        function deleteRecord(table, id) {
            $.get({
                    url: 'delete.php?table=' + table + '&id=' + id,
                    success: function() {
                        if(table == 'club') {
                        						showClubs();
                        					} else {
                        						location.reload();
                        					}
                    }
                }
            );
            return false;
        }

    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'operations.php';
    if (isset($_POST['push_edits1_x'])) {
        $name = $_REQUEST['name'];
        $country = $_REQUEST['country'];
        $id = $_REQUEST['id'];
        updateLeagues('league', $id, $name, $country);
    }
    if (isset($_POST['push_edits2_x'])) {
        $name = $_REQUEST['name'];
        $ranking = $_REQUEST['ranking'];
        $wins = $_REQUEST['wins'];
        $losses = $_REQUEST['losses'];
        $draws = $_REQUEST['draws'];
        $points = $_REQUEST['points'];
        $id = $_REQUEST['id'];
        updateClubs('club', $id, $name, $ranking, $wins, $losses, $draws, $points);
    }
    if (isset($_POST['push_edits3_x'])) {
        $hscore = $_REQUEST['hscore'];
        $ascore = $_REQUEST['ascore'];
        $id = $_REQUEST['id'];
        updateMatches('matches', $id, $hscore, $ascore);
    }
    if (isset($_POST['push_edits4_x'])) {
        $name = $_REQUEST['name'];
        $position = $_REQUEST['position'];
        $age = $_REQUEST['age'];
        $height = $_REQUEST['height'];
        $weight = $_REQUEST['weight'];
        $country = $_REQUEST['country'];
        $goals = $_REQUEST['goals'];
        $assists = $_REQUEST['assists'];
        $marketval = $_REQUEST['marketval'];
        $id = $_REQUEST['id'];
        updatePlayers('player', $id, $name, $position, $age, $height, $weight, $country, $goals, $assists, $marketval);
    }
    ?>

</head>


<body onload="showClubs()">
<!--Start of Header-->
<header>
    <div id="logo">
        <a href="index.php">
            <img src="./images/football.svg">
        </a>
        <a href="index.php">
            <h1>Soccer Leagues</h1>
        </a>
    </div>
    <nav id="nav">
        <ul class="navigation">
            <li><a href="index.php">Home</a></li>
            <li><a href="#leagues">Leagues</a></li>
            <li><a href="#clubs">Clubs</a></li>
            <li><a href="#matches">Matches</a></li>
            <li><a href="#players">Players</a></li>
        </ul>
    </nav>
</header>

<?php $leagues = getData('league'); ?>
<div>
    <h1>Leagues</h1>
    <a class="padding_left_20" href="insert.php?showing=add_league">
        <img src="./images/add.svg" width="30px" height="30px" alt="Add Club">
    </a>
    <div id="leagues" class="columns">
        <?php
        foreach($leagues as $league):
            $id = $league['League_id'];
            ?>

            <article class="column">
					<span id="actions">
						<form name="edit"  method="post">
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="hidden" name="leagues" value="leagues">
							<input class="padding_left_20" type="image" name="edit" value="edit" src="./images/pencil.svg" width="20px" height="20px">
						</form>
						<button class="padding_left_20" onclick="deleteRecord('league', <?php echo $league['League_id']; ?>)">
							<img src="images/trash-can.svg" width="20px" height="20px" alt="Delete"/>
						</button>
					</span>
                <h2 class="clear_both"><?php echo $league['League_Name']; ?></h2>
                <h3><?php echo $league['League_Country']; ?></h3>
            </article>

        <?php endforeach;
        if (isset($_POST['leagues'])) {
            $id = $_REQUEST['id'];
            $editRow = displayEdit("league", $id);
            echo "<form method=\"POST\" class=\"editL\">";
            echo "<br>";
            echo "<h2>Edit this League</h2>";
            echo "<br>";
            echo "<input style=\"color: black\" value=\"$editRow[League_id]\" type=\"hidden\" size=\"20\" name=\"id\" >";
            echo "<p>League Name:&nbsp;&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[League_Name]\" type=\"text\" size=\"20\" name=\"name\" ></p><br>";
            echo "<p>League Country:&nbsp; <input style=\"color: black\" value=\"$editRow[League_Country]\" type=\"text\" size=\"20\"  name=\"country\"></p><br>";
            echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"padding_left_20\" type=\"image\" name=\"push_edits1\" value=\"edit\" src=\"./images/pencil.svg\" width=\"40px\" height=\"40px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onClick=\"window.location.reload();\"><img  src=\"./images/cancel.png\" width=\"40px\" height=\"40px\"></button></p>";
            echo "</form>";
        }
        ?>
    </div>
    </br>

    <div id="clubs">
        <h1 class="padding_bottom_40">Clubs</h1>
        <a class="padding_left_20" href="insert.php?showing=add_club">
            <img src="./images/add.svg" width="30px" height="30px" alt="Add Club">
        </a>
        <div class="box">
        		<select id="select_league" name="select_league" onchange="showClubs()">
        			<option value="0" selected="selected">Select League</option>
        			<?php
        			if (! empty($leagues)) {
        				foreach($leagues as $league) {
        					echo '<option value="' . $league['League_id'] . '">' . $league['League_Name'] . '</option>';
        				}
        			}
        			?>
        		</select>
        	</div>
        	<div id="selectedLeague">
            		</div>
            		<div id="updateform">
                                		</div>
        <br>
        <br>
    </div>
    </br>
    <div id="matches">
        <h1>Matches</h1>
        <a class="padding_left_20" href="insert.php?showing=add_match">
            <img src="./images/add.svg" width="30px" height="30px" alt="Add Club">
        </a>
            <div class="scrollmenu">
            <?php
            $matches = getData('matches');
            $clubs = getData('club');
            foreach($matches as $match):
                $id = $match['Match_id'];
                ?>
                <article class="column">
				<span id="actions">
					<form name="edit" method="post">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<input type="hidden" name="matches" value="matches">
						<input class="padding_left_20" type="image" name="edit" value="edit" src="./images/pencil.svg" width="20px" height="20px">
					</form>
					<button class="padding_left_20" onclick="deleteRecord('matches', <?php echo $match['Match_id']; ?>)">
						<img src="images/trash-can.svg" width="20px" height="20px" alt="Delete"/>
					</button>
				</span>
                    </br>
                    <div class = "padding_bottom_20">
                        <?php
                        $home = getClub($match['Home_Club_id']);
                        $vis = getClub($match['Away_Club_id']);
                        $vs = $home." vs ".$vis;
                        $score = $match['Home_Goals']." - ".$match['Away_Goals'];
                        ?>
                        <h2 class="clear_both"><?php echo $vs; ?></h2>
                        <br>
                        <h3 class="text-color"><?php echo $score; ?></h3>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <?php
        if (isset($_POST['matches'])) {
            $id = $_REQUEST['id'];
            $editRow = displayMatchEdit($id);
            echo "<form method=\"POST\" class='editC'>";
            echo "<br>";
            echo "<h2>Edit this Match</h2>";
            echo "<br>";
            echo "<input style=\"color: black\" value=\"$editRow[Match_id]\" type=\"hidden\" size=\"20\" name=\"id\" >";
            echo "<p>Home Score:&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[Home_Goals]\" type=\"text\" size=\"20\" name=\"hscore\" ></p><br>";
            echo "<p>Away Score:&nbsp;&nbsp;&nbsp; <input style=\"color: black\" value=\"$editRow[Away_Goals]\" type=\"text\" size=\"20\" name=\"ascore\" ></p><br>";
            echo "<p><input class=\"padding_left_20\" type=\"image\" name=\"push_edits3\" value=\"edit\" src=\"./images/pencil.svg\" width=\"40px\" height=\"40px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onClick=\"window.location.reload();\"><img  src=\"./images/cancel.png\" width=\"40px\" height=\"40px\"></p>";
            echo "</form>";
        }
        ?>
    </div>

    <div id="players">
        <h1>Players</h1>
        <a class="padding_left_20" href="insert.php?showing=add_player">
            <img src="./images/add.svg" width="30px" height="30px" alt="Add Match">
        </a>
        <div class="scrollmenu">
        <?php
        $players = getData('player');
        foreach($players as $player):
            $id = $player['Player_id'] ?>
            <article class="column">
			<span id="actions">
				<form name="edit"  method="post">
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="hidden" name="players">
					<input class="padding_left_20" type="image" name="edit" value="edit" src="./images/pencil.svg" width="20px" height="20px">
				</form>
				<button class="padding_left_20" onclick="deleteRecord('player', <?php echo $player['Player_id']; ?>)">
					<img src="images/trash-can.svg" width="20px" height="20px" alt="Delete"/>
				</button>
			</span>
                <div class="numberCircle padding_bottom_20 clear_both">&nbsp;<?php echo $player['Rating'];?></div>
                <div style="text-align: center"><?php echo $player['Position'];?></div>
                <h3 class="margin_top_12"><?php echo $player['Name']; ?></h3>
                <table>
                    <tr>
                        <td>Age:</td>
                        <td><?php echo $player['Age'];?></td>
                    </tr>
                    <tr>
                        <td>Height:</td>
                        <td><?php echo $player['Height'];?></td>
                    </tr>
                    <tr>
                        <td>Weight:</td>
                        <td><?php echo $player['Weight'];?></td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td><?php echo $player['Player_Country'];?></td>
                    </tr>
                    <tr>
                        <td>Goals:</td>
                        <td><?php echo $player['Goals'];?></td>
                    </tr>
                    <tr>
                        <td>Assists:</td>
                        <td><?php echo $player['Assists'];?></td>
                    </tr>
                    <tr>
                        <td>Market Value:</td>
                        <td><?php echo $player['Market_Value'];?></td>
                    </tr>
                </table>
            </article>
        <?php endforeach;
        
        if (isset($_POST['players'])) {
            $id = $_REQUEST['id'];
            $editRow = displayEdit("player", $id);
            echo "<form method=\"POST\" class='editP'>";
            echo "<br>";
            echo "<h2>Edit this Player</h2>";
            echo "<br>";
            echo "<input style=\"color: black\" value=\"$editRow[Player_id]\" type=\"hidden\" size=\"20\" name=\"id\" >";
            echo "<p>Player Name:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Name]\" type=\"text\" size=\"20\" name=\"name\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Player Position:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Position]\" type=\"text\" size=\"20\" name=\"position\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Player Age:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Age]\" type=\"text\" size=\"20\" name=\"age\" ></p><br>";
            echo "<p>Player Height:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Height]\" type=\"text\" size=\"20\" name=\"height\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Player Weight:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Weight]\" type=\"text\" size=\"20\" name=\"weight\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Player Country:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Player_Country]\" type=\"text\" size=\"20\"  name=\"country\"></p><br>";
            echo "<p>Player Goals:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Goals]\" type=\"text\" size=\"20\"  name=\"goals\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Player Assists:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Assists]\" type=\"text\" size=\"20\"  name=\"assists\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Player Market Value:&nbsp;&nbsp;&nbsp;<input style=\"color: black\" value=\"$editRow[Market_Value]\" type=\"text\" size=\"20\"  name=\"marketval\"></p><br>";
            echo "<p><input class=\"padding_left_20\" type=\"image\" name=\"push_edits4\" value=\"edit\" src=\"./images/pencil.svg\" width=\"40px\" height=\"40px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onClick=\"window.location.reload();\"><img  src=\"./images/cancel.png\" width=\"40px\" height=\"40px\"></p>";
            echo "</form>";
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>
