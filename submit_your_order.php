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
    if((isset($_SESSION['log_pased']))&&($_SESSION['log_pased']==true))
    {
        if((isset($_SESSION['log_pased_id']))&&($_SESSION['log_pased_id']>0))
        {
            echo "<style>.logged{display: none;}</style>";
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/order_transprt.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;1,300;1,700;1,900&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script type="text/javascript" src="forwarding.js"></script>
        <style>#bad{border: 3px solid red;}</style>
    </head>
    <body>
        <div class="container">
            <nav class="main_nav">
                <div class="container_buttons">
                    <div class="buttons" id="b_home">Home</div>
                    <div class="buttons" id="b_contact" >Contact</div>
                    <div class="buttons" id="b_aboutus" >About us</div>
                    <div class="buttons" id="selected"  id="b_ordertransport" >Order Transport</div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_myorder'>My orders";else echo"id='b_signup'>Sign up"; ?> </div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_settings'>Settings";else echo"id='b_signin'>Sign in"; ?> </div>
                    <div class="buttons" id="b_help" >Help</div>
                    <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"<div class='buttons' id='b_logout'>Log out</div>";else echo""; ?>
                    <div style="clear: both;"></div>
                </div>
            </nav>
            <article>
                <section>
                    <div id="backgound">
                        <div id='order_transport_form'>
                            <div><?php if(isset($id_error))display_error::display($id_error);else echo "<p style='font-size: 12px;'>Remember that all fields must be completed, it is very important!</p>"?></div>
                            
                            <form id='order_form' method="post" action="controler/order_controler.php?ord=105">
                                <label for="where">Where could we transport your things<br/>Enter address:</label>
                                <input class="input" type="text" name="where" value="<?php if(isset($_GET['where']))echo$_GET['where'];else echo'';?>"<?php if((isset($line))&&($line==1))echo "id='bad'";?> />
                                <label for="from">From where will we pick your package<br/>Enter address:</label>
                                <input class="input" type="text" name="from" value="<?php if(isset($_GET['from']))echo$_GET['from'];else echo'';?>"<?php if((isset($line))&&($line==2))echo "id='bad'";?>/>
                                <label  for="when">When can we pick up<br/>Enter date</label>
                                <input class="input" type="date" name="when" value="<?php if(isset($_GET['when']))echo$_GET['when'];else echo'';?>"<?php if((isset($line))&&($line==3))echo "id='bad'";?>/>
                                <label for="fullname_recipient">Enter the recipient's fullname</label>
                                <input class="input" type="text" name="fullname_recipient" <?php if((isset($line))&&($line==4))echo "id='bad'";?>/><br/>
                                <label for="tel_recipient">Recipient's phone number </label>
                                <input class="input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" name="tel_recipient"/> <?php if((isset($line))&&($line==5))echo "id='bad'";?><br/>
                                <div class="logged">
                                    <span>I have an account</span>

                                    <input type="radio" name="account" id="have_account" value='log'/>
                                    <input type="radio" name="account" id="not_have_account" value="no_reg"/>
                                    <span>I am not have</span>
                                </div>
                                <div id="div_not_have_account" style="display: none;">
                                    <label for="reg_name">Enter the sender's fullname</label>
                                    <input class="input" type="text" name="reg_name"<?php if((isset($line))&&($line==6))echo "id='bad'";?>/> <br/>
                                    <label for="reg_email">E-mail</label>
                                    <input class="input" type="email" name="reg_email"<?php if((isset($line))&&($line==7))echo "id='bad'";?>/> <br/>
                                    <label for="reg_tel">Sender's phone number </label>
                                    <input class="input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" name="reg_tel"<?php if((isset($line))&&($line==8))echo "id='bad'";?>/> <br/>
                                    <input type="radio" name="account" id="want_reg" value="reg"><span>I want to register</span>
                                    <div id="show_pass" style="display: none;">
                                        <label for="reg_pass">Passsword</label>
                                        <input class="input" type="password" name="reg_pass" maxlength="25"<?php if((isset($line))&&($line==9))echo "id='bad'";?>/>
                                    </div>
                                </div>
                                <div id="div_have_account" style="display: none;">
                                    <label for="log_email">E-mail </label>
                                    <input class="input" type="email" name="log_email" <?php if((isset($line))&&($line==10))echo "id='bad'";?>/>
                                    <label for="log_pass">Passsword</label>
                                    <input class="input" type="password" name="log_pass" maxlength="25" <?php if((isset($line))&&($line==11))echo "id='bad'";?>/>
                                </div>
                                <input type="submit"/>
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
    $('#not_have_account').click(function(){
        $("#div_not_have_account").show(500);
        $("#div_have_account").hide(500);
        $("#show_pass").hide(500);
    });
    $('#have_account').click(function(){
        $("#div_have_account").show(500);
        $("#div_not_have_account").hide(500);
        $("#show_pass").hide(500);
    });
    $('#want_reg').click(function(){
        $("#show_pass").show(500);
    });
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