<?php
// Karmesh Patel
session_start();
if(isset($_POST['ucid']) && isset($_POST['pass'])){
	$ucid = $_POST['ucid']; //ucid from form
	$pass= $_POST['pass'];  //ucid from form
	$url= 'https://web.njit.edu/~tl263/CS490-Beta/cs490-login.php';
	$ch = curl_init($url); //curl
	$data = array('ucid' => $ucid , 
				  'pass' => $pass);
	$data_string= 'ucid='.$data['ucid'] .'&pass='.$data['pass'];
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	$dec= json_decode($result);
	if($dec->type == 'student' && $dec->DB_reply=='Match'){
		echo("trues");
		$_SESSION['ucid']= $ucid;
		$_SESSION['pass']= $pass;
		
	}
	else if($dec->type == 'professor'&& $dec->DB_reply=='Match'){
		echo("truep");
		$_SESSION['ucid']= $ucid;
		$_SESSION['pass']= $pass;
		
	}
	else{
		echo("Incorrect username or password");
	}
}


?>
