<?php
// getting value of post parameter 
$room = $_POST['room'];
// checking for string size, it must be between 2 to 20 chatacters
if(strlen($room)>20 or strlen($room)<2)
{
    $message = "Please choose a name between 2 to 20 characters"; // create variable named message
    echo '<script language="javascript">';                        // create javascript
    echo 'alert("'.$message.'");';                                // create alert using javascript
    echo 'window.location="http://localhost/chatroom";';          // alert javascript location
    echo '</script>';
}
// checking whether room name is alphanumeric
else if(!ctype_alnum($room))
{
    $message = "Please choose an alphanumeric room name";         // create variable named message
    echo '<script language="javascript">';                        // create javascript
    echo 'alert("'.$message.'");';                                // create alert using javascript
    echo 'window.location="http://localhost/chatroom";';           // alert javascript location
    echo '</script>';
}

else
{   //we are delibrately connecting to database in last so that if error occured in above blocks it will not connect database and evade heavy load to database
    include 'db_connect.php';
}
  
// check if room already exists or not
$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if($result)
{
    if(mysqli_num_rows($result) > 0)
    {
        $message = "Please choose a different room name. This room is already claimed.";         // create variable named message
        echo '<script language="javascript">';                                                   // create javascript
        echo 'alert("'.$message.'");';                                                           // create alert using javascript
        echo 'window.location="http://localhost/chatroom";';                                     // alert javascript location
        echo '</script>';
    }
    else
    {
        $sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ( '$room', current_timestamp);";
        if(mysqli_query($conn, $sql))
        {
            $message = "Your room is ready and you can chat now.";         // create variable named message
            echo '<script language="javascript">';                        // create javascript
            echo 'alert("'.$message.'");';                               // create alert using javascript
            echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $room. '";';                                      // alert javascript location
            echo'</script>';
        }
    }
}
else
{
    echo "Error: ".mysqli_error($conn);
}
?>