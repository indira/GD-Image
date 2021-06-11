<!DOCTYPE html>
<html lang="en">
<head>
  <title>Question1</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container text-center">
		<h1>Solution for Question1</h1>
		<?php
			/*
			PROBLEM #1:
			20 kids have gotten together to play baseball, but they need help making the teams as even as possible. The kids have all ranked their skill level from 1-10. In no particular order, here are their skill numbers: 8,5,6,9,3,8,2,4,6,10,8,5,6,1,7,10,5,3,7,6.
			Write an algorithm (in PHP) that will place these (or any other) kids into two teams of equal size with the total skill level being as even as possible.
			*/
			/*Solution for PROBLEM #1 by Indira Pandey*/
			//Defining empty arrays for Two teams 
			$teamA = [];
			$teamB = [];
			//Defining empty arrays for playersKey
			$teamAKey = [];
			$teamBkey = [];
			//Initializing the Total Numbers of score for each Team(Team A and TeamB)
			$TotalSumTeamA = 0;
			$TotalSumTeamB = 0;
			/*Assamble all players in an array with values skill numbers.
			Players Id are assigned as per the entry order.*/
			$skillNumbers = array(8, 5, 6, 9, 3, 8, 2, 4, 6, 10, 8, 5, 6, 1, 7, 10, 5, 3, 7, 6);
			//Sort all the players in descending order as per the skill numbers
			arsort($skillNumbers);
			//Finding the total number of kids
			$totalKids = count($skillNumbers);

			$keys = array_keys($skillNumbers);
			//
			$ChoiceID = 0;
			$j = 0;
			$i = 0;
			
			while($i < $totalKids-1){
				//echo $keys[$i]." " . $skillNumbers[$keys[$i]]."<br>";
				if ($ChoiceID == 0){ //TeamA get the preference
					$teamA[$j] = $skillNumbers[$keys[$i]];
					$teamAKey[$j] = $keys[$i];
					$teamB[$j] = $skillNumbers[$keys[$i+1]];
					$teamBKey[$j] = $keys[$i+1];
					$j = $j + 1;
					$ChoiceID = 1;//flip the order of choice to another team
					
				} else {//TeamB get the preference
					$teamB[$j] = $skillNumbers[$keys[$i]];
					$teamBKey[$j] = $keys[$i];
					$teamA[$j] = $skillNumbers[$keys[$i+1]];
					$teamAKey[$j] = $keys[$i+1];
					$j = $j + 1;
					$ChoiceID = 0;//flip the order of choice to another team
				}
				
				$i = $i+2;
			}
			//Displaying the output in a HTL table
			echo "<table class='table table-dark table-striped'>"; 
			echo "<tr>
				<th><label for='TeamAJerseyNumber'>TeamA Jersey Number</label></th>
				<th><label for='TeamASkillNumber'>TeamA Skill Value</label></th>
				<th><label for='TeamBJerseyNumber'>TeamB Jersey Number</label></th>
				<th><label for='TeamBSkillNumber'>TeamB Skill Value</label></th>
					  
				 </tr>";
				for($x = 0; $x < 10; $x++){
					 echo "<tr>";
					 echo "<td><p>". $teamAKey[$x]."</p></td>";
					 echo "<td><p>". $teamA[$x] ."</p></td>";
					 echo "<td><p>". $teamBKey[$x]."</p></td>";
					 echo "<td><p>". $teamB[$x] ."</p></td>";
					 echo "</tr>";
					 $TotalSumTeamA += $teamA[$x];
					 $TotalSumTeamB += $teamB[$x];
				}
				
			echo "<tr>
					<td></td>
					<td><label for='TotalScoreTeamA'>Total Score TeamA:<b>$TotalSumTeamA</b></label></td>
					<td></td>
					<td><label for='TotalScoreTeamB'>Total Score TeamB:<b>$TotalSumTeamB</b></label></td>
				 </tr>";	
			echo "</table>";
		?>
	</div>
</body>
</html>
