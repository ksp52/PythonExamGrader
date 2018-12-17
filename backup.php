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
	var qarr=[];
	var arr=[];
	var points=[];
	var length;
		function sendExam(){
			var bigstr='';
			var counter=0;
			var newarr=[];
			for(var i=0; i<length; i++){
				var chkbox= document.getElementById(qarr[i]);
				if(chkbox.checked){
					newarr.push(i);
				}
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
			window.alert(bigstr);
			
		
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
					var html= '<table><tr><td> Question</td><td>Topic</td><td>Difficulty</td></tr>';
					var htmlqarr= '<table><tr><td>question</td><td>points</td><td> </td></tr>';
					for(var i=0;i<data.length;i++){
						qarr.push(data[i]['qid']);
						arr.push("test"+data[i]['qid']);
						points.push("points"+data[i]['qid']);
						html+='<tr><td class="expand">'+data[i]['question']+'</td>'+'<td class="shrink">'+data[i]['topic']+'</td>'+'<td class="shrink">'+data[i]['difficulty']+'</td>';
						html+='<td><input type="checkbox" name="choices" value="'+data[i]['qid']+'"id="'+data[i]['qid']+'"></td></tr>';
						htmlqarr+='<tr hidden id="tr'+data[i]['qid']+'"><td class="expand">'+data[i]['question']+'</td>';
						htmlqarr+='<td class="shrink"><input type="text" style="width: 30px" id="'+points[i]+'""text-align: arr"></td>';
						htmlqarr+='<td class="shrink"><input type="checkbox" name="choices" value="'+data[i]['qid']+'"id="test'+data[i]['qid']+'"></td></tr>';
						
					}
					html+='</table>';
					htmlqarr+='</table>';
					document.getElementById("output").innerHTML= html;
					document.getElementById("outputqarr").innerHTML=htmlqarr;
				}
			
			
			}
			req.send(null);
			
		}
		function addQuestion(){
			for(var i=0; i<length; i++){
				var chkbox= document.getElementById(qarr[i]);
				if(chkbox.checked){
					document.getElementById('tr'+qarr[i]).hidden=false;
				}
			}
		}
		function removeQuestion(){
			for(var i=0; i<length; i++){
				var chkbox= document.getElementById(arr[i]);
				if(chkbox.checked){
					document.getElementById('tr'+qarr[i]).hidden=true;
					document.getElementById(qarr[i]).checked=false;
					chkbox.checked=false;
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
<center> <label> <b> Exam Name: </b> </label>
<input type="text" id="examName" name="examName"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input type="button" value="--->" id="save" onclick=removeQuestion();> </center>

<div id="outputqarr"> </div>
<input type="button" value="Create Exam" id="save" onclick="sendExam();">
</div>

<div class="section2" style="overflow-y: scroll; overflow-x:hidden; white-space: initial;">
<center> <h1> Questions Available </h1> </center>
<br>

<input type="button" value="<---" id="save" onclick=addQuestion();>

<div id="output" > </div>

</div>


</body>
</html>