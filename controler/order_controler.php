<?php
        if((isset($_GET['ord']))&&($_GET['ord']==105))order_controler::make_order();
        else if((isset($_POST['confirm']))&&($_POST['confirm']>0))
        {
            if(order_controler::get_date_for_update($_POST['confirm'])==true)header('Location: ../myorder.php');
        }
    class order_controler
    {
        private $where;
        private $from;
        private $when;
        private $fullname_recipient;
        private $tel_recipient;
        private $account;
        private $log_email;
        private $log_pass;
        private $fullname_sender;
        private $email_sender;
        private $tel_sender;    
        private $reg_pass;
        private $id_client=0;
            //Funkcje GET pobierja i przeprowadzaja sprawdzenie danych wchodzoncych z formularzu(../order_transport.php) metoda POST
        private function get_delivery()
        {
            (strlen($_POST['where'])!=0)?$this->where=htmlentities($_POST['where'], ENT_QUOTES):header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=1').exit();
            (strlen($_POST['from'])!=0)?$this->from= htmlentities($_POST['from'], ENT_QUOTES):header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=2').exit();
            (strlen($_POST['when'])!=0)?$this->when=$_POST['when']: header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=3').exit();
        }
        private function get_recipient_date()
        {
            (strlen($_POST['fullname_recipient'])!=0)?$this->fullname_recipient=htmlentities($_POST['fullname_recipient'], ENT_QUOTES): header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=4').exit();
            (strlen($_POST['tel_recipient'])!=0)?$this->tel_recipient= htmlentities($_POST['tel_recipient'], ENT_QUOTES):header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=5').exit();
        }
        private function get_login_date()
        {
            (strlen($_POST['log_email']))?$email=$_POST['log_email']:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=10').exit();
            (filter_var($email, FILTER_VALIDATE_EMAIL)==true)?$this->log_email=$email:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=4&line=10').exit();
            (strlen($_POST['log_pass'])>0)?$this->log_pass=$_POST['log_pass']: header('Location: '.$_SERVER['HTTP_REFERER'].'?error=3&line=11').exit();
        }
        private function get_sender_date()
        {
            (strlen($_POST['reg_name'])!=0)?$this->fullname_sender= htmlentities($_POST['reg_name'], ENT_QUOTES, "UTF-8"):header('Location: '.$_SERVER['HTTP_REFERER'].'?error=5&line=6').exit();
            (strlen($_POST['reg_email'])!=0)?$email=$_POST['reg_email']:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=8&line=7').exit();
            (filter_var($email, FILTER_VALIDATE_EMAIL)==true)?$this->email_sender=$email:header('Location: '.$_SERVER['HTTP_REFERER'].'?error=4&line=7').exit();
            (strlen($_POST['reg_tel'])!=0)?$this->tel_sender= htmlentities($_POST['reg_tel'], ENT_QUOTES, "UTF-8"):header('Location: '.$_SERVER['HTTP_REFERER'].'?error=5&line=8').exit();
            if($this->account=='reg')
            {
                if(isset($_POST['reg_pass']))
                {
                    if((strlen($_POST['reg_pass'])>=5)||(strlen($_POST['reg_pass'])<=25))$this->reg_pass=$_POST['reg_pass'];
                    else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=3&line=9');
                }else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=3&line=9');
            }
        }
        private function get_account()
        {
            if((!isset($_POST['account']))||(strlen($_POST['account'])==0))
            {
                if(($_SESSION['log_pased']=true)&&($_SESSION['log_pased_id']!=0))$this->id_client=$_SESSION['log_pased_id'];
                else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=9');
            }
            else $this->account=$_POST['account']; 
        }
        private function get_id($email)
        {
            $result=database_controler::check_database(1,'customer','email',$email);
            $array_result=$result->fetch_assoc();
            $this->id_client=$array_result['id_customer'];
        }
        public function main_order_function()
        {
            //require_once('database_controler.php');
            //pobranie decyzji uzytkownika
            if( session_status() == PHP_SESSION_NONE )session_start();
            $this->get_account();
            if($this->account=='log')
            {
                //sprawdznie odpowiedzi funcji check_log. Po poprawnym sprawdzeniu danych logowania, wywołanie funkcji odczytu danych i funkcji zapisu
                require_once('logIn_controler.php');
                $this->get_login_date();
                if(login_controler::check_log($this->log_email,$this->log_pass)==true)
                {
                    $this->get_id($this->log_email);
                    if($this->create_query()==true) header('Location: ../thank_for_order.html');
                    else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
                }
                else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
            }
            else if($this->account=='no_reg') //po wybraniu przez użytkownika opcji bez rejestracji: 1.pobranie danych,2.wywołanie funkcji zapisu.
            {
                $this->get_delivery();
                $this->get_recipient_date();
                $this->get_sender_date();
                $data=[$this->where,$this->from,$this->when,$this->fullname_recipient,$this->tel_recipient,0,$this->fullname_sender,$this->email_sender,$this->tel_sender];
                if(database_controler::save_to_database($data,'no_reg')==true)  header('Location: ../thank_for_order.html');
                else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
            }  
            else if($this->account=='reg')//Po wybraniu przez użytkownika opcji rejestracji: 1.sprawdznie poprawnego zapisania danych rejestracji 2.Pobranie danych 3. wywołanie funkcji zapisu
            {
                require_once('regis_controler.php');
                $this->get_sender_date();
                if(regis_controler::check_reg($this->reg_pass,$this->email_sender,$this->fullname_sender,$this->tel_sender)==true) 
                {
                    $this->get_id($this->email_sender);
                    if($this->create_query()==true)header('Location: ../thank_for_order.html');
                    else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
                }
                else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
            }
            else if($_SESSION['log_pased']=true)
            {
                if($this->create_query()==true) header('Location: ../thank_for_order.html');
                else header('Location: '.$_SERVER['HTTP_REFERER'].'?error=7');
            }
        }
        private function create_query()
        {
            //require_once('database_controler.php');
            $this->get_delivery();
            $this->get_recipient_date();
            $data=[$this->where,$this->from,$this->when,$this->fullname_recipient,$this->tel_recipient,$this->id_client];
            if(database_controler::save_to_database($data,'log')==true)return true;
            else return false;
        }
        public static function make_order()
        {
            require_once('database_controler.php');
            $make_order=new order_controler;
            $make_order->main_order_function();
        }
        public static function get_date_for_update($id_order)
        {
            require_once('database_controler.php');
            $update = new order_controler;
            $update->get_delivery();
            $update->get_recipient_date();
            $data=[$update->where,$update->from,$update->when,$update->fullname_recipient,$update->tel_recipient];
            if(database_controler::update_data(1,$id_order,$data)==true)return true;
            else return false;
        }
    }
?>