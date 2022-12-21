

<?php
require('./head.php');
 
        
    if( isset( $_REQUEST['matric']) && isset( $_REQUEST['psw']) ){
        $matric = $_REQUEST['matric'];
        $psw =$_REQUEST['psw'];

        // LOGIN DETAILS

        $host ='localhost';
        $user ="root";
        $pwd = "";
        $dbname ='phpwork';

            // SETTING CONNECTION
        $conn = mysqli_connect($host,$user,$pwd,$dbname);
        if(!$conn){
            die("invalid connection");
        }


        $sql ='SELECT matricNo,password FROM alumni' ;
        $res = mysqli_query($conn,$sql);
        $rowcount = mysqli_num_rows($res);


        if($rowcount >0){
            
            // CHECK IF USER EXISTS

            while($row = mysqli_fetch_assoc($res)){
                if( ($matric !== $row['matricNo']) || ($psw !== $row['password']) ){
                    die('Invalid matric number or password');
                    // header("Location:./student.php?invalid user");
                }
                    
            }
            setcookie("age",$matric,time()+(3600*3));            
            header("Location:./attempt.php?welcome");
        }
        else{
            die("nothing was returned") ;
        }

    }


?>

<body id="alum_body">

    <div id="alum_form_div">

        <h3 id="alum_h3">WELCOME GREAT ALUMNUS</h3>
        <form id="alum_form" action="alumni.php"method="post">
            
            Matric no: <input autofocus class="alumni_input" type="text" name ="matric" id="matric">
            <?php echo "<br/> <br/>"?>
            Password: <input class="alumni_input" type="psw">

            <?php echo "<br/> <br/>"?>

            <input id="alum_sub" type="submit">

        </form  >
    </div>
</body>

<?php
require('./footer.php')
?>


<?php 
    if( (isset($_REQUEST['matric']) && isset( $_REQUEST['psw'])) ==false){
        echo "invalid matric number or password ";
        exit();
    }
    
?>