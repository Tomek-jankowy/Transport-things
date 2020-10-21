<?php 
    $change=new change_password;
    if((isset($_POST['change_pass']))&&($_POST['change_pass']=='change'))$change->main();
    class change_password
    {
        protected $newpass;
        private $id_customer;

        protected function get_oldpass($id)
        {
            require_once('database_controler.php');
            ((strlen($_POST['old_pass'])>=5)&&(strlen($_POST['old_pass'])<=25))?$oldpass=$_POST['old_pass']:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
            $result=database_controler::check_database(1,'customer','id_customer',$id);
            (mysqli_num_rows($result)==1)?$result_assoc=$result->fetch_assoc():header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
            if(password_verify($oldpass,$result_assoc['pass'])==true)return true;else return false;
        }
        private function get_idcustomer()
        {
            if( session_status() == PHP_SESSION_NONE )session_start();
            (strlen($_SESSION['log_pased_id'])!=0)?$this->id_customer=$_SESSION['log_pased_id']:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
        }
        protected function get_newpass()
        {
            ((strlen($_POST['new_pass'])>=5)&&(strlen($_POST['new_pass'])<=25))?$newpass=$_POST['new_pass']:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
            ((strlen($_POST['new_pass2'])>=5)&&(strlen($_POST['new_pass2'])<=25))?$newpass2=$_POST['new_pass2']:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
            ($newpass==$newpass2)?$this->newpass=password_hash($newpass,PASSWORD_DEFAULT):header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
        }
        public function main()
        {
            $this->get_idcustomer();
            ($this->get_oldpass($this->id_customer)==true)?$this->get_newpass():header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
            $data=[$this->newpass];
            (database_controler::update_data(3,$this->id_customer,$data)==true)?header('Location: ../settings.php?error=10').exit():header('Location: ../settings.php?error=7').exit();
        }
    }
?>