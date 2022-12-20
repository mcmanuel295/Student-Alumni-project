 <!-- <?php 
    $name = $_COOKIE['name'];

    echo $name;
 ?> -->


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
            <h2>STUDENT DASHBOARD</h2>
        </section >

        <div id="main">
            <div id="sub_menu">
                
                <img src="../file/me.jpg" width="50%" height="30%"/>
                <ul id="list">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#view">view items</a> </li>
                    <li><a href="">request donation</a></li>
                    <li><a id="logbut" href="">log out</a></li>
                </ul>
            </div>

            <div  id="page">

                <!-- HOME -->
                <section class="content" id="home">
                    <?php
                        $host ="localhost";
                        $user ="root";
                        $psw="";
                        $dbname ="phpwork";

                        $conn =mysqli_connect($host,$user,$psw,$dbname);

                        if(!$conn){
                            die("could not connect to database");
                        }
                    

                        
                    ?>
                    MATRIC NO : <?php echo "<br>" ?>
                    NAME :      <?php echo "<br>" ?>
                    DEPARTMENT :    <?php echo "<br>" ?>
                    ITEMS :  <?php echo "<br>" ?>
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
                                echo "id items quantity <br>";

                                while($row = mysqli_fetch_assoc($res)){
                                    $tab =
                                        "<tr> 
                                            <td>".$row['id']."</td>
                                            <td>".$row['item']."</td>
                                            <td>".$row['qty']."</td> 
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

                <section class="content" id=""> 

                    <div id="request">

                        <form method="post" action=" <?php $_PHP_SELF ?>">
                            <input name ="sel" list="item">
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
                            if(isset($_POST['sel'])){
                            
                                $sql = "INSERT INTO request(`matricNo`,`Name`,`item`) VALUES('','', $_POST['sel'])";

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

