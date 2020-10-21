<?php
    session_start();
    require('controler/displayerror_controler.php');
    if((isset($_GET['error']))&&($_GET['error']!=0)) 
    {
        $id_error=$_GET['error'];
        settype($id_error, "integer");
        display_error::display($id_error);
    }
    if((!isset($_SESSION['log_pased']))&&($_SESSION['log_pased']!=true))header('Location: index.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/order_transprt.css">
        <link rel="stylesheet" type="text/css" href="css/myorder.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;1,300;1,700;1,900&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <nav class="main_nav">
                <div class="container_buttons">
                <div class="buttons" id="b_home">Home</div>
                    <div class="buttons" id="b_contact" >Contact</div>
                    <div class="buttons" id="b_aboutus" >About us</div>
                    <div class="buttons" id="b_ordertransport" >Order Transport</div>
                    <div class="buttons" id="selected" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_myorder'>My orders";else echo"id='b_signup'>Sign up"; ?> </div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_settings'>Settings";else echo"id='b_signin'>Sign in"; ?> </div>
                    <div class="buttons" id="b_help" >Help</div>
                    <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"<div class='buttons' id='b_logout'>Log out</div>";else echo""; ?>
                    <div style="clear: both;"></div>
                </div>
            </nav>
            <article>
                <section>
                    <div id="backgound">
                        <div id="div_tabel">
                            <?php
                                require("controler/displayorder_controler.php");
                                $user=new display_order;
                                $user->main($_SESSION['log_pased_id']);
                                //display_order::main($_SESSION['log_pased_id']);
                            ?>
                        </div>
                    </div>
                </section>
            </article>
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript" src="forwarding.js"></script>
<script>
    $('#b_home').click(function(){location.href="index.php";});
    $('#b_contact').click(function(){location.href="contact.php";});
    $('#b_aboutus').click(function(){location.href="about_us.php";});
    $('#b_ordertransport').click(function(){location.href="submit_your_order.php";});
    $('#b_signup').click(function(){location.href="sign_up.php";});
    $('#b_myorder').click(function(){location.href="myorder.php";});
    $('#b_signin').click(function(){location.href="sign_in.php";});
    $('#b_logout').click(function(){location.href="controler/logout_controler.php";});
    $('#b_help').click(function(){location.href="help.php";});
    $('#b_settings').click(function(){location.href="settings.php";});
</script>