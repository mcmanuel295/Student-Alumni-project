<?php  
    session_start();

    $matric = $_SESSION['matric'];

    $host ='localhost';
    $user ="root";
    $pwd = "";
    $dbname ='phpwork';

    // SETTING CONNECTION
    $conn = mysqli_connect($host,$user,$pwd,$dbname);
    if(!$conn){
        die("Unable to connect to database");
    }


    $sql = "SELECT matricNo,Name,Dept FROM students WHERE matricNo =$matric";

    $res = mysqli_query($conn,$sql);

    $row =mysqli_fetch_assoc($res) ;
    $name = $row['Name'];
    $dept = $row['Dept'];



?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../css/studAcc.css">

        <script src="../js/studAcc.js"></script>
        
        <title>Document</title>
    </head>

    <body id="studAcc">
        
        <!-- HEADER -->
        <div id="top">
            <div id="button">
                <img  src="../file/menu_icon.jpg" alt ="menu" width=30% height=45%/>
            </div>
            <div id="top_mid">
               <img src="../file/som.jpg" alt ="sch logo">
            </div>
        </div>

        <!-- MAIN BODY -->

        <!-- STUDENT DASHBOARD -->

        <section id="dash">
            <h2>WELCOME <sub>STUDENT DASHBOARD</sub></h2>
        </section >

        <div id="main">



        <!-- SUB-MENU -->
            <div id="sub_menu">
                
                <img src="../file/user3.png" width="50%" height="30%"/>
                <ul id="list">
                    <li><a id='homebtn' href="#home">Home</a></li>
                    <li><a id='viewbtn' href="#view">view items</a> </li>
                    <li><a id='requestbtn' href="request">request items</a></li>
                    <li><a  id='logbtn'id="logbut" href="">log out</a></li>
                </ul>
            </div>

                <!-- MAIN PAGE -->
            <div  id="page">



                <!-- HOME -->
                <section class="content" id="home">
                    
                    MATRIC NO : <?php echo $matric. "<br>" ?>
                    NAME :      <?php echo $name. "<br>" ?>
                    DEPARTMENT :    <?php echo $dept. "<br>" ?>
                    <!-- ITEMS :  <?php echo "<br>" ?> -->
                </section>



                <!-- VIEW ITEMS -->

                <section class="content" id="view"> 

                    <!-- ITEM LIST -->
                    <div id="list">

                        <?php

                            $sql = "SELECT * FROM items" ;
                            $res = mysqli_query($conn,$sql);
                            $rowcount = mysqli_num_rows($res);

                            if ($rowcount> 0) {
                                echo "S/n Qty Item <br>";

                            while($row = mysqli_fetch_assoc($res)){
                                $tab =
                                    "<tr> 
                                        <td>".$row['id'].".</td>
                                        <td>".$row['qty']."</td>
                                        <td>".$row['item']."</td> 
                                    </tr> <br><br>";
                                echo $tab;
                                }
                            }
                            else{
                                die('nothing was returned');
                            }

                            echo "<br>";
                        ?>
                    </div>

                </section>




                <!-- ITEM REQUEST -->

                <section class="content" id="request"> 

                    <div>

                        <form method="post" action=" <?php $_PHP_SELF ?>">
                            <input name ="select" list="item">
                            <datalist id="item">

                                <?php
                                    $sql = 'SELECT * FROM items';

                                    $res =mysqli_query($conn,$sql);

                                    $rowCount = mysqli_num_rows($res);

                                    if($rowCount >0){
                                        while($row = mysqli_fetch_assoc($res)){

                                            $tab ="<option value =".$row['item']."></option>";
                                            echo $tab;
                                        }
                                    }
                                    else{
                                        die('nothing was returned');
                                    }
                                ?>
        
                            </datalist>

                            <input type="submit">
                        </form>

                        <?php 
                            if(isset ($_POST['select']) ){

                                $item = $_POST['select'];
                                $sql = "INSERT INTO request(`matricNo`,`Name`,`item`) 
                                VALUES($matric,$name,$item)";

                                $res = mysqli_query($conn,$sql);

                            }
                        ?>
                    </div>

                </section>




                <!-- LOG OUT -->

                <section class="content" id="log">

                    <?php 
                        $scr = "<script style='margin:auto'>confirm('do you want to log out?')</script>" ;
                        // echo $scr;

                        // if($scr){
                        //     header('Location:./student.php');
                        // }
                    ?>
                </section>

            </div>

        </div>
    
    </body>

    <footer>
        <p>
            This is the university of whatever
        </p>
    </footer>
</html>



<?php



?>

