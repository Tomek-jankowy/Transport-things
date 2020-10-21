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
    else if((!isset($_SESSION['log_pased']))&&($_SESSION['log_pased']==false)) header('Location: index.php').exit();
    else if((isset($_GET['edit']))&&($_GET['edit']==1))
    {
        require('controler/database_controler.php');
        (strlen($_GET['edit'])!=0)?$result=database_controler::check_database(1,'customer','id_customer',$_SESSION['log_pased_id']):header('Location: settings.php?error=9').exit();
        $result_assoc=$result->fetch_assoc();
    }
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
                        <div id='order_transport_form' >
                            <div><?php if(isset($id_error))display_error::display($id_error);?></div>
                            <form  id="sing_up" method="post" action="controler/regis_controler.php" <?php if((isset($_GET['edit']))&&($_GET['edit']==1))echo "";else echo "style='display:none;'";  ?>>
                                <label for="reg_name">Your fullname</label>
                                <input class="input" type="text" name="reg_name" value="<?php echo $result_assoc['name']; ?>" <?php if((isset($line))&&($line==1))echo "id='bad'";?>/>
                                <br/>
                                <label for="reg_tel">Your's phone number </label>
                                <input class="input" type="tel" name="reg_tel" pattern="[0-9]{9}" value="<?php echo $result_assoc['phone_number']; ?>" <?php if((isset($line))&&($line==2))echo "id='bad'";?>/> 
                                <br/>
                                <label for="reg_email">E-mail</label>
                                <input class="input" type="email" name="reg_email" value="<?php echo $result_assoc['email']; ?>" <?php if((isset($line))&&($line==3))echo "id='bad'";?>/>
                                <br/>
                                <button  name="edit_user" value="change">Edit</button>
                            </form>
                            <form method="POST" action="controler/change_password_controler.php" <?php if((isset($_GET['edit']))&&($_GET['edit']==2))echo "";else echo "style='display:none;'" ?>>
                                <label for="log_pass">Enter the old password</label>
                                <input class="input" type="password" name="old_pass" maxlength="25" <?php if((isset($line))&&($line==1))echo "id='bad'";?>/>
                                <label for="log_pass">Enter the new password</label>
                                <input class="input" type="password" name="new_pass" maxlength="25" <?php if((isset($line))&&($line==2))echo "id='bad'";?>/>
                                <label for="log_pass">Repeat new password</label>
                                <input class="input" type="password" name="new_pass2" maxlength="25" <?php if((isset($line))&&($line==3))echo "id='bad'";?>/>
                                <button name="change_pass" value="change">Confirm</button>
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