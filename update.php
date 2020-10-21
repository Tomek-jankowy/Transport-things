<?php
    session_start();
    if((!isset($_SESSION['log_pased']))&&($_SESSION['log_pased']!=true))header('Location: index.php');
    else if((isset($_POST['update']))&&($_POST['update']!=0))
    {
        require('controler/database_controler.php');
        $result=database_controler::check_database(1,'order_transport','id_order',$_POST['update']);
        $number_result=mysqli_num_rows($result);
        if($number_result==1)$result_assoc=$result->fetch_assoc();
    }
    else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/order_transprt.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;1,300;1,700;1,900&display=swap" rel="stylesheet">
    </head>
    <body>
        <article>
            <section>
                <div id="backgound">
                    <div id='order_transport_form'>
                        <form id='order_form' method="post" action="controler/order_controler.php">
                            <label for="where">Where could we transport your things<br/>Enter address:</label>
                            <input class="input" type="text" name="where" value="<?php if(isset($result_assoc['where_transport']))echo $result_assoc['where_transport'];else echo""; ?>" />
                            <label for="from">From where will we pick your package<br/>Enter address:</label>
                            <input class="input" type="text" name="from" value="<?php if(isset($result_assoc['form_transport']))echo $result_assoc['form_transport'];else echo""; ?>"/>
                            <label  for="when">When can we pick up<br/>Enter date</label>
                            <input class="input" type="date" name="when" value="<?php if(isset($result_assoc['when_transport']))echo $result_assoc['when_transport'];else echo""; ?>"/>
                            <label for="fullname_recipient">Enter the recipient's fullname</label>
                            <input class="input" type="text" name="fullname_recipient" value="<?php if(isset($result_assoc['fullname_recipient']))echo $result_assoc['fullname_recipient'];else echo""; ?>"/><br/>
                            <label for="tel_recipient">Recipient's phone number </label>
                            <input class="input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" name="tel_recipient" value="<?php if(isset($result_assoc['tel_recipient']))echo $result_assoc['tel_recipient'];else echo""; ?>"/> <br/>
                            <button name='confirm' value='<?php echo $_POST['update'] ?>'>Confirm</button>
                        </form>
                    </div>
                </div>
            </section>
        </article>
    </body>
</html>