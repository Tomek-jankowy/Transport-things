<?php

class display_error 
    {
        public static function checkerror($id_error)
        {
            $result=database_controler::check_database(1,'error','id_error',$id_error);
            $number_result=mysqli_num_rows($result);
            if($number_result==1)
            {
                $array_result=$result->fetch_assoc();
                return $array_result['content_of_the_error'];
            }
            else echo "";

        }
        public static function display($id_error)
        {
            // $require=get_required_files();
            // if((in_array('databaser_controle.php', $require)==false)||(in_array('controler/databaser_controle.php', $require)==false))require('database_controler.php');
            require_once('database_controler.php');
            $error=display_error::checkerror($id_error);
            echo"<span style='color:red;'>".$error."</span>";
        }
    }
?>