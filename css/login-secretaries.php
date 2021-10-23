<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<style>

body {
  background-color: #05448D;
}

  div.img {
  padding-left: 437.5px;
  padding-top: 150px;
}
  
.box {
width: 600px;
padding:40px;
position:absolute;
top: 50%;
left: 40%;
transform: translate(-50%,-50%);
background: none;
text-align: center;
border-radius:5px;
}

.box h1{
color:white;
font-weight:500;
}

.box input[type = "text"],.box input[type = "password"]{
border:0;
background: white;
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid white;
padding: 14px 10px;
width: 200px;
outline: none;
color: black;
border-radius: 24px;
transition: 0.25s;
}

.box input[type = "text"]:focus,.box input[type = "password"]:focus{
width:280px;
border-color: white;
}

.box input[type= "submit"]{
border: 0;
background: #3674BA;
display: block;
margin: 20px auto;
text-align: center;
padding: 14px 25px;
width: 200px;
color: white;
border-radius: 24px;
transition: 0.25s;
cursor: pointer;
}

.box input[type= "submit"]:hover{
background: black;
}

 div.bottom {  
  padding-left: 404px;
  padding-top: 300px;
  color:white;
}

</head>
</style>
<body>

<div class="w3-sidebar w3-bar-block" style="width:15%; color:white; background:#3674BA; right:0px; font-size: 16px">
  <a href="#" class="w3-bar-item w3-button w3-border-bottom" style="margin-top:200px">Home</a>
  <a href="#" class="w3-bar-item w3-button w3-border-bottom" style="margin-top:75px">About</a>
  <a href="#" class="w3-bar-item w3-button w3-border-bottom">Appointment</a>
  <a href="#" class="w3-bar-item w3-button w3-border-bottom">Doctors</a>
  <a href="#" class="w3-bar-item w3-button w3-border-bottom">Secretary</a>
</div>

<div class="img"><img src="C:\Users\onelQtQt\Downloads\logo-modified.png" width="150" height="150"></div>

<form class="box" action="index.html" method="post">
 <h1>Welcome, Secretaries!</h1>
 <input type="text" name="" placeholder="username">
 <input type="password" name="" placeholder="password">  
 <input type="submit" name="" value="Login">
</form>

<div class="bottom">Don't have account? <a href="@">Sign up</a>
</body>
</html>
