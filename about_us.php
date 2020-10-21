<?php
    session_start();
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
                    <div class="buttons" id="selected" id="b_aboutus" >About us</div>
                    <div class="buttons" id="b_ordertransport" >Order Transport</div>
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
                        <p class="help">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed augue semper augue consequat sagittis. Pellentesque sit amet accumsan neque, non lobortis justo. Sed blandit metus vel lorem consequat, nec posuere nibh laoreet. Maecenas id urna et tortor egestas mollis. Maecenas ac scelerisque erat. Aliquam et vehicula augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin nulla est, tincidunt vel augue nec, volutpat pellentesque purus. Sed venenatis iaculis diam, id pretium magna aliquet blandit. Nam vel mi tellus. Vivamus facilisis magna nisi, sit amet vehicula dolor varius sed. Sed at convallis augue. Aenean ex ex, vestibulum ut dapibus ut, malesuada ut odio.
                        </p>
                        <p class="help">
                        Pellentesque iaculis est eget posuere tempor. Nulla egestas tellus vitae erat tristique, vel posuere nulla maximus. Curabitur in erat velit. Proin congue bibendum enim ac blandit. Morbi dictum sem at turpis finibus sodales. Sed dapibus ipsum non vehicula rhoncus. Duis tempor odio dolor. Aliquam viverra sapien sem, in sagittis neque sagittis quis. Nunc cursus ante eu purus cursus, vitae feugiat urna pretium. Quisque sed placerat purus. Fusce porttitor, tellus quis commodo consequat, ante dui elementum lacus, nec consectetur dui erat id neque.
                        </p>
                        <p class="help">
                            Maecenas sagittis velit eu tellus mollis faucibus. Sed pharetra ullamcorper interdum. Donec scelerisque sagittis blandit. Nam fringilla molestie volutpat. Morbi vitae semper eros. Sed eget dolor cursus, lacinia nisi dapibus, tincidunt velit. Etiam porta in leo at finibus. Suspendisse tempus nunc eu tristique pharetra. Morbi pellentesque accumsan lorem ut rutrum. Nullam in dolor pulvinar, tempor felis a, maximus leo. Proin sagittis gravida vestibulum. Donec ac sem vulputate, fringilla neque sed, consectetur sem. Donec vitae nibh accumsan, lobortis quam ut, pulvinar sapien. Ut egestas purus a fringilla tempus. Vestibulum in dui tincidunt, auctor orci ac, cursus felis.
                        </p>
                        <p class="help">
                        Nullam posuere venenatis libero, et feugiat ante vehicula sed. Integer viverra a nisl dictum hendrerit. Pellentesque nisl lectus, hendrerit ac molestie in, sollicitudin in ligula. Vestibulum efficitur, magna et aliquet tincidunt, ante metus faucibus sem, ac ultrices lectus tortor eget sapien. Suspendisse consectetur lacus et est malesuada, sagittis placerat sem euismod. Sed a dignissim augue. Pellentesque dapibus est nec luctus scelerisque. Vestibulum sed ante imperdiet lorem gravida facilisis. Curabitur vestibulum ante nec enim elementum, eget dapibus turpis tincidunt. Pellentesque vel lobortis diam. Phasellus quam urna, aliquam id nulla eu, efficitur congue neque.
                        </p>
                        <p class="help">
                        Pellentesque et euismod nibh, nec auctor est. Integer ac ligula nec odio sollicitudin eleifend. Donec quis odio dignissim, consectetur enim et, egestas eros. Fusce enim sapien, consectetur at tempor sed, accumsan ac diam. Sed et urna id nunc porttitor sollicitudin. Nunc maximus enim vitae laoreet suscipit. Maecenas consectetur viverra ex ut varius. Duis in ante quis orci convallis pharetra et id sapien. Ut malesuada eros nec porta sodales.
                        </p>

                        <p class="help">
                            

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed augue semper augue consequat sagittis. Pellentesque sit amet accumsan neque, non lobortis justo. Sed blandit metus vel lorem consequat, nec posuere nibh laoreet. Maecenas id urna et tortor egestas mollis. Maecenas ac scelerisque erat. Aliquam et vehicula augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin nulla est, tincidunt vel augue nec, volutpat pellentesque purus. Sed venenatis iaculis diam, id pretium magna aliquet blandit. Nam vel mi tellus. Vivamus facilisis magna nisi, sit amet vehicula dolor varius sed. Sed at convallis augue. Aenean ex ex, vestibulum ut dapibus ut, malesuada ut odio
                        </p>
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