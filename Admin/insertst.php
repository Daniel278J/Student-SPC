<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);

    if (isset($_POST['submit'])){
        $regdno=$_POST['regdno'];
        $name=$_POST['name'];
        $yoj=$_POST['yoj'];
        $regu=$_POST['regu'];
        $cgpa=$_POST['cgpa'];
        $query="insert into stddetails values('$regdno','$name','$yoj','$regu','$cgpa');";
        $result=mysqli_query($conn,$query);
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
        <br><br><br><br><br><br>
        <div class="login" align="center">
            <form method="post" action="#">
                <table>
                    <tr>
                        <td>Regd. No. :</td>
                        <td><input type="text" name="regdno" placeholder="XX331A12XX"></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name" placeholder="name"></td>
                    </tr>
                    <tr>
                        <td>Year of joining:</td>
                        <td><input type="number" name="yoj" ></td>
                    </tr>
                    <tr>
                        <td>Regulation:</td>
                        <td><input type="text" name="regu" ></td>
                    </tr>
                    <tr>
                        <td>Current CGPA:</td>
                        <td>
                            <input type="float" name="cgpa" ></td>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="submit">
            </form>
        </div>
    </body>
</html>