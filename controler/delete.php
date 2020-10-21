<script> 
    if (confirm("Are you sure you want to delete?"))console('');
    else location.href="../index.php";
 </script>
<?php
    session_start();
    if((!isset($_SESSION['log_pased']))&&($_SESSION['log_pased']!=true))header('Location: ../index.php').exit();
    else if((isset($_POST['delete']))&&($_POST['delete']!=0))
    {
        require('database_controler.php');
        database_controler::delete('order_transport','id_order',$_POST['delete']);
        header('Location: '.$_SERVER['HTTP_REFERER']).exit();
    }
    else if((isset($_POST['delete_user']))&&($_POST['delete_user']!=0))
    {
        require('database_controler.php');
        database_controler::delete('order_transport','id_order',$_POST['delete_user']);
        database_controler::delete('customer','id_customer',$_POST['delete_user']);
        unset($_SESSION['log_pased'],$_SESSION['log_pased_id']);
        session_destroy();
        header('Location: ../index.php').exit();
    }
    else header('Location: ../index.php').exit();
?>