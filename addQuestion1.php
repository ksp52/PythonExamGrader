<?php
session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}
?>


<html>
<head>
	<title> Add a question! </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script language="JavaScript">
	var z=0;
		function submitted(){
			document.getElementById("info").reset();
			window.alert("Question had been added!");
			
		}
		
		function sendFunction1(){
			var addQuestion="addQuestion.php";
			var req= new XMLHttpRequest();
			req.open("POST",addQuestion,true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.onreadystatechange= function(){
				if (req.readyState==4 && req.status==200){
					var rdata= req.responseText;
					var data= JSON.parse(rdata);
					var html="";
					html+='<input type="text" id="myInput" placeholder="Search.." onkeyup="search();">';
					html+='Sort By Topic:' + '<select name="Select Topic" id="topic1" onChange="search();"><option value=""></option><option value="For Loops">For Loops</option><option value="Functions">Functions</option><option value="File Handeling">File Handeling</option><option value="String Methods">String Methods</option><option value="Dictionaries">Dictionaries</option><option value="Turtle">Turtle</option></select>';
					html+='Sort By Difficulty:' + '<select name="Select Difficulty" id="diffi" onChange="search();"><option value=""></option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select>';
					html+='<br><br>';
					html+='<table id="questionTable"><tr><td> Question</td><td>Topic</td><td>Difficulty</td></tr>';
					for(var i=0; i<data.length;i++){
						html+='<tr>';
						html+= "<td class='expand'>" + data[i]['question'] + "</td>";
						html+= "<td class='shrink'>" + data[i]['topic'] + "</td>";
						html+= "<td class='shrink'>" + data[i]['difficulty'] + "</td>";
						html+= "</tr>";
					}
					html+='<table>';
					
					document.getElementById("output").innerHTML= html;
					
					
				}
			}
			req.send(null);
		//	document.getElementById("output").innerHTML= rdata;
			
		}
		
		function sendFunction(){
			var encodePlus= encodeURIComponent('+');
			var addQuestion="addQuestion.php";
			var req= new XMLHttpRequest();
			var question= document.getElementById("myTextArea").value;
			var topic= document.getElementById("topic").value;
			var difficulty= document.getElementById("difficulty").value;
			var testcase1= document.getElementById("testcase1").value;
			var testcase1ans= document.getElementById("testcaseans1").value;
			var testcase2= document.getElementById("testcase2").value;
			var testcase2ans= document.getElementById("testcaseans2").value;
			var testcase3= document.getElementById("testcase3").value;
			var testcase3ans= document.getElementById("testcaseans3").value;
			var testcase4= document.getElementById("testcase4").value;
			var testcase4ans= document.getElementById("testcaseans4").value;
			var testcase5= document.getElementById("testcase5").value;
			var testcase5ans= document.getElementById("testcaseans5").value;
			var testcase6= document.getElementById("testcase6").value;
			var testcase6ans= document.getElementById("testcaseans6").value;
			var funcName= document.getElementById("funcName").value;
			var constraint= document.getElementById("constraint").value;
			var str= "question="+question+"&topic="+topic+"&difficulty="+difficulty+"&funcName="+ funcName+"&testcase1="+testcase1+"&testcaseans1="+ testcase1ans+"&testcase2="+testcase2+"&testcaseans2="+testcase2ans+"&testcase3="+testcase3+"&testcaseans3="+testcase3ans+"&testcase4="+testcase4+"&testcaseans4="+testcase4ans+"&testcase5="+testcase5+"&testcaseans5="+ testcase5ans+"&testcase6="+testcase6+"&testcaseans6="+ testcase6ans+"&constraint="+constraint;
			req.open("POST",addQuestion,true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.onreadystatechange= function(){
				if (req.readyState==4 && req.status==200){
					var rdata= req.responseText;
					var data= JSON.parse(rdata);
					var html="";
					html+='<input type="text" id="myInput" placeholder="Search.." onkeyup="search();">';
					html+='Sort By Topic:' + '<select name="Select Topic" id="topic1" onChange="search();"><option value=""></option><option value="Loops">Loops</option><option value="Functions">Functions</option><option value="Conditionals">Conditionals</option><option value="String Methods">String Methods</option><option value="Dictionaries">Dictionaries</option><option value="Turtle">Turtle</option></select>';
					html+='Sort By Difficulty:' + '<select name="Select Difficulty" id="diffi" onChange="search();"><option value=""></option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select>';
					html+='<br><br>';
					html+='<table id="questionTable"><tr><td> Question</td><td>Topic</td><td>Difficulty</td></tr>';
					for(var i=0; i<data.length;i++){
						html+='<tr>';
						html+= "<td class='expand'>" + data[i]['question'] + "</td>";
						html+= "<td class='shrink'>" + data[i]['topic'] + "</td>";
						html+= "<td class='shrink'>" + data[i]['difficulty'] + "</td>";
						html+= "</tr>";
					}
					html+='<table>';
					document.getElementById("output").innerHTML= html;
					
					
				}
			}
			str = str.split('+').join(encodePlus);
			req.send(str);
			z+=1;
		
			
		}
		
		function search(){
			var searchInput= document.getElementById("myInput").value;
			var sTopic= document.getElementById("topic1").value;
			var sDiff= document.getElementById("diffi").value;
			var uSearchInput= searchInput.toUpperCase();
			var usTopic= sTopic.toUpperCase();
			var uDiff= sDiff.toUpperCase();
			var table= document.getElementById("questionTable");
			var tr= table.getElementsByTagName("tr");
			for(var i=0; i<tr.length; i++){
				var question= tr[i].getElementsByTagName("td")[0];
				var topic= tr[i].getElementsByTagName("td")[1];
				var difficulty= tr[i].getElementsByTagName("td")[2];
				if(question||topic||difficulty){
				if(question.innerHTML.toUpperCase().indexOf(uSearchInput)> -1 && topic.innerHTML.toUpperCase().indexOf(usTopic)> -1 && difficulty.innerHTML.toUpperCase().indexOf(uDiff)> -1){
					tr[i].style.display="";
				}
				else{
					tr[i].style.display="none";
				}
				}
			}
		}
		function toggleSidebar(){
			document.getElementById("sidebar").classList.toggle("active");
		}
		function refresh(){
			if(z>=2){
				sendFunction1();
			}
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
	<li> <a href="createTest1.php">Create a test</a> </li>
	<li> <a href="addQuestion1.php">Add a question</a> </li>
	<li> <a href="releaseScores1.php">Release Scores</a> </li>
	<li> <a href="logout.php">Logout</a> </li>
	<ul>
	
</div>
<div class="section1" onsubmit="return false">

<br>
<br>
<br>
<br>
<br>
<center> <h1> Add a question to the bank </h1> </center>
<form name="info" id="info">
		
        <label><b>Enter Question: </b> </label>
		<br>
        <textarea id = "myTextArea" rows = "11" cols = "80" required ></textarea>
		<br>
        <label><b> Topic: </b> </label>
		<br>
		<select name="Select Topic" id="topic">
			<option value="Loops">Loops</option>
			<option value="Functions">Functions</option>
			<option value="Conditionals">Conditionals</option>
			<option value="StringMethods">String Methods</option>
			<option value="Dictionaries">Dictionaries</option>
			<option value="Turtle">Turtle</option>
			
		</select>
		
		<label> <b> Difficulty: </b> </label>
		<select name="Select Difficulty" id="difficulty">
			<option value="Easy">Easy</option>
			<option value="Medium">Medium</option>
			<option value="Hard">Hard</option>
		</select>
		<br>
		<br>
		<label> <b> Function Name: </b> </label>
		<br>
		<input type="text" id="funcName" name="funcName">
		<br>
		<label> <b> Test Cases: </b> </label>
		<br>
		
		<input type="text" id="testcase1" name="testcase1">
		<input type="text" id="testcaseans1" name="testcaseans1">
		<br>
		<input type="text" id="testcase2" name="testcase2">
		<input type="text" id="testcaseans2" name="testcaseans2">
		<br>
		<input type="text" id="testcase3" name="testcase3">
		<input type="text" id="testcaseans3" name="testcaseans3">
		<br>
		<input type="text" id="testcase4" name="testcase3">
		<input type="text" id="testcaseans4" name="testcaseans3">
		<br>
		<input type="text" id="testcase5" name="testcase3">
		<input type="text" id="testcaseans5" name="testcaseans3">
		<br>
		<input type="text" id="testcase6" name="testcase3">
		<input type="text" id="testcaseans6" name="testcaseans3">
		<br>
		<label><b> Constraint: </b> </label>
		<br>
		<select id="constraint">
			<option>  </option>
			<option>For Loop</option>
			<option>While Loops</option>
			<option>Recursion</option>
		</select>
		<br>
		<br>
		<br>
		<button type="submit" onclick="sendFunction(); submitted(); refresh();">Submit</button>
		
		
</form>
<br>
<br>

</div>
<div class="section2" style="overflow-y: scroll; overflow-x:hidden; white-space: initial;">
<center> <h1> Questions Available </h1> </center>
<br>

<br>
<div id="output">


 </div>
</div>


</body>
</html>

