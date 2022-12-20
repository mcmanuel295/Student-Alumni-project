<?php 
        
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


        $sql ='SELECT matricNo,password FROM students' ;
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

<?php
require('./head.php')
?>

<body id="stud_body">
    <h3 id="stud_h3">WELCOME GREAT STUDENT</h3>

    <div id="stud_form_div">
        <form id="stud_form" action="<?php $_REQUESTPHP_SELF ?>" method="post">
        
            Matric no: <input autofocus type="text" name ="matric" id="matric">
            <?php echo "<br/>"?>
            Password: <input type="password" name="psw">

            <input type="submit">


        </form>
    </div>
</body>




<?php
require_once('./footer.php')

?>