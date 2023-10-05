<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);

    $regdno=$_GET['regdno'];

    // Get Student basic details
    $query="select * from stddetails where `Regd. No.`='$regdno'";
    $stddetails=mysqli_query($conn,$query);
    echo "<h2>Student details</h2>";
    echo "<table border='1' cellspacing='0'>
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

    // Get All Sem details(marks)
    $reg=mysqli_query($conn,"SELECT Regulation from stddetails WHERE `Regd. No.` = '$regdno';");
    $reg=mysqli_fetch_array($reg, MYSQLI_NUM);
    $reg=$reg[0];
    for ($j=1; $j < 9; $j++) { 
        echo "<h2>Sem $j</h2>";
        $table=$reg . "sem" . $j;
        $query="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='it_dept_details' AND TABLE_NAME='$table';";
        $columns=mysqli_query($conn,$query);
        $subject = array();
        for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
            $row=mysqli_fetch_array($columns)['COLUMN_NAME'];
            array_push($subject,$row);
        }
        $dquery="SELECT * from $table WHERE `Regd. No.`='$regdno';";
        $stddetails=mysqli_query($conn,$dquery);
        // $dquery='stddetails.`Regd. No.`, ';
        // for ($i=1; $i < count($subject)-1; $i++) { 
        //     $dquery=$dquery . "`$subject[$i]`, ";
        // }
        // $dquery="SELECT " . rtrim($dquery ,", "). ", $table.cgpa" . " from $table INNER JOIN stddetails ON `$table`.`Regd. No.`=`stddetails`.`Regd. No.` WHERE `stddetails`.`Regd. No.`='$regdno';";
        // $stddetails=mysqli_query($conn,$dquery);

        echo "<table border='1' cellspacing='0'>
                <tr>
                    <td>Regd. No. </td>";
        for ($i=1; $i < count($subject); $i++) { 
            echo "<td>$subject[$i]</td>";
        }
        echo "</tr>";
        while ($row=mysqli_fetch_array($stddetails, MYSQLI_NUM)) {
            echo "<tr>";
            for ($i=0; $i < count($subject); $i++) { 
                echo "<td>" . $row[$i] . "</td>";
            }
            echo "</tr>";
        } 
        echo "</table>";
    }

    //Get student activity details
    echo "<h2>Student Activities details</h2>";
    $query="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='it_dept_details' AND TABLE_NAME='activity';";
    $columns=mysqli_query($conn,$query);
    $subject = array();
    for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
        $row=mysqli_fetch_array($columns)['COLUMN_NAME'];
        array_push($subject,$row);
    }
    $dquery="select * from activity where `Regd. No.`='$regdno'";
    $stddetails=mysqli_query($conn,$dquery);
    echo "<table border='1' cellspacing='0'>
            <tr>
                <td>Regd. No. </td>
                <td>ExtraCurricular Activity</td>
                <td>CoCurricular activity</td>
                <td>Date of Participation</td>
                <td>certification</td>
            </tr>";
    
    while ($row=mysqli_fetch_array($stddetails, MYSQLI_NUM)) {
        echo "<tr>";
        for ($i=0; $i < 5; $i++) { 
            echo "<td>" . $row[$i] . "</td>";
        }
        echo "</tr>";
    } 
    echo "</table>";
?>