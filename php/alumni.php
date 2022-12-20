<?php
require('./head.php')
?>

<body id="alum_body">

<h3 id="alum_h3">WELCOME GREAT ALUMNUS</h3>
    <div id="alum_form_div">
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