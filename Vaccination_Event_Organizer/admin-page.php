<html>
    <head>
        <title>Event Organizer</title>
    </head>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  background-image: url(images/background5.jpg);
  background-size : cover;
}
h2{
  color:white;
  font-size:40px;
  text-align : left;
}
.header {
  padding:0px;
  text-align: center;
  font-size: 10px;
}
.content {
	margin: 10px 0 0 0 ;
	background-color: rgb(0,0,0,0.3);
  text-align: center;
  font-size: 10px;
  border-radius : 20px;
}
.column {
  float: left;
  padding: 10px;
  
}
.column.side {
  width: 10%;
}
.column.middle {
  width: 80%;
  border-radius:10px;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
@media (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  border-radius : 20px;
  background-color: rgb(0,0,0,0.3);
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px 14px;
  text-decoration: none;
  font-family:monospace;
  font-size : 15px;
}
li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}

.userInfo {
  display: block;
  color: white;
  text-align: center;
	height:100%;
  padding: 16px 14px;
  text-decoration: none;
}
p{
    color:white;
}
.image{
  width : 90%;
  height : 90%;
  background-image: url(images/content.png);
  background-size : cover;
  border-radius:20px;   
}
input[type=button] {
    display: block;
    width: 115px;
    height: 25px;
    background: tomato;
    text-align: center;
    border-radius: 5px;
    border-color : tomato;
    color: white;
    font-weight: bold;
    font-family:monospace;
}
</style>
<body>
<?php
include('session_login.php');
if($login_session_user_type != "Admin") {
    if(session_destroy()){
        header("Location: login.php");
    }
}
?>
<html>
<head>
    <title>Event Organizer</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>    


<div class="row">
  <div class="column side" style="">
  </div>
  <div class="column middle" style=" background-image: url(images/backgroundContainer2.png); background-size : cover;">
  	<div class="header">
  		<ul>
        	<li><a>Welcome <?php echo $login_session_username ?>!</a></li>
            <li><a><?php echo $login_session_user_type ?></a></li>
          <li style="float:right"><a href="admin-page.php">Home</a></li>
          <li style="float:right"><a href="admin-page-approval.php">Account Approval</a></li>
          <li style="float:right"><a href="admin-page-create-event.php">Create Event</a></li>
          <li style="float:right"><a href="public-page-event-view.php">Event View</a></li>
          <li style="float:right"><a href="logout.php">Logout</a></li>
        </ul>
	</div>
    <div class="content">
    <div class="row"style="padding:30px;height:80%;">
    <div class="column" style="width:50%;height:90%;margin-top:50px;">
      <div class="Text" style=" font-family:monospace;font-size : 12px; text-align : left;">
        <h2>Why is blood pressure important?</h2>
       <p>Blood pressure is important because the higher your blood pressure is, the higher your risk of health problems in the future.
        If your blood pressure is high, it is putting extra strain on your arteries and on your heart. Over time, this strain can cause the arteries to become to become thicker and less flexible, or to become weaker.</p>
      </div>
      <input type="button"value="Learn More">
  </div>
  <div class="column" style="width:50%;height:100%;">
    <div class="image">
    </div>
  </div>
    </div>
  </div>
  <div class="column side" style="">

  </div>
</div>
</body>
</html>
