<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);

    if (isset($_POST['submit'])){
        $regdno=$_POST['regdno'];
        $name=$_POST['name'];
        $ec=$_POST['ec'];
        $cc=$_POST['cc'];
        $date=$_POST['date'];
        $certify=$_POST['certify'];
        $query="insert into activity values('$regdno','$ec','$cc','$date','$certify');";
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
                        <td>Extra-Curricular Activity details:</td>
                        <td><input type="text" name="ec" ></td>
                    </tr>
                    <tr>
                        <td>Co-Curricular Activity details:</td>
                        <td><input type="text" name="cc" ></td>
                    </tr>
                    <tr>
                        <td>Date of participation:</td>
                        <td><input type="date" name="date" ></td>
                    </tr>
                    <tr>
                        <td>Certification:</td>
                        <td>
                            <input type="text" name="certify" ></td>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="submit">
            </form>
        </div>
    </body>
</html>