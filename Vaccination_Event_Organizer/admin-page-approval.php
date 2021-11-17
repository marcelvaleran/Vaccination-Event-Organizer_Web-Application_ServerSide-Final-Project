<?php
include('session_login.php');
if($login_session_user_type != "Admin") {
    if(session_destroy()){
        header("Location: login.php");
    }
}
?>
<html>
<style type="text/css">
  * {
  box-sizing: border-box;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  background-image: url(images/background6.jpg);
  background-size : cover;
}
/* Style the header */
.header {

  padding:0px;
  text-align: center;
  font-size: 10px;
}
.content {
  margin: 10px 0 0 0 ;
  background-color: rgb(0,0,0,0.3);
  padding:10px;
  padding-left: 40px;
  text-align: left;
  font-size: 12px;
  border-radius : 20px;
  color: white;
  font-family: monospace;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
}
/* Left and right column */
.column.side {
  width: 10%;
}

/* Middle column */
.column.middle {
  width: 80%;
  border-radius: 10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
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
  padding: 14px 10px;
  text-decoration: none;
  font-family:monospace;
  font-size : 14px;

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

.button {
    padding:5px 10px; 
    background:#0099cc;
    border:none;
    cursor:pointer;
    color:white;
    margin-left: 26%;
    border-radius: 30px; 
    width: 90px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 16px;
    margin-top: 10px;
}
.button:hover{
  background-color:#00ccff; 
  transition-duration: 0.4s;
}
h2{
    font-family:monospace; 
    font-size:28px; 
    text-align: center; 
    padding-bottom: 10px;
}
</style>
<link rel="stylesheet" type="text/css" href="css/approvalPage.css">
<head>
    <title>Event Organizaer Approval</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>    
    <div class="row">
  <div class="column side" style="">
  </div>

  <div class="column middle" style=" background-image: url(images/backgroundContainer.png); background-size : cover;">
    <div class="header">
      <ul>
      <li><a>Welcome <?php echo $login_session_username ?>!</a></li>
      <li><a><?php echo $login_session_user_type ?></a></li>
      <li style="float:right"><a href="admin-page.php">Home</a></li>
      <li style="float:right"><a href="admin-page-create-event.php">Create Event</a></li>
      <li style="float:right"><a href="logout.php">Logout</a></li>
      </ul>
  </div>
    <div class="content">
      <h2>Approval</h2>
<form action="#" method="post">
    
<?php
$sql = "SELECT username,user_fullname FROM user_temp";
$result = mysqli_query($db,$sql);
if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo"<div>";
        echo "<label class=\"container\">" . $row["username"] . "    (" . $row["user_fullname"] . ")";
        echo "<input type=\"checkbox\" name=\"check_list[]\" value=\"" . $row["username"] . "\">";
        echo "<span class=\"checkmark\"></span>";
        echo "</label>";
        echo "</div>";    
    }
}
//mysqli_close($db);
?>
    <br>
    <input type="submit" class="button" name="Approved" value="Approved"/>
    <input type="submit" class="button" name="Denied" value="Denied"/>
</form>
    </div>
  </div>

  <div class="column side" style="">
  </div>

</div>

</body>
</html>

<?php
if(isset($_POST['Approved'])){
    if(!empty($_POST['check_list'])){
        foreach($_POST['check_list'] as $selected){
            
            $sql = "SELECT * FROM user WHERE userid = (SELECT MAX(userid) FROM user)";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result);
            $unique_id = $row['userid'];
            $unique = "";
            If ($unique_id == "" ) {
                $unique_id = "UID0000000";
            }
            $iTemp = number_format(substr($unique_id, 3, strlen($unique_id)-3));
            //echo $iTemp . "<br>";
            $iTemp = $iTemp + 1;
            //echo $iTemp . "<br>";
            $unique_id = substr($unique_id, 0, 3) . sprintf('%07d', strval($iTemp)) ;
            //echo $unique_id;
            $sql = "SELECT username,password,user_fullname,user_gender,user_type,student_id FROM user_temp where username='$selected'";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result);
            // echo $row['user_fullname'];
            $unique_username = $row['username'];
            $unique_password = $row['password'];
            $unique_user_fullname = $row['user_fullname'];
            $unique_user_gender = $row['user_gender'];
            $unique_user_type = $row['user_type'];
            $student_id = $row['student_id'];
            $sql = "DELETE FROM user_temp WHERE username='$selected'";
            mysqli_query($db,$sql);
            $sqln = "INSERT INTO user(userid,username,password,user_fullname,user_gender,user_type,student_id)VALUES 
            ('$unique_id','$unique_username','$unique_password','$unique_user_fullname','$unique_user_gender','$unique_user_type','$student_id')";
            $result = mysqli_query($db,$sqln);
        }
        header("Refresh:0");
    }
}
if(isset($_POST['Denied'])){
    if(!empty($_POST['check_list'])){
        foreach($_POST['check_list'] as $selected){
            $sql = "DELETE FROM user_temp WHERE username='$selected'";
            mysqli_query($db,$sql);   
        }
        header("Refresh:0");
    }
}
?>