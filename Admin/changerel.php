<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);

    $query="SELECT * from `relate`";
    $rel=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($rel, MYSQLI_NUM);
    if (isset($_POST['submit'])) {
        $fi=$_POST['a1'];
        $se=$_POST['a2'];
        $th=$_POST['a3'];
        $fo=$_POST['a4'];
        $tquery ="TRUNCATE TABLE `relate`";
        mysqli_query($conn,$tquery);
        mysqli_query($conn,"insert into relate values(1,$fi)");
        mysqli_query($conn,"insert into relate values(2,$se)");
        mysqli_query($conn,"insert into relate values(3,$th)");
        mysqli_query($conn,"insert into relate values(4,$fo)");
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
                <tr>
                    <th>Current year</th>
                    <th>Batch (Please enter the year of joining)</th>
                </tr>
                <tr>
                    <td>First year</td>
                    <td><input type="number" name="a1" required></td>
                </tr>
                <tr>
                    <td>Second year</td>
                    <td><input type="number" name="a2" required></td>
                </tr>
                <tr>
                    <td>Third year</td>
                    <td><input type="number" name="a3" required></td>
                </tr>
                <tr>
                    <td>Forth year</td>
                    <td><input type="number" name="a4" required></td>
                </tr>
            </table>
            <input type="submit" name="submit">
        </form> 
    </body>
</html>