<?php
session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}
?>

<html>
<head> 
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Teacher Dashboard </title> 
	<script>
		function toggleSidebar(){
			document.getElementById("sidebar").classList.toggle("active");
		}
	
	</script>
	</head>
<body>
<div id="sidebar">
	<div class="toggle-btn" onmouseover="toggleSidebar()">
	<span> </span>
	<span> </span>
	<span> </span>
	</div>
	<ul>
	<li> <a href="createTest1.php">Create a test</a> </li>
	<li> <a href="addQuestion1.php">Add a question</a> </li>
	<li> <a href="releaseScores1.php">Release Scores</a> </li>
	<li> <a href="logout.php">Logout</a> </li>
	<ul>
	
</div>
<div>
<center> <h1> Welcome Professor: <?php echo $_SESSION['ucid']; ?> </h1> </center>




</body>
</html>
