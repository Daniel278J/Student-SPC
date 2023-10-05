<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);
    session_start();

    if (isset($_POST['submit1'])) {
        $regdno=$_POST['regdno'];
        $_SESSION["regdno"]=$regdno;
        header("Location: editnext.php?table=stddetails");
    }
    elseif (isset($_POST['submit2'])) {
        $regdno=$_POST['regdno'];
        $_SESSION["regdno"]=$regdno;
        $reg=mysqli_query($conn,"SELECT Regulation from stddetails WHERE `Regd. No.` = '$regdno';");
        $reg=mysqli_fetch_array($reg, MYSQLI_NUM);
        $reg=$reg[0];
        $details=$_POST["details"];
        $table=$reg . $details;
        header("Location: editnext.php?table=$table");
    }
    elseif (isset($_POST['submit'])) {
        $regdno=$_POST['regdno'];
        $_SESSION["regdno"]=$regdno;
        $_SESSION["date"]=$_POST['date'];
        header("Location: editnext.php?table=activity");
    }
?>
<html>
    <head>
        <title>Admin</title>
        <script>
            function personal() {
                std.style.display = "block";
                details.style.display = "none";
                date.style.display = "none";
                submit1.style.display = "block";
                submit2.style.display = "none";
            }
            function academic() {
                std.style.display = "block";
                details.style.display = "block";
                date.style.display = "none";
                submit1.style.display = "none";
                submit2.style.display = "block";
            }
            function activity(){
                std.style.display = "block";
                details.style.display = "none";
                date.style.display = "block";
                submit1.style.display = "none";
                submit2.style.display = "none";
            }
        </script>
    </head>
    <body>
    <div>
    <input type="button" value="Home" onClick="document.location.href='admin.html'" />
        <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
    </div>
        <input type="radio" id="personal" name="operation" value="student" onclick="personal()" required>
        <label for="personal">Edit student personal details</label><br>
        <input type="radio" id="academic" name="operation" value="regulation" onclick="academic()" required>
        <label for="academic">Edit Student Academic details</label><br>
        <input type="radio" id="activity" name="operation" value="regulation" onclick="activity()" required>
        <label for="activity">Edit Extra and Co Curricular activity details</label><br>
        <div id="std" style="display: none;">
        <form action="#" method="post" name="stdform">
            Regd. No.: <input type="text" name="regdno">
             <select name="details" id="details" style="display: none;">
                <option value="sem1">sem1</option>
                <option value="sem2">sem2</option>
                <option value="sem3">sem3</option>
                <option value="sem4">sem4</option>
                <option value="sem5">sem5</option>
                <option value="sem6">sem6</option>
                <option value="sem7">sem7</option>
                <option value="sem8">sem8</option>
            </select><br>
            <div id="date" style="display: none;">
                Date: <input type="date" name="date"><br>
                <input type="submit" name="submit" id="submit" align="center" value="submit">
            </div>
            <input type="submit" name="submit1" id="submit1" value="submit1" style="display: block;">
            <input type="submit" name="submit2" id="submit2" value="submit2" style="display: none;">
        </form>
        </div>
    </body>
</html>