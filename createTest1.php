<?php
session_start();
if(!isset($_SESSION['ucid'])&& !isset($_SESSION['pass'])){
	header("Location: https://web.njit.edu/~ksp52/cs490");
}
?>




<html>
<head>
	<title> Create A Test! </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script language="JavaScript">
	var qarrFinal=[];
	var qarr=[];
	var arr=[];
	var points=[];
	var length;
		function sendExam(){
			var bigstr='';
			var counter=0;
			var newarr=[];
			for(var i=0; i<qarrFinal.length; i++){
				newarr.push(qarrFinal[i]);
				
			}
			
			for(var j=0; j<newarr.length;j++){
				var point= document.getElementById(points[newarr[j]]).value;
				
				if(j==0){
					bigstr+= 'question' + j + '=' + qarr[newarr[j]];
					bigstr+= '&point' + j + '=' + point;
					
				}
				else{
					bigstr+= '&question' + j + '=' + qarr[newarr[j]];
					bigstr+= '&point' + j + '=' + point;
					
				}
				
			}
			var examName= document.getElementById("examName").value;
			bigstr+="&examName=" + examName;
			var sendexam= "sendExam.php";
			var req= new XMLHttpRequest();
			req.open("POST",sendexam,true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.send(bigstr);
			document.getElementById("outputqarr").innerHTML= "<h1> Exam Created </h1>";
			
		
		}
		
		function sendFunction1(){
			var addQuestion="createTest.php";
			var req= new XMLHttpRequest();
			var str='';
			req.open("POST",addQuestion,true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.onreadystatechange= function(){
				if (req.readyState==4 && req.status==200){
					var rdata= req.responseText;
					var data= JSON.parse(rdata);
					length=data.length;
					var html='<input type="text" id="myInput" placeholder="Search.." onkeyup="search();">';
					html+='Sort By Topic:' + '<select name="Select Topic" id="topic1" onChange="search();"><option value=""></option><option value="Loops">For Loops</option><option value="Functions">Functions</option><option value="File Handeling">File Handeling</option><option value="String Methods">String Methods</option><option value="Dictionaries">Dictionaries</option><option value="Turtle">Turtle</option></select>';
					html+='Sort By Difficulty:' + '<select name="Select Difficulty" id="diffi" onChange="search();"><option value=""></option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select>';
					html+='<br><br>';
					html+= '<table id="questionTable"><tr><td> Question</td><td>Topic</td><td>Difficulty</td></tr>';
					var htmlqarr= '<center> <label> <b> Exam Name: </b> </label><input type="text" id="examName" name="examName"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </center>';
					htmlqarr += '<table><tr><td>question</td><td>points</td><td> </td></tr>';
					for(var i=0;i<data.length;i++){
						qarr.push(data[i]['qid']);
						arr.push("test"+data[i]['qid']);
						points.push("points"+data[i]['qid']);
						
						html+='<tr id="right'+data[i]['qid']+'"><td class="expand">'+data[i]['question']+'</td>'+'<td class="shrink">'+data[i]['topic']+'</td>'+'<td class="shrink">'+data[i]['difficulty']+'</td>';
						
						html+='<td><input type="button" name="choices" class="abutton" value="Add" id="'+data[i]['qid']+'" onclick="addQuestion('+i+');"></td></tr>';
						
						htmlqarr+='<tr hidden id="tr'+data[i]['qid']+'"><td class="expand">'+data[i]['question']+'</td>';
						htmlqarr+='<td class="shrink"><input type="text" style="width: 30px" id="'+points[i]+'""text-align: arr"></td>';
						htmlqarr+='<td class="shrink"><input type="button" name="choices" class="dbutton" value= "Delete" onclick="removeQuestion('+i+');"id="test'+data[i]['qid']+'"></td></tr>';
						
					}
					htmlqarr+='<input type="button" value="Create Exam" id="save" onclick="sendExam();">'
					html+='</table>';
					htmlqarr+='</table>';
					document.getElementById("output").innerHTML= html;
					document.getElementById("outputqarr").innerHTML=htmlqarr;
				}
			
			
			}
			req.send(null);
			
		}
		function addQuestion(i){
			document.getElementById('tr'+qarr[i]).hidden=false;
			document.getElementById('right'+qarr[i]).hidden=true;
			qarrFinal.push(i);
			
		}
		function removeQuestion(i){
			var index= qarrFinal.indexOf(i);
			if(index > -1){
				qarrFinal.splice(index,1);
			}
			document.getElementById('tr'+qarr[i]).hidden=true;
			document.getElementById('right'+qarr[i]).hidden=false;
					
			
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
	<li> <a href="createTest1.php">Create a test</a> </li>
	<li> <a href="addQuestion1.php">Add a question</a> </li>
	<li> <a href="releaseScores1.php">Release Scores</a> </li>
	<li> <a href="logout.php">Logout</a> </li>
	<ul>
	
</div>
<div class="section1" onsubmit="return false">

<center> <h1> Your Test </h1> </center>
<br>



<div id="outputqarr"> </div>

</div>

<div class="section2" style="overflow-y: scroll; overflow-x:hidden; white-space: initial;">
<center> <h1> Questions Available </h1> </center>
<br>



<div id="output" > </div>

</div>


</body>
</html>