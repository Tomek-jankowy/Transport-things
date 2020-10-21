<?php 
    $contact=new contact;
    if((isset($_POST['send']))&&($_POST['send']=='send'))$contact->main();
    class contact
    {
        private $email;
        private $message;
        private function get_email()
        {
            (strlen($_POST['e-mail'])!=0)?$email=$_POST['e-mail']:header('Location: ../sign_up.php?error=8&line=3').exit();
            (filter_var($email, FILTER_VALIDATE_EMAIL)==true)?$this->email=$email:header('Location: ../sign_up.php?error=4&line=3').exit();
        }
        private function get_message()
        {
            (strlen($_POST['message'])!=0)?$this->message= htmlentities($_POST['message'], ENT_QUOTES, "UTF-8"):header('Location: ../sign_up.php?error=8&line=3').exit();
        }
        public function main()
        {
            $this->get_email();
            $this->get_message();
            require_once('database_controler.php');
            $data=[$this->email,$this->message];
            (database_controler::save_to_database($data,'mes')==true)?header('Location: ../index.php?error=11').exit():header('Location: ../contact.php?error=7').exit();
        }
    }
?>