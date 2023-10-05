<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);
    $table=$_GET['table'];
    session_start();
    $regdno=$_SESSION["regdno"];
    $query="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='it_dept_details' AND TABLE_NAME='$table';";
    $columns=mysqli_query($conn,$query);
    $num=mysqli_num_rows($columns);
    $subject = array();
    for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
        $row=mysqli_fetch_array($columns)['COLUMN_NAME'];
        array_push($subject,$row);
    }
    if ($table=='activity') {
        $date=$_SESSION["date"];
        $getq="SELECT * from $table where `Regd. No.` = '$regdno' and `date`= '$date';";
        $values=mysqli_query($conn,$getq);
        $v=mysqli_fetch_array($values, MYSQLI_NUM);
    }
    else {
        $getq="SELECT * from $table where `Regd. No.` = '$regdno';";
        $values=mysqli_query($conn,$getq);
        $v=mysqli_fetch_array($values, MYSQLI_NUM);
    }
    if (isset($_POST['submit'])) {
        if ($table=='activity') {
            mysqli_query($conn,"DELETE from $table where `Regd. No.` = '$regdno' and `date`= '$date';");
        }
        else {
            mysqli_query($conn,"DELETE from $table where `Regd. No.` = '$regdno';");
        }
        $setq="";
        for ($i=0; $i < count($v); $i++) { 
            $val=$_POST['s'. $i];
            $setq= $setq . "'$val'" . ", " ;
        }
        $setq="insert into $table values (" . rtrim($setq, ", ") . ");";
        if(mysqli_query($conn,$setq)){
            header("location: edit.php");
        }
    }
?>

<html>
    <head>

    </head>
    <body>
    <div>
    <input type="button" value="Home" onClick="document.location.href='admin.html'" />
        <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
    </div>
    <form action="#" method="post">
            <table>
                <?php
                    echo "<tr><td></td><td>Current Data</td><td>New values</td>";
                    for ($i=0; $i < $num; $i++) { 
                        echo "<tr>";
                        echo "<td>".$subject[$i]."</td>";
                        $h='s'.$i;
                        echo "<td>"."<input type='text' value='$v[$i]' readonly>"."</td>"; 
                        echo "<td>"."<input type='text' name='$h'  value='$v[$i]' "."</td>"; 
                        echo "</tr>";
                    }
                ?>
                </table>
                <input type="submit" name="submit" value="submit"/>
            </form>
    </body>
</html>