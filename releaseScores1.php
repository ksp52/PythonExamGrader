<?php
session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}
?>



<html>
<head>
<title> Release Scores! </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function sendForReal(str){
	var encodePlus= encodeURIComponent('+');
	var addQuestion="releaseScores.php";
	var req= new XMLHttpRequest();
	req.open("POST",addQuestion,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	str = str.split('+').join(encodePlus);
	req.send(str);
	document.getElementById("output").innerHTML="<h1> Scores have been released! </h1>";
	
}
function sendScore(i){
	var g1= document.getElementById("grade1").value;
	var g2= document.getElementById("grade2").value;
	var g3= document.getElementById("grade3").value;
	var comment1= document.getElementById("comment1").value;
	var comment2= document.getElementById("comment2").value;
	var comment3= document.getElementById("comment3").value;
	var addQuestion="releaseScores.php";
	var req= new XMLHttpRequest();
	var str='';
	req.open("POST",addQuestion,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange= function(){
	if (req.readyState==4 && req.status==200){
		var rdata= req.responseText;
		var data= JSON.parse(rdata);
		var gid= data[i]['gid'];
		var gc1= data[i]['comment1'];
		var gc2= data[i]['comment2'];
		var sub1= data[i]['sub1'];
		var sub2= data[i]['sub2'];
		var sub3= data[i]['sub3'];
		var eName= data[i]['eName'];
		var gc3= data[i]['comment3'];
		var ucid= data[i]['ucid'];
		var point1= data[i]['q1v'];
		var point2= data[i]['q2v'];
		var point3= data[i]['q3v'];
		str="gid="+gid+"&ucid="+ucid+"&comment1="+comment1+"&comment2="+comment2+"&comment3="+comment3+"&point1="+point1+"&point2="+point2+"&point3="+point3;
		if(g1==""){
			str+="&grade1="+data[i]['g1'];
		}
		else{
			str+="&grade1="+g1;
		}
		if(g2==""){
			str+="&grade2="+data[i]['g2'];
		}
		else{
			str+="&grade2="+g2;
		}
		if(g3==""){
			str+="&grade3="+data[i]['g3'];
		}
		else{
			str+="&grade3="+g3;
		}
		str+="&examid="+data[i]['examid'];
		str+="&gc1="+gc1;
		str+="&gc2="+gc2;
		str+="&gc3="+gc3;
		str+="&sub1="+sub1;
		str+="&sub2="+sub2;
		str+="&sub3="+sub3;
		str+="&eName="+eName;
		
		sendForReal(str);
	}
	
	}
	req.send(null);
	
	
}
function viewData(i){
	var addQuestion="releaseScores.php";
	var req= new XMLHttpRequest();
	var str='';
	req.open("POST",addQuestion,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange= function(){
	if (req.readyState==4 && req.status==200){
		var rdata= req.responseText;
		var data= JSON.parse(rdata);
		var g1= data[i]['g1'];
		var g2= data[i]['g2'];
		var g3= data[i]['g3'];
		var totalg= Number(g1)+Number(g2)+Number(g3);
		var question1value= data[i]['q1v'];
		var question2value= data[i]['q2v'];
		var question3value= data[i]['q3v'];
		var totalvalue= Number(question1value)+Number(question2value)+Number(question3value);
		var arr=[];
		var html= "<center>";
		var comment1= data[i]['comment1'].split('.')
		html+= "<h1> Viewing grade for " + data[i]['ucid'] + "</h1><br>";
		html+= "<h1> Exam Name: " + data[i]['eName'] + "</h1><br>";
		html+="<p> Final Score: " + totalg + "/"+ totalvalue + "</p>";
		html+="<p> Question 1: Points:" + data[i]['g1'] + "/"+data[i]['q1v']+"&nbsp;&nbsp;&nbsp; edit score:<input type='text' id='grade1'></p>";
		html+="<br>Student Answer:<pre>"+ data[i]['sub1'] + "</pre><br>";
		var grading1= data[i]['comment1'];
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
		html+="<br><br><br><br>";
		html+='<textarea id = "comment1" rows = "11" cols = "80" name="answers" placeholder="Leave a comment" ></textarea>';
		html+="<p> Question 2: Points:" + data[i]['g2'] + "/"+data[i]['q2v']+"&nbsp;&nbsp;&nbsp; edit score:<input type='text' id='grade2'></p>";
		html+="<br>Student Answer:<pre>"+ data[i]['sub2'] + "</pre><br>";
		var grading2= data[i]['comment2'];
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
		html+="<br><br><br><br>";
		html+='<textarea id = "comment2" rows = "11" cols = "80" name="answers" placeholder="Leave a comment" ></textarea>'
		html+="<p> Question 3: Points:" + data[i]['g3'] + "/"+data[i]['q3v']+"&nbsp;&nbsp;&nbsp; edit score:<input type='text' id='grade3'></p>";
		html+="<br>Student Answer:<pre>"+ data[i]['sub3'] + "</pre><br>";
		var grading3= data[i]['comment3'];
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
		html+="<br><br><br><br>";
		html+='<textarea id = "comment3" rows = "11" cols = "80" name="answers" placeholder="Leave a comment" ></textarea>';
		html+='<br><br>';
		html+= '<button type="submit" onclick="sendScore('+i+');">Release Score</button>';
		
		
		document.getElementById("output").innerHTML= html;
	}
	}
	req.send(null);
}
function sendFunction1(){
	var addQuestion="releaseScores.php";
	var req= new XMLHttpRequest();
	var str='';
	req.open("POST",addQuestion,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange= function(){
	if (req.readyState==4 && req.status==200){
		var arr=[];
		var rdata= req.responseText;
		var data= JSON.parse(rdata);
		var html= "<br><br><br><br>";
		html+= "<center><p> List of all the students that took the test: </p>";
		for(var i=0; i<data.length; i++){
			
			html+="<button onclick='viewData("+i+");'> View Grades for " + data[i]['ucid'] + "</button><br>";
			
		}
		
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
<body onload="sendFunction1();">
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

<div id="output"> </div>

</body>
</html>