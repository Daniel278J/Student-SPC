<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);

    //Delete an activity from the database
    if (isset($_POST['submit'])) {
        $regdno=$_POST["regdno"];
        $details=$_POST["details"];
        $date=$_POST["date"];
        $query="DELETE from activity where `Regd. No.`='$regdno' and `date`='$date'";
        mysqli_query($conn,$query);
        exit();
    }

    //Delete a student record of particular sem
    elseif (isset($_POST["submit1"])) {
        print_r($_POST);
        $regdno=$_POST["regdno"];
        $details=$_POST["details"];
        $reg=mysqli_query($conn,"SELECT Regulation from stddetails WHERE `Regd. No.` = '$regdno';");
        $reg=mysqli_fetch_array($reg, MYSQLI_NUM);
        $reg=$reg[0];
        $table=$reg . $details;
        $query="DELETE from `$table` where `Regd. No.`='$regdno'";
        mysqli_query($conn,$query);
        exit();
    }

    //Delete a regulation
    elseif (isset($_POST["submit2"])) {
        $reg=$_POST["reg"];
        for ($i=1; $i < 9; $i++) { 
            $table=$reg . 'sem' . $i;
            $query="DROP table `$table`";
            echo $query;
            mysqli_query($conn,$query);
        }
    }
?>

<html>
    <head>
        <script>
            function student() {
                std.style.display = "block";
                reg.style.display = "none";
            }
            function regulation() {
                reg.style.display = "block";
                std.style.display = "none";
            }
            function datedis(){
                var name = document.forms["stdform"]["details"].value;
                if (name == "activites") {
                    date.style.display = "block";
                    submit1.style.display = "none";
                }else {
                    date.style.display = "none";
                    submit1.style.display = "block";
                }
            }
        </script>
    </head>
    <body>
        <div>
            <input type="button" value="Home" onClick="document.location.href='admin.html'" />
            <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
        </div>
        <input type="radio" id="student" name="operation" value="student" onclick="student()" required>
        <label for="student">Delete a particular student record</label><br>
        <input type="radio" id="regulation" name="operation" value="regulation" onclick="regulation()" required>
        <label for="regulation">Delete a regulation</label><br>
        <div id="std" style="display: none;">
        <form action="#" method="post" name="stdform">
            Regd. No: <input type="text" name="regdno">
            Select Sem: <select name="details" id="details" onchange="datedis()">
                <option value="sem1">sem1</option>
                <option value="sem2">sem2</option>
                <option value="sem3">sem3</option>
                <option value="sem4">sem4</option>
                <option value="sem5">sem5</option>
                <option value="sem6">sem6</option>
                <option value="sem7">sem7</option>
                <option value="sem8">sem8</option>
                <option value="activites">Extra-circular or co-circular activites</option>
            </select><br>
            <div id="date" style="display: none;">
                <input type="date" name="date"><br>
                <input type="submit" name="submit" id="submit" value="submit">
            </div>
            <input type="submit" name="submit1" id="submit1" value="submit1" style="display: block;">
        </div>
        </form>
        
        <div id="reg" style="display: none;">
            <form action="#" method="post">
            <input type="text" name="reg"><br>
            <input type="submit" name="submit2" value="submit2" id="submit">
            </form>
        </div>
    </body>
</html>