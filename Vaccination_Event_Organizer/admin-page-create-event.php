<?php
include('session_login.php');
if($login_session_user_type != "Admin") {
  if(session_destroy()){
      header("Location: login.php");
  }
}
$eventNameValid = "";
$eventname = "";
$eventvenue = "";
$eventdatestart = "";
$eventdateend = "";
$eventpicname = "";
$eventpicphone = "";
$eventpicAtvenuename = "";
$eventpicAtvenuephone = "";
if(isset($_POST['SubmitButton'])){ 
    $myeventname = $_POST['event_name']; 
    $eventname = $myeventname;
    $myeventvenue = $_POST['event_venue']; 
    $eventvenue = $myeventvenue;
    $myeventdatestart = $_POST['event_date_start']; 
    $eventdatestart = $myeventdatestart;
    $myeventdateend = $_POST['event_date_end']; 
    $eventdateend = $myeventdateend;
    $myeventpicname = $_POST['event_pic_name']; 
    $eventpicname = $myeventpicname;
    $myeventpicphone = $_POST['event_pic_phone']; 
    $eventpicphone = $myeventpicphone;
    $myeventpicAtvenuename = $_POST['event_pic_at_venue_name'];
    $eventpicAtvenuename = $myeventpicAtvenuename;
    $myeventpicAtvenuephone = $_POST['event_pic_at_venue_phone'];
    $eventpicAtvenuephone = $myeventpicAtvenuephone;

    $sql="SELECT * FROM active_event WHERE event_name = '$myeventname'";
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result)) {
        $eventNameValid = $row['event_name'];
    }

    if($eventNameValid == "") {
      $sql = "SELECT * FROM active_event WHERE event_id = (SELECT MAX(event_id) FROM active_event)";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result);
      $unique_id = $row['event_id'];
      $unique = "";
      If ($unique_id == "" ) {
          $unique_id = "AEID000001";
      }
      $iTemp = number_format(substr($unique_id, 4, strlen($unique_id)-4));
      //echo $iTemp . "<br>";
      $iTemp = $iTemp + 1;
      //echo $iTemp . "<br>";
      $unique_id = substr($unique_id, 0, 4) . sprintf('%06d', strval($iTemp)) ;
      //echo $unique_id;

      $sql = "INSERT INTO `active_event`(`event_id`, `event_name`, `event_venue`, `event_date_start`, `event_date_end`, `event_pic_name`, `event_pic_phone`, `event_pic_at_venue_name`, `event_pic_at_venue_phone`) VALUES
      ('$unique_id','$myeventname','$myeventvenue','$myeventdatestart','$myeventdateend','$myeventpicname','$myeventpicphone','$myeventpicAtvenuename','$myeventpicAtvenuephone')";
      $eventname = "";
      $eventvenue = "";
      $eventdatestart = "";
      $eventdateend = "";
      $eventpicname = "";
      $eventpicphone = "";
      $eventpicAtvenuename = "";
      $eventpicAtvenuephone = "";
      mysqli_query($db,$sql);
      mysqli_close($db);
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
  font-size: 10px;
  border-radius : 20px;
  color: white;
  font-family: monospace;
}

/* Create three unequal columns that floats next to each other */
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

