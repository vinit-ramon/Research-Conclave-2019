<style>
input,textarea{width:250px}
textarea{height:200px}
input[type=submit]{width:150px}
</style>
<form method="post">
<table width="200" border="1">
  
  
  
  <tr>
    <td>Message</td>
    <td><textarea placeholder="contents"  type="text"
     name="text1"></textarea></td>
  </tr>
  <tr>
    <td colspan="2">
 <input type="submit" value="Save" name="save"/>
 <input type="submit" value="Display" name="disp"/>
</td>
  </tr>
  
</table>
</form>
<?php
 

$username = "";
$email    = "";
$errors = array(); 
$_SESSION['success'] = "";

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'login');
$text1 = mysqli_real_escape_string($db, $_POST['text1']);

//
    
  $query = "INSERT into notice (notice) VALUES ('".$text1."')";
  mysqli_query($db, $query);
//click on display button to show all values entered by you

?>