<?php
session_start();

if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}

$url= 'https://web.njit.edu/~tl263/CS490-Beta/cs490-grader.php';
$ch = curl_init($url);
$ucid= $_SESSION['ucid'];
$answer1= $_POST['answer0'];
$answer2= $_POST['answer1'];
$answer3= $_POST['answer2'];
$ucid= $_SESSION['ucid'];
$examid= $_POST['examid'];
$answer1= urlencode($answer1);
$answer2= urlencode($answer2);
$answer3= urlencode($answer3);
$data_string= 'answer0='.$answer1 .'&answer1='.$answer2.'&answer2='.$answer3.'&ucid='.$ucid.'&examid='.$examid;
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>