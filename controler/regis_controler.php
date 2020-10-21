<?php 
    //warunek samo wywołujący sie jest potrzebny do inicjacji sprawdzania formularza rejestracji 
    $reg=new regis_controler;
    if((isset($_GET['reg']))&&($_GET['reg']==105))
    {
        if($reg->get_data()==true)header('Location: ../index.php');
        else header('Location: ../sign_up.php?error=7');
    }
    else if((isset($_POST['edit_user']))&&($_POST['edit_user']=='change'))$reg->edit_user_data($_POST['edit_user']);

    class regis_controler
    {
        public $name;
        public $email;
        private $pass;
        public $tel;
        
        public function get_name()
        {
            (strlen($_POST['reg_name'])!=0)?$this->name= htmlentities($_POST['reg_name'], ENT_QUOTES, "UTF-8"):header('Location: ../sign_up.php?error=8&line=3').exit();
        }
        public function get_email()
        {
            (strlen($_POST['reg_email'])!=0)?$email=$_POST['reg_email']:header('Location: ../sign_up.php?error=8&line=3').exit();
            (filter_var($email, FILTER_VALIDATE_EMAIL)==true)?$this->email=$email:header('Location: ../sign_up.php?error=4&line=3').exit();
        }
        private function get_pass()
        {
            ((strlen($_POST['reg_pass'])>=5)&&(strlen($_POST['reg_pass'])<=25))?$this->pass=$_POST['reg_pass']:header('Location: ../sign_up.php?error=3&line=4').exit();
        }
        public function get_tel()
        {
            (strlen($_POST['reg_tel'])>0)?$this->tel= htmlentities($_POST['reg_tel'], ENT_QUOTES, "UTF-8"):header('Location: ../sign_up.php?error=6&line=2').exit();
        }
        public function get_data()
        {
            $this->get_name();
            $this->get_tel();
            $this->get_email();
            $this->get_pass();
            require_once('database_controler.php');
            if( session_status() == PHP_SESSION_NONE )session_start();
            if(regis_controler::check_reg($this->pass,$this->email,$this->name,$this->tel)==true)return true;
            else return false;
        }
        public static function check_reg($pass,$email,$name,$tel)
        {
            
            $pass_hash=password_hash($pass,PASSWORD_DEFAULT);
            $result=database_controler::check_database(1,'customer','email',$email);
            if(mysqli_num_rows($result)==0)
            {
                $data=[$name,$email,$pass_hash,$tel,'cus'];
                if(database_controler::save_to_database($data,'reg')==true)
                {
                    $result=database_controler::check_database(1,'customer','email',$email);
                    $id=$result->fetch_assoc();
                    $_SESSION['log_pased']=true;
                    $_SESSION['log_pased_id']=$id['id_customer'];
                    return true;
                }
                else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
            }else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=2');
            
        }
        public function edit_user_data()
        {
            if( session_status() == PHP_SESSION_NONE )session_start();
            require('database_controler.php');
            $this->get_name();
            $this->get_tel();
            $this->get_email();
            $data=[$this->name,$this->email,$this->tel];
            (database_controler::update_data(2,$_SESSION['log_pased_id'],$data)==true)?header('Location: ../settings.php').exit():header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7').exit();
        }
    }
?>