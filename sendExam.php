<?php
$url= 'https://web.njit.edu/~tl263/CS490-Beta/cs490-maketest.php';
$ch = curl_init($url); //curl
$question1= $_POST['question0'];
$question2= $_POST['question1'];
$question3= $_POST['question2'];
$examName= $_POST['examName'];
$point1= $_POST['point0'];
$point2= $_POST['point1'];
$point3= $_POST['point2'];
$data= array('question0' => $question1 , 'question1' => $question2, 'question2' => $question3, 'point1' => $point1, 'point2' => $point2, 'point3' => $point3, 'examName' => $examName );
$data_string= 'question0='.$data['question0'] .'&question1='.$data['question1'].'&question2='.$data['question2'].'&point1='.$data['point1'].'&point2='.$data['point2'].'&point3='.$data['point3'].'&examName='.$data['examName'];
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
echo($question2); 
?>