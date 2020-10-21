<?php
    if( session_status() == PHP_SESSION_NONE )session_start();
    if((isset($_GET['error']))&&($_GET['error']!=0)) 
        {
            require('controler/displayerror_controler.php');
            $id_error=$_GET['error'];
            settype($id_error, "integer");
            display_error::display($id_error);
        }
        if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))
        {
            if((isset($_SESSION['log_pased_id']))&&($_SESSION['log_pased_id']>0))
            {
                require_once('controler/database_controler.php');
                $result=database_controler::check_database(1,'customer','id_customer',$_SESSION['log_pased_id']);
                $result_assoc=$result->fetch_assoc();
                $name=$result_assoc['name'];
                unset($result,$result_assoc);
            }
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/homepage.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;1,300;1,700;1,900&display=swap" rel="stylesheet">
        <script type="text/javascript" src="forwarding.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="main_nav">
                <div class="container_buttons">
                    <div class="buttons" id="selected" id="b_home">Home</div>
                    <div class="buttons" id="b_contact" >Contact</div>
                    <div class="buttons" id="b_aboutus" >About us</div>
                    <div class="buttons" id="b_ordertransport" >Order Transport</div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_myorder'>My orders";else echo"id='b_signup'>Sign up"; ?> </div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_settings'>Settings";else echo"id='b_signin'>Sign in"; ?> </div>
                    <div class="buttons" id="b_help" >Help</div>
                    <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"<div class='buttons' id='b_logout'>Log out</div>";else echo""; ?>
                    <div style="clear: both;"></div>
                </div>
            </nav>
            <article class="homepage_article">
                <section class="section_right">
                    <span id="inscription_01">Where could We<br/> tranport your <br/><?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"<span style='font-size:22px;'>things ".$name."?</span>";else echo"things?";?></span>
                    <form class="transport_form" method="get" action="submit_your_order.php">
                        <label for="where">Where</label>
                        <input class="input" type="text" name="where"/>
                        <label for="from">From</label>
                        <input class="input" type="text" name="from"/>
                        <label  for="when">When</label>
                        <input class="input" type="date" name="when"/>
                        <input type="submit" class="sent" value="Get Started"> 
                    </form>
                </section>
                <section class="section_left" id="background_img_01"></section>
                <div style="clear: both;"></div>
            </article>

            <article class="homepage_article">
                <section class="section_left" >
                   <img src="img/delivery.jpg"  height="414"/>
                </section>
                <section class="section_right" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"style='display:none;'";else echo""; ?>>
                    <div id="background_buttons_sign">
                        <div id="button_sign_up" class="choice" ><p class="text_in_button">Sing up</p></div> 
                        <div id="button_sign_in" class="choice" ><p class="text_in_button">Sign in</p></div>
                        <div style="clear: both;"></div>
                    </div>
                    <div id="form_sign">
                        <span id="inscription_02">Join us now and enjoy <br/> with our full funcionality</span>
                        <form  id="sing_up" style="display: none;" method="post" action="controler/regis_controler.php?reg=105">
                            <label for="reg_name">Your fullname</label>
                            <input class="input" type="text" name="reg_name"/>
                            <br/>
                            <label for="reg_email">E-mail</label>
                            <input class="input" type="email" name="reg_email"/>
                            <br/>
                            <label for="reg_tel">Your's phone number </label>
                            <input class="input" type="tel" name="reg_tel" pattern="[0-9]{9}"/> <br/>
                            <label for="Password">Passsword</label>
                            <input class="input" type="password" name="reg_pass" maxlength="25" minilength="5"/>
                            <input type="submit" class="sent" value="Sign Up"> 
                        </form>
                        <form  id="sing_in" style="display: none;" method="post" action="controler/logIn_controler.php?log=105">
                            <label for="log_email">E-mail</label>
                            <input class="input" type="email" name="log_email"/>
                            <label for="log_pass">Passsword</label>
                            <input class="input" type="password" name="log_pass" maxlength="25" minilength="5"/>
                            <div class="error"></div>
                            <input type="submit" class="sent" value="Sign In"> 
                        </form>
                    </div>
                </section>

                <div style="clear: both;"></div>
            </article>
            <footer id="share_and_contact" style="background-color: #5399c2;">
                <img src="iko/png/002-share.png" id="share"/>
                <div id="contact">
                    <span class="contact">Do you need help?</span> <span class="contact" > <b>Contact Us!</b></span> <br/>
                    <span class="contact">tel: 986 534 226 </span><br/> <span class="contact" >  e-mail: transport_things@gmail.com</span>
                </div>
                <div style="clear: both;"></div>
                <p>The pictures we used come from the website:</p>
                <a href='https://www.freepik.com/vectors/medical'>Medical vector created by freepik - www.freepik.com</a>
            </footer>
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript" src="forwarding.js"></script>
<script>
    var sing_in = document.getElementById('button_sign_in');
    var sign_up = document.getElementById('button_sign_up');
    $(sing_in).click(function()
    {
        $("#sing_in").show("slow");
        $("#sing_up").hide("slow");
    });
    $(sign_up).click(function()
    {
        $("#sing_up").show(500);
        $("#sing_in").hide(500);
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

