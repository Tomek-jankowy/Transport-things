<?php 
    session_start();
    require('controler/displayerror_controler.php');
    if((isset($_GET['error']))&&($_GET['error']!=0)) 
    {
        $id_error=$_GET['error'];
        settype($id_error, "integer");
        
        if((isset($_GET['line']))&&($_GET['line']!=0)) 
        {
            settype($_GET['line'], "integer"); 
            $line=$_GET['line'];
        }
    }
    if((isset($_SESSION['log_pased']))&&($_SESSION['log_pased']==true)) header('Location: index.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/order_transprt.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;1,300;1,700;1,900&display=swap" rel="stylesheet">
        <style>#bad{border: 3px solid red;}</style>
    </head>
    <body>
        <div class="container">
            <nav class="main_nav">
                <div class="container_buttons">
                    <div class="buttons" id="b_home">Home</div>
                    <div class="buttons" id="b_contact" >Contact</div>
                    <div class="buttons" id="b_aboutus" >About us</div>
                    <div class="buttons" id="b_ordertransport" >Order Transport</div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_myorder'>My orders";else echo"id='b_signup'>Sign up"; ?> </div>
                    <div class="buttons" id="selected" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_settings'>Settings";else echo"id='b_signin'>Sign in"; ?> </div>
                    <div class="buttons" id="b_help" >Help</div>
                    <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"<div class='buttons' id='b_logout'>Log out</div>";else echo""; ?>
                    <div style="clear: both;"></div>
                </div>
            </nav>
            <article>
                <section>
                    <div id="backgound">
                        
                        <div id='order_transport_form'>
                            <div><?php if(isset($id_error))display_error::display($id_error);?></div>
                            <form  id="sing_in" method="post" action="controler/logIn_controler.php?log=105">
                                <label for="log_email">E-mail</label>
                                <input class="input" <?php if((isset($line))&&($line==1))echo "id='bad'";?>type="email" name="log_email"/>
                                <label for="log_pass">Passsword</label>
                                <input class="input" type="password" name="log_pass" maxlength="25"<?php if((isset($line))&&($line==2))echo "id='bad'";?>/>
                                <div class="error"></div>
                                <input type="submit" class="sent" value="Sign In"> 
                            </form>
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