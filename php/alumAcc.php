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
                <h2>UNIVERSITY OF THE LEARNED</h2>
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
                    echo "HOME<br>" ;   
                    ?>

                    MATRIC NO : <?php echo $matric. "<br><br>" ?>
                    NAME :      <?php echo $name. "<br><br>" ?>
                    DEPARTMENT :    <?php echo $dept. "<br>" ?>
                    <!-- ITEMS :  <?php echo "<br>" ?> -->
                    
                </section>


                <!-- VIEW ITEMS -->
                <section class='sec' id="view">
                    
                    <?php
                        
                        echo "ITEMS AVAILABLE<br><br>";
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
                                    </tr> <br>";
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
                    
                    <?php 
                        echo "<h2>DONATION</h2>" ; 
                    ?>

                    <form method="post" action=" <?php $_PHP_SELF ?>">
                    <?PHP echo "DONATION LIST<br>" ?>    
                    <input name="sel" list="don">
                        <datalist id="don">
                            
                            <option>mattress</option>
                            <option>Refrigerator</option>
                            <option>pot</option>
                            <option>cupboard</option>
                            <option>table</option>
                            <option>chair</option>
                            <option>cooker</option>
                            <option>box</option>
                            <option>clothes</option>
                            <option>books</option>
                            <option>others</option>
                        </datalist>

                        <input type="submit">
                    </form>

                    <?php 
                        if(isset($_POST['sel'])){
                            $item = $_POST['sel'];
                            


                            $sql = "SELECT * FROM items WHERE item = '$item'";
                            $res = mysqli_query($conn,$sql);
                        
                            $rowcount = mysqli_num_rows($res);

                            if($rowcount>0){

                                $qty = "SELECT qty FROM items WHERE item = '$item'";
                                $res = mysqli_query($conn,$qty);
                                
                                $row =mysqli_fetch_assoc($res);
                                $qty = $row['qty']+1;
                                
                                
                                $sql = "UPDATE items SET qty= '$qty' WHERE item = '$item'";
                                $res = mysqli_query($conn,$sql);
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

                    <?php 
                        echo "<h2>REQUEST FROM STUDENTS</h2>" ; 
                    ?>

                    <form>

                        <?php 

                            echo "VIEW REQUEST<br>";
                            $str = array() ;

                            $sql = "SELECT * FROM request";

                            $res = mysqli_query($conn,$sql);

                            $rowcount =mysqli_num_rows($res);

                            if($rowcount>0){
                                echo "A. D. Matric Name Item  <br>";


                                while($row = mysqli_fetch_assoc($res)){
                                    $matric =$row['matricNo'];
                                    $name = $row['Name'];
                                    
                                    
                                    $tab =
                                        "<tr> 
                                            <td><input type='radio' value='A' class ='A' name='" .$matric ."'></td>
                                            <td><input type='radio' value='B' class='D' name ='".$matric ."'></td>
                                            <td>".$row['matricNo'].".</td>
                                            <td>".$row['Name']."</td>

                                        </tr>"
                                        .$str['age']= $_POST[$matric]."
                                        
                                        
                                    
                                        
                                        <br>";
                                                                           

                                        // $str['$matric']= $_POST['matric']."
                                        
                                        echo $tab;
                                }
                               echo "<input name='sub' type='submit'>";
                            }
                            else{
                                echo "Nothing was returned";
                            }
                        ?>
                    </form>
                    <?php
                        if( isset($_POST['sub'])) {
                            echo "This one is working oo";
                            $get =$_POST[$matric]   ;
                            echo "<br>";
                            $len =count($str);
                            echo $len. "<br>" ;


                            foreach ($str as $key => $value) {
                                echo " key : ".$key. " and value :" ;
                            }







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
                        // else{
                            //header('location:./alumAcc.php?#request');
                        // }

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



