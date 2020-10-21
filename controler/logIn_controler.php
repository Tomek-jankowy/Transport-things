<?php 
    //warunek samo wywołujący sie jest potrzebny do inicjacji sprawdzania formularza logowania
    $log=new login_controler;
    if((isset($_GET['log']))&&($_GET['log']==105))$log->get_date();
    class login_controler
    {
        private $email;
        protected $pass;

        private function get_email()
            {
                (strlen($_POST['log_email'])!=0)?$email=$_POST['log_email']:header('Location: ../sign_in.php?error=8&line=1').exit();
                (filter_var($_POST['log_email'], FILTER_VALIDATE_EMAIL)==true)?$this->email=$email:header('Location: ../sign_in.php?error=4&line=1').exit();
            }
        private function get_pass()
        {
            ((strlen($_POST['log_pass'])>=5)&&(strlen($_POST['log_pass'])<=25))?$this->pass=$_POST['log_pass']:header('Location: ../sign_in.php?error=3&line=2').exit();
        }
        public function get_date()
        {
            $this->get_email();
            $this->get_pass();
            (login_controler::check_log($this->email,$this->pass)==true)?header('Location: ../index.php').exit():header('Location: ../sign_in.php?error=1').exit();
        }
        public static function check_log($email,$pass)
        {
            require('database_controler.php');
            //pobranie rezultatu wykonanego zapytanie
            $result=database_controler::check_database(1,'customer','email',$email);
            //sprawdznie liczby otrzymanych wierysz i konwersja rezultatu na tablice asocjacyjną 
            $result_assoc=$result->fetch_assoc();
            //sprwdzenie czy podany adres e-mail znajudje sie w bazie i czy przypisane do niego hasło zgadza sie z wpisanym w polu przez użytkownika
            if((mysqli_num_rows($result)==1)&&(password_verify($pass,$result_assoc['pass'])))
            {
                if( session_status() == PHP_SESSION_NONE )session_start();
                $_SESSION['log_pased']=true;
                $_SESSION['log_pased_id']=$result_assoc['id_customer'];
                return true;
            }
            else return false;
        }
    }
?>