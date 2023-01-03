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
    else{

        $sql = "SELECT matricNo,Name,Dept FROM students WHERE matricNo =$matric";
        $res = mysqli_query($conn,$sql);
        
        $row =mysqli_fetch_assoc($res) ;
        $name = $row['Name'];
        $dept = $row['Dept'];

    }     
       

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
                <h2>UNIVERSITY OF THE LEARNED</h2>
            </div>
        </div>

        <!-- MAIN BODY -->

        <!-- STUDENT DASHBOARD -->
        <section id="dash">
            <sub> STUDENT DASHBOARD </sub><h2>WELCOME <?php echo $name ?></h2>
        </section >

        <div id="main">

            <!-- SUB-MENU -->
            <div id="sub_menu">
                
                <img src="../file/user3.png" width="50%" height="30%"/>
                <ul id="list">
                    <li><a  id='homebtn' href="#home">Home</a></li>
                    <li><a  id='viewbtn' href="#view">view items</a> </li>
                    <li><a  id='reqbtn' href="#request">request items</a></li>
                    <li><a  id='logbtn'id="logbut" href="./student.php">log out</a></li>
                </ul>
            </div>
            

                <!-- MAIN PAGE -->
            <div  id="page">

                <!-- HOME -->
                <section class='sec' id="home">
                    <?php
                        echo "HOME<br>" ;   
                    ?>
                    
                    MATRIC NO : <?php echo $matric. "<br> <br>" ?>
                    NAME :      <?php echo $name. "<br><br>" ?>
                    DEPARTMENT :    <?php echo $dept. "<br><br>" ?>
                    <!-- ITEMS :  <?php echo "<br>" ?> -->
                </section>



                <!-- VIEW ITEMS -->
                <section class='sec' id="view"> 

                    <!-- ITEM LIST -->
                    <div id="list">

                        <?php

                            echo "ITEMS AVAILABLE<br><br>" ;
                            $sql = "SELECT * FROM items" ;
                            $res = mysqli_query($conn,$sql);
                            $rowcount = mysqli_num_rows($res);

                            if ($rowcount> 0) {
                                echo "s/n Qty Item <br>";

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
                <section class='sec' id="request"> 

                    <?php 
                        echo "<h2>REQUEST</h2>" ; 
                    ?>
                    <div>
                            <!-- CREATING DATALIST -->
                        <form method="post" action=" <?php $_PHP_SELF ?>">
                            <input list="store" name ="select">
                            <datalist id="store">

                                <?php
                                    $sql = 'SELECT * FROM items WHERE qty >0';

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

                            // ADDING REQUEST TO DATABASE
                            if(isset ($_POST['select']) ){

                                $item = $_POST['select'];
                                $sql = "SELECT * FROM request WHERE matricNo = $matric";
                                $res = mysqli_query($conn,$sql);
                                $rowCount =mysqli_num_rows($res);

                                if($rowCount>0 ){
                                    echo "you have requested before Not allowed now";
                                }
                                else{

                                    $sql= "INSERT INTO request(matricNo,Name,items) VALUES('$matric', $name,$item)";
                                    $res = mysqli_query($conn,$sql);
                                }


                            }
                        ?>
                    </div>

                </section>




                <!-- LOG OUT -->

                <section class='sec' id="log">

                    <?php 
                        
                    ?>
                </section>

            </div>

        </div>
    
    </body>

    <footer>
        <p>
            This is the university of whatever. Lorem ipsum
             dolor, sit amet consectetur adipisicing elit. 
             Nesciunt voluptates quisquam nulla quia voluptas. 
             Tenetur deserunt voluptatem numquam aliquid aperiam
              laborum voluptate incidunt distinctio, aut temporibus
               est voluptatum nesciunt! Consectetur?
        </p>
    </footer>
</html>



<?php



?>

