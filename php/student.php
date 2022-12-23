<?php 
    session_start();
    if( isset( $_REQUEST['matric']) and isset( $_REQUEST['pass']) ){
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
            try {

                $sql ="SELECT matricNo,password FROM students 
                WHERE matricNo =$matric && password =$pass" ;

                $res = mysqli_query($conn,$sql);

                if (!$res) {
                    
                    throw new Exception($ex);
                }

            } 
            catch (Exception $e) {
                
                header('Location:./student.php?invalid username or password');
            }
        
            $rowcount = mysqli_num_rows($res);

            if($rowcount >0){

                $_SESSION['matric'] =$matric ;
                header("Location:./studAcc.php?#home");

            }
            else{
                header('Location:./student.php?invalid matric number or password');
            }
        }
    }

    require('./head.php');
?>





<body id="stud_body">
    
    <div id="stud_form_div">
        <h3 id="stud_h3">WELCOME GREAT STUDENT</h3>
        <form id="stud_form" action="<?php $_REQUESTPHP_SELF ?>" method="post">
        
            Matric no: <input autofocus type="text" name ="matric" id="matric">
            <?php echo "<br/> <br>"?>
            Password: <input type="password" name="pass">

            <?php echo "<br/> <br/>"?>

            <input id="stud_sub" type="submit">


        </form>
    </div>
</body>




<?php
require('./footer.php');

?>