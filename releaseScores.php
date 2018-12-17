<?php

session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}

	$url= 'https://web.njit.edu/~tl263/CS490-Beta/cs490-getgrades.php';
	$ch = curl_init($url); //curl
	$grade1= $_POST['grade1'];
	$grade2= $_POST['grade2'];
	$grade3= $_POST['grade3'];
	$ucid= $_POST['ucid'];
	$examid= $_POST['examid'];
	$gid= $_POST['gid'];
	$tc1= $_POST['comment1'];
	$tc2= $_POST['comment2'];
	$tc3= $_POST['comment3'];
	$gc1= $_POST['gc1'];
	$gc2= $_POST['gc2'];
	$gc3= $_POST['gc3'];
	$sub1= $_POST['sub1'];
	$sub1= urlencode($sub1);
	$sub2= $_POST['sub2'];
	$sub2= urlencode($sub2);
	$sub3= $_POST['sub3'];
	$sub3= urlencode($sub3);
	$eName= $_POST['eName'];
	$point1= $_POST['point1'];
	$point2= $_POST['point2'];
	$point3= $_POST['point3'];
	$data_string= 'grade1='.$grade1.'&grade2='.$grade2.'&grade3='.$grade3.'&ucid='.$ucid.'&examid='.$examid.'&gid='.$gid.'&tc1='.$tc1.'&tc2='.$tc2.'&tc3='.$tc3.'&gc1='.$gc1.'&gc2='.$gc2.'&gc3='.$gc3.'&sub1='.$sub1.'&sub2='.$sub2.'&sub3='.$sub3.'&eName='.$eName.'&point1='.$point1.'&point2='.$point2.'&point3='.$point3;
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	echo($result);
?>