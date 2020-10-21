<?php
    session_start();
    if((isset($_GET['error']))&&($_GET['error']!=0)) 
    {
        require('controler/displayerror_controler.php');
        $id_error=$_GET['error'];
        settype($id_error, "integer");
        
    }
    if((!isset($_SESSION['log_pased']))&&($_SESSION['log_pased']!=true))header('Location: index.php');
    // $require=get_required_files();
    // if((in_array('database_controler.php', $require)==false)||(in_array('controler/database_controler.php', $require)==false))require('controler/database_controler.php');
    //require('controler/database_controler.php');
    
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
                        
                        <div id="div_tabel" style="margin-left: 300px;"style="margin-right:auto;">
                            <div><?php if(isset($id_error))display_error::display($id_error);?></div>
                            <span style="font-size: 20px;">Your data: </span>
                            <?php 
                                require('controler/displayorder_controler.php');
                                $user =new display_order;
                                $user->display_user_data($_SESSION['log_pased_id']);
                            ?> 
                            <tabel>
                                <tr><td colspan="2"><br/> </td></tr>
                                <tr><td colspan="2"><br/> </td></tr>
                                <form method="GET" action="edit_user.php"> <tr><td><label style="color:black;" for="edit">If you want to edit your data click here </label></td><td style="text-align: center;"> <button name="edit" value="1" >Edit</button></td></tr></form>
                                <tr><td colspan="2"><br/> </td></tr>
                                <form method="GET" action="edit_user.php"> <tr><td><label style="color:black;" for="change_password">If you want to change your password click here </label></td><td style="text-align: center;"> <button name="edit" value="2" >Change Password</button></td></tr></form>
                                <tr><td colspan="2"><br/> </td></tr>
                                <form method="POST" action="controler/delete.php"> <tr><td><label style="color:black;" for="delete_user">If you want to delete your account click here </label></td><td style="text-align: center;"> <button name="delete_user" value="<?php if(isset($_SESSION['log_pased_id']))echo $_SESSION['log_pased_id']; else echo 0; ?>">Delete</button></td></tr></form>
                            </tabel>
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