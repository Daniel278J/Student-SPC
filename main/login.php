<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);
    // mysql_select_db();
    session_start();

    if (!empty($_SESSION) && $_POST['role']==$_SESSION['active']) {
        if ($_SESSION["active"]=='HOD') {
            header("Location: ../hod/hod1.php");        
        } elseif ($_SESSION["active"]=='Admin') {
            header("location: ../admin/admin.html");
        } elseif ($_SESSION["active"]=='incharge') {
            header("location: ../incharge/incharge.php");
        }
    }
    if (isset($_POST['submit'])){
        $uname=$_POST['uname'];
        $password=md5($_POST['password']);
        $role=$_POST['role'];
        $query="select * from login_cred where uname='$uname' and password='$password' and type='$role'";
        echo $query;
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            if ($password=='17d84f171d54c301fabae1391a125c4e' or $password=='' or $password=='66a93aa4ab79244449a664890e1efa55'){
                header("location: changepass.php");
                exit();
            }
            else {
                $_SESSION = array();
                $_SESSION['active']=$role;
                if ($role=='HOD'){
                    header("Location: ../hod/hod1.php");
                    exit();
                }
                elseif ($role=='Admin'){
                    header("Location: ../admin/admin.html");
                    exit();
                }
                elseif ($role=='incharge') {
                    $_SESSION['section']=$uname[1];
                    $year=$uname[0];
                    $query="select year from relate where batch='$year'";
                    $result=mysqli_query($conn,$query);
                    $result=mysqli_fetch_array($result, MYSQLI_NUM);
                    $year=$result[0];
                    $_SESSION['year']=$year;
                    header("Location: ../incharge/incharge.php");
                    exit();
                }
            }   
        }
        else{
            echo "You entered wrong credentials";
            echo $role;
            exit();
        }
    }
?>


<html>
    <head>
        
    </head>
    <body>
        <style type="text/CSS">
                body{
                    background-image: url("background.jpg");
                    height: 100%;
                    /* Center and scale the image nicely */
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                    font-size: larger;
                    color: white;
                }
            </style>
        <br><br><br><br><br><br>
        <div class="login" align="center">
            <form method="post" action="#">
                <input type="hidden" name="role" value="<?php echo $_POST['role'] ;?>">
                <p>Username</p> 
                <input type="text" name="uname" placeholder="Username" required><br>
                <p>Password</p>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <input type="submit" name="submit" value="Login"/>
            </form>
        </div>
    </body>
</html>