.button {
    padding:5px 10px; 
    background:#0099cc;
    border:none;
    cursor:pointer;
    color:white;
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
input[type=text] {
  border: 0;
  outline: 0;
  background: transparent;
  border-bottom: 1px solid black;
  color : white;
  font-size: 12px;
  width: 206px;
  height: 20px;
  margin-left: 2%;
  text-align: left;
  font-family:monospace;
}
input[type=date] {
  border: 0;
  outline: 0;
  background: transparent;
  border-bottom: 1px solid black;
  color : white;
  font-size: 12.5px;
  width: 130px;
  height: 20px;
  margin-left: 2%;
  padding-left: 10px;
  text-align: left;
  font-family:monospace;
}
label{
  font-family: monospace;
  font-size: 12px; 
}
 h2{
    font-family:monospace;
    font-size : 28px;
    text-align: center;
    padding-bottom: 10px;
 }
</style>
<head>
    <title>Event Organizaer Create Event</title>
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
        <li style="float:right"><a href="admin-page-approval.php">Account Approval</a></li>
        <li style="float:right"><a href="">Event View</a></li>
        <li style="float:right"><a href="logout.php">Logout</a></li>
      </ul>
        </div>
  <div class="content">
    <h2>Create Event</h2>
  <form id="event-create" action="#" method="post" onsubmit="return validateForm()">
    <label for="">Event Name:</label>
    <input type="text" style="margin-left: 13.5%;" name="event_name" placeholder="Enter your event name" value=<?php echo "\"".$eventname."\"" ?>>
    <br>
    <span id="event_name_error"><?php if($eventNameValid != "") { echo"Event name has already been taken";} ?></span>
    <br><br>

    <label for="">Event Venue:</label>
    <input type="text" style="margin-left: 13%;" name="event_venue" placeholder="Enter your event venue name" value=<?php echo "\"".$eventvenue."\"" ?>>
    <br>
    <span id="event_venue_error"></span>
    <br><br>

    <label for="">Event Date Start:</label>
    <input type="date" style="margin-left: 9.5%;" name="event_date_start" placeholder="" value=<?php echo "\"".$eventdatestart."\"" ?>>
    <br>
    <span id="event_date_start_error"></span>
    <br><br>

    <label for="">Event Date End:</label>
    <input type="date" style="margin-left: 11%;" name="event_date_end" placeholder="" value=<?php echo "\"".$eventdateend."\"" ?>>
    <br>
    <span id="event_date_end_error"></span>
    <br><br>

    <label for="">Event PIC Name:</label>
    <input type="text" style="margin-left: 11%;" name="event_pic_name" placeholder="Enter PIC name" value=<?php echo "\"".$eventpicname."\"" ?>>
    <br>
    <span id="event_pic_name_error"></span>
    <br><br>

    <label for="">Event PIC Phone Number:</label>
    <input type="text" style="margin-left: 5.5%;" name="event_pic_phone" placeholder="Enter PIC phone number" value=<?php echo "\"".$eventpicphone."\"" ?>>
    <br>
    <span id="event_pic_phone_error"></span>
    <br><br>

    <label for="">Event at Venue Name:</label>
    <input type="text" style="margin-left: 7.5%;" name="event_pic_at_venue_name" placeholder="Enter PIC at venue name" value=<?php echo "\"".$eventpicAtvenuename."\"" ?>>
    <br>
    <span id="event_pic_at_venue_name_error"></span>
    <br><br>

    <label for="">Event at Venue Phone Number:</label>
    <input type="text" name="event_pic_at_venue_phone" placeholder="Enter PIC at venue phone number" value=<?php echo "\"".$eventpicAtvenuephone."\"" ?>>
    <br>
    <span id="event_pic_at_venue_phone_error"></span>
    <br><br>

    <input type="submit" class="button" name="SubmitButton"/>
</form>
          </div>
        </div>

      <div class="column side" style="">
      </div>

</div>
    
</body>
</html>

<script>
function validateForm() {
  var eventName = document.forms["event-create"]["event_name"].value;
  var eventVenue = document.forms["event-create"]["event_venue"].value;
  var eventDateStart = document.forms["event-create"]["event_date_start"].value;
  var eventDateEnd = document.forms["event-create"]["event_date_end"].value;
  var eventPICName = document.forms["event-create"]["event_pic_name"].value;
  var eventPICPhone = document.forms["event-create"]["event_pic_phone"].value;
  var eventPICatVenueName = document.forms["event-create"]["event_pic_at_venue_name"].value;
  var eventPICatVenuePhone = document.forms["event-create"]["event_pic_at_venue_phone"].value;
  var isValid = false
  if (eventName == "") {
    $("#event_name_error").html("Event name can't be blank")
    isValid = true
  }
  else {
    $("#event_name_error").html("")
  }

  if (eventVenue == "") {
    $("#event_venue_error").html("Event venue can't be blank")
    isValid = true
  }
  else {
    $("#event_venue_error").html("")
  }

  if (eventDateStart == "") {
    $("#event_date_start_error").html("Please select a date")
    isValid = true
  }
  else {
    $("#event_date_start_error").html("")
  }

  if (eventDateEnd == "") {
    $("#event_date_end_error").html("Please select a date")
    isValid = true
  }
  else {
    $("#event_date_end_error").html("")
  }

  if (eventPICName == "") {
    $("#event_pic_name_error").html("PIC name can't be blank")
    isValid = true
  }
  else {
    $("#event_pic_name_error").html("")
  }

  if (eventPICPhone == "") {
    $("#event_pic_phone_error").html("PIC phone number can't be blank")
    isValid = true
  }
  else {
    $("#event_pic_phone_error").html("")
  }

  if (eventPICatVenueName == "") {
    $("#event_pic_at_venue_name_error").html("PIC at venue name can't be blank")
    isValid = true
  }
  else {
    $("#event_pic_at_venue_name_error").html("")
  }

  if (eventPICatVenuePhone == "") {
    $("#event_pic_at_venue_phone_error").html("PIC at phone number can't be blank")
    isValid = true
  }
  else {
    $("#event_pic_at_venue_phone_error").html("")
  }

  if (isValid != false) {
    return false;
  }

}
</script>