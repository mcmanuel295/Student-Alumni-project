<?php 
 session_start();

 if(isset($_SESSION['matric'])){
    echo "the matric no has been recorded";
 }
 else{
    echo "Aje! nothing was set oo<br><br>";
 }
?>
<html>
    <body>
        <a href="./student.php">back to student login</a>
        <?php

            $host = "localhost" ;
            $user = "root" ;
            $pass = "";
            $name ="phpwork" ;


            // connect to database
            $conn =mysqli_connect($host,$user,$pass,$name);

            if(!$conn){  
                die('invalid connection');
            }
            else{
                echo "<br><br>successful <br>";

                $person ='170805008';
                

                $sql = "SELECT matricNo FROM students WHERE EXIST (SELECT  matricNo FROM students WHERE matricNo =$person";
                $res = mysqli_query($conn,$sql);

                
                
            }

        ?>
    