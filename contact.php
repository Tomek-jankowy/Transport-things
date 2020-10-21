<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/order_transprt.css">
        <link rel="stylesheet" type="text/css" href="css/myorder.css">
        <link rel="stylesheet" type="text/css" href="css/homepage.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;1,300;1,700;1,900&display=swap" rel="stylesheet">
        <script type="text/javascript" src="forwarding.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="main_nav">
                <div class="container_buttons">
                    <div class="buttons" id="b_home">Home</div>
                    <div class="buttons" id="selected" id="b_contact" >Contact</div>
                    <div class="buttons" id="b_aboutus" >About us</div>
                    <div class="buttons" id="b_ordertransport" >Order Transport</div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_myorder'>My orders";else echo"id='b_signup'>Sign up"; ?> </div>
                    <div class="buttons" <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"id='b_settings'>Settings";else echo"id='b_signin'>Sign in"; ?> </div>
                    <div class="buttons" id="b_help" >Help</div>
                    <?php if((isset($_SESSION['log_pased'])&&($_SESSION['log_pased']==true)))echo"<div class='buttons' id='b_logout'>Log out</div>";else echo""; ?>
                    <div style="clear: both;"></div>
                </div>
            </nav>
            <article>
                <div id="backgound">
                    <div id='order_transport_form'>
                        <form action="controler/contact_controler.php" method="POST">
                            <label for="e-mail">Enter your e-mail</label>
                            <br/>
                            <input class="input" type="text" name="e-mail" />
                            <br/>
                            <label for="message" >Enter your question</label>
                            <br/>
                            <textarea id="textarea"rows="4" name='message' maxlength="1000"></textarea>
                            <button name="send" value="send">Send</button>
                        </form>
                    </div>
                </div>
            </article>
            <footer id="share_and_contact">
                <img src="iko/png/002-share.png" id="share"/>
                <div id="contact">
                    <span class="contact">Do you need help?</span> <span class="contact" > <b>Contact Us!</b></span> <br/>
                    <span class="contact">tel: 986 534 226 </span><br/> <span class="contact" >  e-mail: transport_things@gmail.com</span>
                </div>
                <div style="clear: both;"></div>
            </footer>
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