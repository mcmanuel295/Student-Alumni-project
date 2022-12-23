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


    $sql = "SELECT matric,Name,dept FROM alumni WHERE matric =$matric";

    $res = mysqli_query($conn,$sql);

    $row =mysqli_fetch_assoc($res) ;
    $name = $row['Name'];
    $dept = $row['dept'];



?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta httsection-equiv="X-UA-Comsectionatible" content="IE=edge">
        <meta name="viewsectionort" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../css/alumAcc.css">

        <script src="../js/alumAcc.js"></script>
        
        <title>Document</title>
    </head>

    <body id="alumAcc">

        <!-- HEADER -->
        <div id="top">
            <div id="button">
                <img  src="../file/menu_icon.jpg" alt ="menu" width=30% height=45%/>
            </div>
            <div id="top_mid">
               <img src="../file/som.jpg" alt ="sch logo">
            </div>
        </div>

        <!-- MAIN DODY -->

        <!-- ALUMNUS DASHBOARD -->
        
        <section id="dash">
            <sub> ALUMNUS DASHBOARD </sub><h2>WELCOME <?php echo $name ?></h2>
        </section >

        <div id="main">

            <!-- SUB-MENU -->
            <div id="sub_menu">
                
                <img src="../file/user2.png" width="50%" height="30%"/>
                <ul id="list">
                    <li><a id="homebtn" href="#home">Home</a></li>
                    <li><a id="viewbtn" href="#view">view items</a> </li>
                    <li><a id="donatebtn" href="#donate">donate items</a>
                    <li><a id="reqbtn" href="#request">view request</a>
                    <li><a id="logbtn" href="./alumni.php">log out</a></li>
                </ul>
            </div>

            <div id="page">

                <!-- HOME -->
                <section class='sec' id= "home">
                    <?php
                        $host ="localhost";
                        $user ="root";
                        $psw="";
                        $dbname ="phpwork";

                        $conn =mysqli_connect($host,$user,$psw,$dbname);

                        if(!$conn){
                            die("could not connect to database");
                        }
                

                    echo "HOME<br>" ;   
                    ?>
                    MATRIC NO : <?php echo $matric. "<br>" ?>
                    NAME :      <?php echo $name. "<br>" ?>
                    DEPARTMENT :    <?php echo $dept. "<br>" ?>
                    <!-- ITEMS :  <?php echo "<br>" ?> -->
                    
                </section>


                <!-- VIEW ITEMS -->
                <section class='sec' id="view">
                    
                    <?php
                        
                        echo "ITEMS AVAILABLE<br>";
                        $sql = "SELECT * FROM items" ;
                        $res = mysqli_query($conn,$sql);
                        $rowcount = mysqli_num_rows($res);

                        if ($rowcount > 0) {
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
                </section>


                <!-- DONATE ITEMS -->
                <section class='sec' id="donate">

                    <form method="post" action=" <?php $_PHP_SELF ?>">
                    <?PHP echo "DONATION LIST<br>" ?>    
                    <input list="don">
                        <datalist id="don">
                            
                            <option>mattress</option>
                            <option>refrigerator</option>
                            <option>pot</option>
                            <option>cupboard</option>
                            <option>table</option>
                            <option>chair</option>
                            <option>cooker</option>
                            <option>box</option>
                            <option>clothes</option>
                            <option>books</option>
                        </datalist>

                        <input type="submit">
                    </form>

                    <?php 
                        if(isset($_POST['sel'])){
                            $item = $_POST['sel'];
                            


                            $rowcount =mysqli_num_rows($res);
                            if($rowcount>0){
                                $sql = "INSERT INTO items (`item`) VALUES('$item)";
                            }
                            else{
                                $sql="INSERT INTO items(`item`,`qty`) VALUES('$item',1)";
                                $res = mysqli_query($conn,$sql);
                            }

                        }
                    ?>
                
                </section>


                <!-- VIEW REQUESTS TO APPROVE OR DECLINE -->
                <section class='sec' id="request">

                    <form>

                        <?php 

                            echo "VIEW REQUEST<br>";
                            $col = array() ;
                            $sql = "SELECT * FROM request";

                            $res = mysqli_query($conn,$sql);

                            $rowcount =mysqli_num_rows($res);

                            if($rowcount>0){
                                echo "A. D. Matric Name Item  <br>";

                                while($row = mysqli_fetch_assoc($res)){
                                    $matric =$row['matricNo'];
                                    
                                    $tab =
                                        "<tr> 
                                            <td><input type='radio' class ='A' name='" .$row['matricNo']."'></td>
                                            <tr><input type='radio' class='D' name ='".$row['matricNo'] ."'>
                                            <td>".$row['matricNo'].".</td>
                                            <td>".$row['Name']."</td>
                                            <td> '".$row['items']."'</td> 
                                        </tr><br>";
                                        $col["$matric"]=  'as';
                                        echo $tab;
                                }
                                echo "<input type='submit' >";
                            }
                            else{
                                echo "Aje nothing was returned";
                            }
                        ?>
                    </form>
                    <?php
                        if( isset($col)) {

                            echo "<br>";
                            $len =count($col);
                            // for ($i=0; $i < $len; $i++) { 
                            //     if($col['$matric']==='A'){
                            //         $sql ="INSERT INTO students WHERE matricNo =$matric" and "DELETE FROM request WHERE matricNo =$matric";

                            //         $res =mysqli_query($conn,$sql);
                            //     }
                            //     else{
                            //         $sql = "DELETE FROM request WHERE matricNo =$matric";
                            //         $res =mysqli_query($conn,$sql);
                            //     }
                            // }

                        }
                        else{
                            header('location:./alumAcc.php?#request');
                        }

                    ?>
                    

                </section>


                <!-- LOGOUT -->
                <section class='sec'id="log">
                    
                </section>


            </div>

        </div>
    
    </body>

    <footer>
        <p>
            This is the university of the learned. Lorem ipsum, dolor sit amet 
            consectetur adipisicing elit. Suscipit, porro? Reprehenderit itaque 
            deleniti architecto ipsa! Est fugiat quaerat eos eveniet, aliquam aut, 
            consectetur, tempore quam aliquid sunt eaque suscipit at.
        </p>
    </footer>
</html>



