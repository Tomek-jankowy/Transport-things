<?php 

    class database_controler
    {
        static function make_connection()
        {
            require('connect.php');
            mysqli_report(MYSQLI_REPORT_STRICT);
            try
            {
                $connection = new mysqli($host,$db_user,$db_password,$db_name);//stworzenie obiektu klasy mysqli i przekaznie mu parametrow połącznia
                if($connection->connect_errno!=0)throw new Exception(mysqli_connect_errno());//sprawdzenie poprawnego połacznia
                else return $connection;//jeżeli połacznie jest zrealizowanie, wysłanie na podstawie otrzymanych danych z parametrow od funkcji wywołujacej stworzenie rezultatu zapytania i sprawdznie jego poprawnego otrzymania
            }
            catch(Exception $e) //przechycenie błedow i wyświetlenie ich
            {
                echo "I'm so sorry somethimg wemt wrong :".$e;
                return false;
            }
        }
        //metoda sprawdzjąca i pobierająca dane z bazy
        public static function check_database($number_query,$nametable,$what_check,$date_1)
        {
            $connection=database_controler::make_connection();
            if($connection!=false)
            {
                if($number_query==1)
                {
                    $result=$connection->query("SELECT * FROM `$nametable` WHERE `$what_check`='$date_1'");
                    if(!$result) throw new Exception($connection->error);
                }
                else if($number_query==2)
                {
                    $result=$connection->query("SELECT * FROM `$nametable`");
                    if(!$result) throw new Exception($connection->error);
                }
                $connection->close();//zmakniecie połacznia
                return $result;
            }else return false;
        }
        public static function save_to_database($date,$form)
        {
            $connection=database_controler::make_connection();
            if($connection!=false)
            {
                if($form=='log')
                {
                    if($connection->query("INSERT INTO order_transport(where_transport,form_transport,when_transport,fullname_recipient,tel_recipient,id_client) VALUES('$date[0]','$date[1]','$date[2]','$date[3]','$date[4]','$date[5]')")) return true;
                    else 
                    {
                        throw new Exception($connection->error);
                        return false;
                    }
                }
                else if($form=='no_reg')
                {
                    if($connection->query("INSERT INTO order_transport(where_transport,form_transport,when_transport,fullname_recipient,tel_recipient,fullname_sender,email_sender,tel_sender) VALUES('$date[0]','$date[1]','$date[2]','$date[3]','$date[4]','$date[5]','$date[7]','$date[8]')"))return true;
                    else 
                    {
                        throw new Exception($connection->error);
                        return false;
                    }
                }
                else if($form=='reg')
                {
                    if($connection->query("INSERT INTO customer(name,email,pass,phone_number,role) VALUES('$date[0]','$date[1]','$date[2]','$date[3]','$date[4]')"))return true;
                    else 
                    {
                        throw new Exception($connection->error);
                        return false;
                    }
                }
                else if($form=='mes')
                {
                    $post_data=new DateTime();
                    if($connection->query("INSERT INTO question(email,message) VALUES('$date[0]','$date[1]')"))return true;
                    else 
                    {
                        throw new Exception($connection->error);
                        return false;
                    }
                }
            }else return false;
            $connection->close();//zmakniecie połacznia
        }
        public static function delete($nametable,$what_check,$data_1)
        {
            $connection=database_controler::make_connection();
            if($connection!=false)$connection->query("DELETE FROM `$nametable` WHERE `$what_check`='$data_1'");
            $connection->close();//zmakniecie połacznia
        }
        public static function update_data($number_query,$id,$data)
        {
            $connection=database_controler::make_connection();
            if($connection!=false)
            {
                if($number_query==1)
                {
                    if(!$connection->query("UPDATE `order_transport` SET `where_transport`='$data[0]',`form_transport`='$data[1]',`when_transport`='$data[2]',`fullname_recipient`='$data[3]',`tel_recipient`='$data[4]' WHERE `id_order`='$id'"))return false;
                    else return true;
                }
                else if($number_query==2)
                {
                    if(!$connection->query("UPDATE `customer` SET `name`='$data[0]',`email`='$data[1]',`phone_number`='$data[2]' WHERE `id_customer`='$id'"))return false;
                    else return true;
                }
                else if($number_query==3)
                {
                    if(!$connection->query("UPDATE `customer` SET `pass`='$data[0]' WHERE `id_customer`='$id'"))return false;
                    else return true; 
                }
            }
        }
    }
?>