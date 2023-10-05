<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);

    session_start();
    // print_r($_SESSION);
    $year= $_SESSION['year'];
    $section= $_SESSION['section'];
    if ($section=='') {
        $section='A';
    }

    //Get specific student details
    if (isset($_POST['submit'])) {
        $regdno=$_POST['regdno'];
        $dquery="SELECT * from stddetails where `Regd. No.`= '$regdno' and `year`='$year' and `section`='$section';";
        echo $dquery;
        $result=mysqli_query($conn,$dquery);
        if(mysqli_num_rows($result)==1){
            header("Location: std.php?regdno=$regdno");
        }
        else {
            echo "This Student does not belong to your class or invalid Regd.No.";
            exit(); 
        }
    }
?>

<html>
    <head>
        <title>Incharge</title>
        <script>
            function student(){
                var x = document.getElementById("std");
                var y = document.getElementById("batch");
                x.style.display = "block";
                y.style.display = "none";
            }
            function batch(){
                var x = document.getElementById("std");
                var y = document.getElementById("batch");
                y.style.display = "block";
                x.style.display = "none";
            }
            function sortdis(){
                if (document.forms["myform"]["details"].value == 'all'){
                    var x = document.getElementById("sortsem");
                    var y = document.getElementById("sortall");
                    y.style.display = "block";
                    x.style.display = "none";
                }
                else if (document.forms["myform"]["details"].value == 'activity'){
                    var x = document.getElementById("sortsem");
                    var y = document.getElementById("sortall");
                    x.style.display = "none";
                    y.style.display = "none";
                } 
                else{
                    var x = document.getElementById("sortsem");
                    var y = document.getElementById("sortall");
                    x.style.display = "block";
                    y.style.display = "none";
                }
            }
        </script>
    </head>
    <body align='center'>
        
        <div>
        <div>
            <input type="button" value="Home" onClick="document.location.href='incharge.php'" />
            <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
        </div>
        <br><br>
            <input type="radio" id="student" name="operation" value="student" onClick="student()" required>
            <label for="student">Search for single student details</label><br>
            <input type="radio" id="class" name="operation" value="regulation" onClick="batch()" required>
            <label for="class">Search for details of a class</label><br>
            
            <div id="std" style="display: none;">
                <form action="#" method="post">
                    <input type="text" name="regdno">
                    <input type="submit" name="submit">
                </form>
            </div>
            <div id="batch" style="display: none;">
                <form action="#" method="post" name="myform"><br><br><br>
                    Select the type of data: <select name="details" id="details" onClick="sortdis()">
                        <option value="activity">Extra-circular or co-circular activites</option>
                        <option value="all">Overall</option>
                        <option value="sem1">sem1</option>
                        <option value="sem2">sem2</option>
                        <option value="sem3">sem3</option>
                        <option value="sem4">sem4</option>
                        <option value="sem5">sem5</option>
                        <option value="sem6">sem6</option>
                        <option value="sem7">sem7</option>
                        <option value="sem8">sem8</option>
                    </select><br><br>
                    <div id="sortsem" style="display: none;">
                    Sort by: <select name="sortbysem">
                        <option value="Regd. No.">Registered number</option>
                        <option value="CGPA">CGPA</option>
                        <option value="SGPA">SGPA</option>
                    </select>
                    </div>
                    <div id="sortall" style="display: none;">
                    Sort by: <select name="sortbyall">
                        <option value="Regd. No.">Registered number</option>
                        <option value="CGPA">CGPA</option>
                    </select>
                    </div>
                    <br>
                    <input type="submit" name="submit1">
                </form>
            </div>
        </div>
