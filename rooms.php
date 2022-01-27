<?php

//Get parameters
$roomname = $_GET['roomname'];             // variable is roomname

//connecting to the database
include 'db_connect.php';

//Execute sql to check whether room exists
$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";
$result = mysqli_query($conn, $sql);
if($result)
{
    //Check if room exists
    if(mysqli_num_rows($result) ==0)
    {
        $message = " This room does not exists. Try creating a new one.";             // create variable named message
        echo '<script language="javascript">';                                       // create javascript
        echo 'alert("'.$message.'");';                                              // create alert using javascript
        echo 'window.location="http://localhost/chatroom"';                        // alert javascript location
        echo'</script>';
    }
}
else
{
    echo "Error :".mysqli_error($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">
<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}
.btn {
  background-color: black; 
  color: white;
  padding: 15px 32px;
  text-align: center;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.container {
  border: 2px solid #ccc;
  background-color: #b3b3b3;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-radius: 5px;
  border-color: #ccc;
  background-color: #b3b3b3;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}


.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass{
    height:350px;
    overflow-y: auto;
}
</style>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="#" class="d-flex align-items-center text-dark text-decoration-none">    
        <span class="fs-4">Confidential Chat App</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="http://localhost/chatroom/">Home</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">About</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Contact</a>
        
      </nav>
    </div>


<div class="container"><h2>connected_room:-> <?php echo $roomname;?><img src="img/favicon.jpg" alt="Avatar" style="float:right" ></h2>
</div>

<div class="container darker">

    <div class="anyClass">
    
    </div>

</div>



<input type="text" class="form-control"name="usermsg" id ="usermsg" placeholder="Add message"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">SEND</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

 
<script 
  src="https://code.jquery.com/jquery-3.6.0.min.js"  
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>

<script type="text/javascript">               //javascript 

//Check for new message every 1000 milli seconds
setInterval(runFunction, 1000);
function runFunction()
{
      $.post("htcont.php", {room:'<?php echo $roomname ?>'},
        function(data, status)
          {
            document.getElementsByClassName('anyClass')[0].innerHTML = data;
          }
        )
}



// using enter key to submit,trigger when ENTER button is pressed 
var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) 
  {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});


 $("#submitmsg").click(function()
 {                                                                //when submitmsg is clicked
      var clientmsg=$("#usermsg").val();                         //creating variable
     $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},function(data, status){
      document.getElementsByClassName('anyClass')[0].innerHTML = data;});
     $("#usermsg").val("");  
    return false;  
    
  }
);
</script>
</body>
</html>
