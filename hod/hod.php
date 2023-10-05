<?php
$username = "root"; 
$password = ""; 
$database = "it_dept_details";
$conn=mysqli_connect("localhost",$username,$password,$database);
if (isset($_GET['submit'])) {
  $year=$_GET['year'];
  $choice=$_GET['choice'];
  if ($choice=='Academic') {
    $query = "SELECT * FROM stddetails where Year='$year'";
echo '<table align="center" border="1" cellspacing="0" noresize cellpadding="30" style="width:70% ;  text-align=center ; "> 
    <tr>
          <td> <font face="Arial">Regd. No.</font> </td>
          <td> <font face="Arial">Name</font> </td>  
          <td> <font face="Arial">Year</font> </td>
          <td> <font face="Arial">Regulation</font> </td>
          <td> <font face="Arial">CGPA</font> </td>
    </tr>
';

if ($result=mysqli_query($conn,$query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["Regd. No."];
        $field2name = $row["Name"];
        $field3name = $row["Year"];
        $field4name = $row["Regulation"];
        $field5name = $row["cgpa"];
        echo '
        <tr>
          <td>'.$field1name.'</td> 
          <td>'.$field2name.'</td> 
          <td>'.$field3name.'</td> 
          <td>'.$field4name.'</td> 
          <td>'.$field5name.'</td>
        ';
    }
    $result->free();
  }
} 
if ($choice=='activities') {
    $query = "SELECT * FROM activity where `Year` ='$year'";
echo '<table align="center" border="1" cellspacing="0" noresize cellpadding="30" style="width:70% ;  text-align=center ; "> 
    <tr>
          <td> <font face="Arial">Regd. No.</font> </td>
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">Year</font> </td>  
          <td> <font face="Arial">CoCurricular</font> </td>
          <td> <font face="Arial">ExtraCurricular</font> </td>
          <td> <font face="Arial">Certification</font> </td>
    </tr>
';

if ($result=mysqli_query($conn,$query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["Regdno"];
        $field2name = $row["Name"];
        $field3name = $row["year"];
        $field4name = $row["CoCurricular"];
        $field5name = $row["ExtraCurricular"];
        $field6name = $row["certification"];
        echo '
        <tr>
          <td>'.$field1name.'</td> 
          <td>'.$field2name.'</td> 
          <td>'.$field3name.'</td> 
          <td>'.$field4name.'</td> 
          <td>'.$field5name.'</td>
          <td>'.$field6name.'</td>
        ';
    }
    $result->free();
  }
} 

}
?>
<!DOCTYPE html>
<html>
<body>

  <div>
  <input type="button" value="Home" onClick="document.location.href='hod.php'" />
        <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
    </div>
  <center>
<form action="#" method="GET">
  <input type="number"  name="year">
  <select name="choice" id="choice">
    <option value="Academic" name="academic">Academic</option>
    <option value="activities" name="activities">Extra-curricular/Co-curricular</option>
  </select>
  <br><br>
  <input type="submit" name="submit" value="submit">
  <pre>


  </pre>
</form>
</center>
</body>
</html>