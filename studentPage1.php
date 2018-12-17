<?php
session_start();

if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}


?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Student Dashboard </title> 
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
		
		<li><a href="takeTest1.php">Take a test</a></li>
		<li><a href="sviewScore1.php">View Scores</a></li>
		<li><a href="logout.php">Logout</a></li>
		
	</ul>
</div>
<div>
<center> <h1>Welcome Student: <?php echo $_SESSION['ucid']; ?> </h1> </center>
</div>

</body>
</html>