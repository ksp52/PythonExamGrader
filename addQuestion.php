<?php
// Karmesh Patel
session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}

$url= 'https://web.njit.edu/~tl263/CS490-Beta/cs490-addquestion.php';
if(isset($_POST['delString'])){
	$ch = curl_init($url); //curl
	$delString= $_POST['delString'];
	$data_string= 'delString='.$delString;
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
}
else{
	$question = $_POST['question']; //ucid from form
	$topic= $_POST['topic'];  //ucid from form
	$difficulty= $_POST['difficulty'];
	$testcase1= $_POST['testcase1'];
	$testcase1= urlencode($testcase1);
	$testcase1ans= $_POST['testcaseans1'];
	$testcase2= $_POST['testcase2'];
	$testcase2= urlencode($testcase2);
	$testcase2ans= $_POST['testcaseans2'];
	$testcase3= $_POST['testcase3'];
	$testcase3= urlencode($testcase3);
	$testcase3ans= $_POST['testcaseans3'];
	$testcase4= $_POST['testcase4'];
	$testcase4= urlencode($testcase4);
	$testcase4ans= $_POST['testcaseans4'];
	$testcase5= $_POST['testcase5'];
	$testcase5= urlencode($testcase5);
	$testcase5ans= $_POST['testcaseans5'];
	$testcase6= $_POST['testcase6'];
	$testcase6= urlencode($testcase6);
	$testcase6ans= $_POST['testcaseans6'];
	$funcName= $_POST['funcName'];
	$constraint= $_POST['constraint'];
	$ch = curl_init($url); //curl
	$data = array('question' => $question , 'topic' => $topic,
					  'difficulty' => $difficulty,'testcase1'=>$testcase1,'testcaseans1'=>$testcase1ans,'testcase2'=>$testcase2,'testcaseans2'=>$testcase2ans,'testcase3'=>$testcase3,'testcaseans3'=>$testcase3ans,'constraint'=>$constraint);
	$data_string= 'question='.$question.'&topic='.$topic.'&difficulty='. $difficulty.'&testcase1='.$testcase1 . '&testcaseans1='.$testcase1ans.'&testcase2='.$testcase2 .'&testcaseans2='.$testcase2ans.'&testcase3='.$testcase3.'&testcaseans3='.$testcase3ans.'&funcName='.$funcName.'&constraint='.$constraint.'&testcase4='.$testcase4.'&testcaseans4='.$testcase4ans.'&testcase5='.$testcase5 . '&testcaseans5='.$testcase5ans.'&testcase6='.$testcase6 . '&testcaseans6='.$testcase6ans;
	
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
}
$result = curl_exec($ch);
curl_close($ch);
echo($result);
?>