<?php
    session_start();
    if( isset( $_REQUEST['matric']) && isset( $_REQUEST['pass']) ){
        $matric = htmlspecialchars($_REQUEST['matric']);
        $pass =htmlspecialchars($_REQUEST['pass']);
        

        // LOGIN DETAILS

        $host ='localhost';
        $user ="root";
        $pwd = "";
        $dbname ='phpwork';

        // SETTING CONNECTION
        $conn = mysqli_connect($host,$user,$pwd,$dbname);
        if(!$conn){
            die("Unable to connect to database");
        }else{

            // CHECKING FOR INVALID LOGIN INPUT

            try{
                $sql ="SELECT matric,password FROM alumni
                WHERE matric =$matric && password =$pass" ;

                $res = mysqli_query($conn,$sql);        
                

                if(!$res){
                    throw new Exception($ex);
                }
            }

            catch(Exception $ex){
                header('Location:./alumni.php?invalid username or password');
            }
            
            $rowcount = mysqli_num_rows($res);
            if($rowcount >0){

                $_SESSION['matric'] =$matric ;
                header("Location:./alumAcc.php?#home");
            }
            else{
                echo("nothing was returned") ;
                header('Location:./alumni.php?invalid matric number or password');
            }
        }

    }-
    require('./head.php');

?>

<body id="alum_body">

    <div id="alum_form_div">

        <h3 id="alum_h3">WELCOME GREAT ALUMNUS</h3>
        <form id="alum_form" action="alumni.php"method="post">
            
            Matric no: <input autofocus class="alumni_input" type="text" name ="matric" id="matric">
            <?php echo "<br/> <br/>"?>
            Password: <input class="alumni_input" type="password" name="pass">

            <?php echo "<br/> <br/>"?>

            <input id="alum_sub" type="submit">

        </form>
    </div>
</body>




<?php
require('./footer.php')
?>
