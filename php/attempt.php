
<html>
    <body>
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
                echo "successful <br>";

                if(isset($_COOKIE['age'])){

                    echo "cookie is set";
                    echo $_COOKIE['age'];
                }
                else{
                    echo "who are you?";
                }
            }

        ?>
    