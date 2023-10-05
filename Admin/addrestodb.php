<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);
    if(isset($_POST['submit'])){
        $table=$_POST['regulation'].$_POST['details'];
        $query="SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='$table';";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            header("location: insert.php?table=$table");
            // print_r($_POST);
        }
        else {
            echo $table."not found";
            exit();
        }
    }
?>

<html>
    <head>
        <title>Admin</title>
    </head>
    <body>
        <div>
            <input type="button" value="Home" onClick="document.location.href='admin.html'" />
            <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
        </div>
        <form method="post" action="#">
            <table align="center">
                <tr>
                    <td>Regulation:</td>
                    <td><input type="text" name="regulation" placeholder="A1" required></td>
                </tr>
                <tr>
                    <td>Year of Joining:</td>
                    <td><input type="number" name="year" placeholder="2019" ></td>
                </tr>
                <tr>
                    <td>Section (if any else 'A'):</td>
                    <td><input type="text" name="section" placeholder="A"></td>
                </tr>
                <tr>
                    <td>Type of Data to be inserted:</td>
                    <td><select name="details" id="details" required>
                        <option value="sem1">sem1</option>
                        <option value="sem2">sem2</option>
                        <option value="sem3">sem3</option>
                        <option value="sem4">sem4</option>
                        <option value="sem5">sem5</option>
                        <option value="sem6">sem6</option>
                        <option value="sem7">sem7</option>
                        <option value="sem8">sem8</option>
                        <option value="activites">Extra-circular or co-circular activites</option>
                    </select></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="submit"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>