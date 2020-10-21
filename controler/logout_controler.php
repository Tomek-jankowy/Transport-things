<?php 
    if( session_status() == PHP_SESSION_NONE )session_start();
    unset($_SESSION['log_pased'],$_SESSION['log_pased_id']);
    session_destroy();
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>