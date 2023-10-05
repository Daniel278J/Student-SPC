<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='it_dept_details';
    $conn=mysqli_connect($host,$user,$password,$db);
    // mysql_select_db();
    $table=$_GET['table'];
    $query="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='it_dept_details' AND TABLE_NAME='$table';";
    $columns=mysqli_query($conn,$query);
    // $column=mysqli_fetch_array($columns);
    $subject = array();
    for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
        $row=mysqli_fetch_array($columns)['COLUMN_NAME'];
        array_push($subject,$row);
    }
    $sub = array();
    for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
        $temp = explode(' ',trim($subject[$i]));
        array_push($sub,$temp[0]);
    }
    if (isset($_POST['submit'])){
        $value='';
        // print_r($_POST);
        for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
            $value=$value."'". $_POST[rtrim($sub[$i],".")] ."'".",";
        }
        $query="insert into $table values (". rtrim($value, ", ") . ");";
        echo mysqli_query($conn,$query);
        exit();
    }    
?>

<html>
    <head>
        <script>
            var hello=element.getAttribute("hi");
            alert(hello);
        </script>
    </head>
    <body>
    <div>
    <input type="button" value="Home" onClick="document.location.href='admin.html'" />
        <input type="button" value="Logout" onClick="document.location.href='../logout.php'" />
    </div>
        <form name="myform" action="#"  method="post">
            <table>
                <?php
                for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
                    echo "<tr>";
                    echo "<td>".$subject[$i]."</td>";
                    $myvalue = $subject[$i];
                    $arr = explode(' ',trim($myvalue));
                    // print_r($arr);
                    $arr[0]= rtrim($arr[0], ". ");
                    echo "<td>"."<input type='text' name= $arr[0] id='hi'>"."</td>"; 
                    echo "</tr>";
                }
                ?>
            </table>
            <input type="submit" name="submit" value="submit"/>
        </form>
    </body>
</html>