<?php
    // Get basic details of a class
    if (isset($_POST['submit1'])) {
        $details=$_POST['details'];
        $sort=$_POST['sortbyall'];
        if ($sort=='Regd. No.') {
            $order='ASC';
        }
        else {
            $order='DESC';
        }
        if ($details=='all') {
            echo "<h2>$year batch details</h2>";
            $query="select * from stddetails where Year='$year' and section='$section' ORDER BY `$sort` $order";
            $stddetails=mysqli_query($conn,$query);
            echo "<table border='1' cellspacing='0' align='center'>
                    <tr>
                        <td>Regd. No. </td>
                        <td>Name</td>
                        <td>Year</td>
                        <td>section</td>
                        <td>Regulation</td>
                        <td>cgpa</td>
                    </tr>";
            while ($row=mysqli_fetch_array($stddetails, MYSQLI_NUM)) {
                echo "<tr>";
                for ($i=0; $i < 6; $i++) { 
                    echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
            } 
            echo "</table>";
        }

        // Get the details of activities of a class
        elseif ($details=='activity') {
            echo "<h2>$details details, $year batch</h2>";
            $query="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='it_dept_details' AND TABLE_NAME='activity';";
            $columns=mysqli_query($conn,$query);
            $subject = array();
            for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
                $row=mysqli_fetch_array($columns)['COLUMN_NAME'];
                array_push($subject,$row);
            }
            $dquery='stddetails.`Regd. No.`, `stddetails`.`Name`, ';
            for ($i=1; $i < count($subject); $i++) { 
                $dquery=$dquery . "$subject[$i], ";
            }
            $dquery="SELECT " . rtrim($dquery ,", "). " from activity INNER JOIN stddetails ON `activity`.`Regd. No.`=`stddetails`.`Regd. No.` WHERE `stddetails`.`Year`='$year' and `stddetails`.`section`='$section';";
            $stddetails=mysqli_query($conn,$dquery);
            echo "<table border='1' cellspacing='0' align='center'>
                    <tr>
                        <td>Regd. No. </td>
                        <td>Name</td>
                        <td>ExtraCurricular Activity</td>
                        <td>CoCurricular activity</td>
                        <td>Date of Participation</td>
                        <td>certification</td>
                    </tr>";
            while ($row=mysqli_fetch_array($stddetails, MYSQLI_NUM)) {
                echo "<tr>";
                for ($i=0; $i < 6; $i++) { 
                    echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
            } 
            echo "</table>";
        } 

        // Get specific sem details of a class
        else {
            $sort=$_POST['sortbysem'];
            echo "<h2>$details, $year batch</h2>";
            if ($sort=='Regd. No.') {
                $order='ASC';
            }
            else {
                $order='DESC';
            }
            $reg=mysqli_query($conn,"SELECT Regulation from stddetails WHERE `year` = '$year';");
            $reg=mysqli_fetch_array($reg, MYSQLI_NUM);
            $reg=$reg[0];
            $table=$reg . $details;
            $query="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='it_dept_details' AND TABLE_NAME='$table';";
            $columns=mysqli_query($conn,$query);
            $subject = array();
            for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
                $row=mysqli_fetch_array($columns)['COLUMN_NAME'];
                array_push($subject,$row);
            }
            $dquery='stddetails.`Regd. No.`, `stddetails`.`Name`, ';
            for ($i=1; $i < count($subject)-1; $i++) { 
                $dquery=$dquery . "`$subject[$i]`, ";
            }
            $dquery="SELECT " . rtrim($dquery ,", "). ", $table.cgpa" . " from $table INNER JOIN stddetails ON `$table`.`Regd. No.`=`stddetails`.`Regd. No.` WHERE `stddetails`.`Year`='$year' and `stddetails`.`section`='$section' ORDER BY `$table`.`$sort` $order;";
            $stddetails=mysqli_query($conn,$dquery);
            echo "<table border='1' cellspacing='0' align='center'>
                    <tr>
                        <td>Regd. No. </td>
                        <td>Name</td>";
            for ($i=1; $i < count($subject); $i++) { 
                echo "<td>$subject[$i]</td>";
            }
            echo "</tr>";
            while ($row=mysqli_fetch_array($stddetails, MYSQLI_NUM)) {
                echo "<tr>";
                for ($i=0; $i <= count($subject); $i++) { 
                    echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
            } 
            echo "</table>";
        }
    }
?>
    </body>
</html>