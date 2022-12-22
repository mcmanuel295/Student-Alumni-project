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
            <h2>ALUMNUS DASHBOARD</h2>
        </section >

        <div id="main">

        <!-- SUB-MENU -->
            <div id="sub_menu">
                
                <img src="../file/user2.png" width="50%" height="30%"/>
                <ul id="list">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#view">view items</a> </li>
                    <li><a href="#donate">donate items</a>
                    <li><a href="#request">view request</a>
                    <li><a id="logout" href="">log out</a></li>
                </ul>
            </div>

            <div id="page">

            <!-- HOME -->

                <section id= "home">
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

                <section id="view">
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
                </section>

                <!-- DONATE ITEMS -->

                <section id="donate">
                    <div">

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
                        
                                // $sql = "INSERT INTO request(`matricNo`,`Name`,`item`) VALUES('','', $_POST['sel'])";

                                $res = mysqli_query($conn,$sql);

                            }
                        ?>
                    </div>
                </section>



                <!-- VIEW REQUESTS TO APPROVE OR DELINE -->
                <section id="request">


                </section>

                <section id="log">

                </section>
            </div>

        </div>
    
    </body>

    <footer>
        <p>
            This is the university of the learned
        </p>
    </footer>
</html>



