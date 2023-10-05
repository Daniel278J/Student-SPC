<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);

    $query='select type, uname from login_cred';
    $cred_table=mysqli_query($conn,$query);
    if (isset($_POST['submit'])) {
        $role=$_POST['type'];
        $uname=$_POST['uname']; 
        $pwd=md5($role);
        $query="UPDATE login_cred set `password` = '$pwd' where `type`= '$role' and `uname`='$uname' ";
        mysqli_query($conn,$query);
    }
?>

<html>
    <head>

    </head>
    <body>
        <table>
            <tr>
                <th>Role</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <?php
                for ($i=0; $i < mysqli_num_rows($cred_table); $i++) { 
                    $row=mysqli_fetch_array($cred_table, MYSQLI_NUM);
                    echo "<tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>*****</td>
                        </tr>";
                }
            ?>
        </table>
        <form action="#" method="post">
            <input type="text" name="type">
            <input type="text" name="uname">
            <input type="submit" name="submit" value="reset">
        </form>
    </body>
</html>