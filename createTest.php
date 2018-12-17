<?php

session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}

	$url= 'https://web.njit.edu/~tl263/CS490-Beta/cs490-addquestion.php';
	$ch = curl_init($url); //curl
	$data_string= '';
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	echo($result);
?>