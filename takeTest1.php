<?php
session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}
?>



<html>
<head>
<title> Taking the test! </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
	
	function sendAnswers(examid){
		var encodePlus= encodeURIComponent('+');
		var bigstr='';
		var answers= document.getElementsByName("answers");
		var sendexam= "takeTest.php";
		var req= new XMLHttpRequest();
		req.open("POST",sendexam,true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		for(var i=0; i<answers.length; i++){
			if(i==0){
				bigstr+="answer" + i + "=" + answers[i].value;
			}
			else{
				bigstr+="&answer" + i + "=" + answers[i].value;
			}
		}
		bigstr+="&examid=" + examid;
		bigstr = bigstr.split('+').join(encodePlus);
		req.send(bigstr);
		
		
	}
	function sendFunction(){
		var str='';
		var addQuestion="takeTest.php";
		var req= new XMLHttpRequest();
		req.open("POST",addQuestion,true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.onreadystatechange= function(){
			if (req.readyState==4 && req.status==200){
				var rdata= req.responseText;
				var myobj= JSON.parse(rdata);
				var html='';
				var examid= myobj[0]['examid'];
				for(var i=0; i<4; i++){
					if(i==0){
						html+='<h1> Exam Name: ' + myobj[0]['eName'] + '</h1>';
						html+='<br> <center>';
						
					}
					else{
						html+=myobj[0]['question'+i];
						html+='('+ myobj[0]['q'+i+'value']+ ' points)';
						html+='<br>';
						html+='<textarea id = "myTextArea" rows = "11" cols = "80" name="answers" ></textarea>';
						html+='<br>';
					}
				}
				html+= '<br><br><input type="button" value="Submit Test" onclick="sendAnswers('+examid+'); submitted();">';
				
				document.getElementById("output").innerHTML= html; 
			}
		
		
			
	}
	req.send(null);
	}
	function toggleSidebar(){
		document.getElementById("sidebar").classList.toggle("active");
	}
	function submitted(){
		var html="<h1> Exam answers have been submitted, please wait for your professor to release the scores </h1>";
		document.getElementById("output").innerHTML= html; 
		
	}
	
</script>
</head>
<body onload=sendFunction();>
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
<div id="output"> </div>





</body>
</html>