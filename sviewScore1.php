<?php
session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}
?>



<html>
<head>
<title> View Scores! </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function sendFunction1(){
	var addQuestion="sviewScore.php";
	var req= new XMLHttpRequest();
	var str='';
	req.open("POST",addQuestion,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange= function(){
	if (req.readyState==4 && req.status==200){
		var rdata= req.responseText;
		var data= JSON.parse(rdata);
		var i= data.length-1;
		var g1= data[i]['g1'];
		var g2= data[i]['g2'];
		var g3= data[i]['g3'];
		var totalg= Number(g1)+Number(g2)+Number(g3);
		var question1value= data[i]['q1v'];
		var question2value= data[i]['q2v'];
		var question3value= data[i]['q3v'];
		var totalvalue= Number(question1value)+Number(question2value)+Number(question3value);
		var html="<div class='grade1'>";
		html+="<h1>Viewing grades for exam: " + data[i]['eName'] + "</h1><center>";
		html+="<p> Final Score: " + totalg + "/" + totalvalue + "</p>";
		html+="Question 1 grade got: " + data[i]['g1'] + "<br>";
		html+="Question 1 grade total: " + data[i]['q1v']+" <br>";
		html+="<br><br>Your answer: <br><pre>";
		html+= data[i]['sub1'];
		html+= "</pre><br> <br>";
		var grading1= data[i]['gc1'];
		var garr1= grading1.split(',');
		html+="<div class='boxxed'>";
		for(var j=0; j<garr1.length; j++){
		
			if(garr1[j].indexOf('-')== -1){
				html+=garr1[j];
				html+="<br>";
			}
		}
		html+="</div>";
		html+="<div class='boxxed1'>";
		for(var j=0; j<garr1.length; j++){
		
			if(garr1[j].indexOf('-')> -1){
				html+=garr1[j];
				html+="<br>";
			}
		}
		html+="</div>";
		html+="<br> Teacher Comment: <br>";
		html+='<textarea id = "comment3" rows = "11" cols = "80" name="answers">'+data[i]['tc1']+'</textarea>';
		html+="</div><br><br><div class='grade1'><center>";
		html+="Question 2 grade got: " + data[i]['g2'] + "<br>";
		html+="Question 2 grade total: " + data[i]['q2v']+" <br>";
		html+="<br><br>Your answer: <br><pre>";
		html+= data[i]['sub2'];
		html+= "</pre><br> <br>";
		var grading2= data[i]['gc2'];
		var garr2= grading2.split(',');
		html+="<div class='boxxed'>";
		for(var j=0; j<garr2.length; j++){
			if(garr2[j].indexOf('-')==-1){
				html+=garr2[j];
				html+="<br>";
			}
		}
		html+="</div>";
		html+="<div class='boxxed1'>";
		for(var j=0; j<garr2.length; j++){
			if(garr2[j].indexOf('-')>-1){
				html+=garr2[j];
				html+="<br>";
			}
		}
		html+="</div>";
		html+="<br> Teacher Comment: <br>";
		html+='<textarea id = "comment3" rows = "11" cols = "80" name="answers">'+data[i]['tc2']+'</textarea>';
		//html+=data[i]['tc1'];
		
		html+="</div><br><br><div class='grade1'><center>";
		html+="Question 3 grade got: " + data[i]['g3'] + "<br>";
		html+="Question 3 grade total: " + data[i]['q3v']+" <br>";
		html+="<br><br>Your answer: <br><pre>";
		html+= data[i]['sub3'];
		html+= "</pre><br> <br>";
		var grading3= data[i]['gc3'];
		var garr3= grading3.split(',');
		html+="<div class='boxxed'>";
		for(var j=0; j<garr3.length; j++){
			if(garr3[j].indexOf('-')== -1){
				html+=garr3[j];
				html+="<br>";
			}
		}
		html+="</div>";
		html+="<div class='boxxed1'>";
		for(var j=0; j<garr3.length; j++){
			if(garr3[j].indexOf('-')> -1){
				html+=garr3[j];
				html+="<br>";
			}
		}
		html+="</div>";
		html+="<br> Teacher Comment: <br>";
		html+='<textarea id = "comment3" rows = "11" cols = "80" name="answers">'+data[i]['tc3']+'</textarea>';
		html+="</div>";
		html+="<br><br><br>";
		document.getElementById("output").innerHTML= html;
	}
	}
	req.send(null);
			
}
function toggleSidebar(){
	document.getElementById("sidebar").classList.toggle("active");
}

</script>
</head>
<body onload=sendFunction1();>
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