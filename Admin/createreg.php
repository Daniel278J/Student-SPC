<?php
        $host="localhost";
        $user="root";
        $password="";
        $db='it_dept_details';
        $conn=mysqli_connect($host,$user,$password,$db);
    if (isset($_POST['submit'])){
        // print_r($_POST);
        $sname=$_POST['sname'];
        $num=115;
        for ($i=0; $i < 8; $i++) { 
            $table=$sname.'sem'. $i+1;
            $subs = '';
            for ($j=0; $j < 10; $j++) { 
                $sn=(chr($num+$i)).$j;
                if ($_POST[$sn]=='') {
                    break;
                }
                $subs=$subs . "`" . trim($_POST[$sn]," ") . "`" . " VARCHAR(2) NOT NULL,";
            }
            $query="create table $table (`Regd. No.` VARCHAR(10) PRIMARY KEY, ". $subs . "SGPA float);";
            mysqli_query($conn,$query);
        }
    }
?>
<html>
    <body>
    <div>
    <input type="button" value="Home" onClick="document.location.href='admin.html'" />
        <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
    </div>
        <form action="#" method="post">
            Enter the Regulation name: <input type="text" name="sname" required><br>
            <?php
                $num=114;
                for ($i=1; $i < 9; $i++) { 
                    echo "<h1>Semester $i</h1>";
                    $hello=(chr($num+$i)).'0';
                    echo "<input type='text' name=$hello  required>";
                    echo "<br>";
                    for ($j=1; $j < 10; $j++) {
                        $sn=(chr($num+$i)).$j;
                        echo "<input type='text' name= $sn >";
                        echo "<br>";
                    }
                } 
            ?>
            <input type="submit" name="submit" value="submit"/>
        </form>
    </body>
</html>