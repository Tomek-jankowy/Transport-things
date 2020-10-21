<?php
    class display_order
    {
        public function get_order($number_query,$nametable,$what_check,$date_1)//Funkcja pobierajaca z bazy dane o zamówieniach dokonanych przez użytkownika
        {
            $result=database_controler::check_database($number_query,$nametable,$what_check,$date_1);//Odwołanie się od funkcji chce_database w kontrolerze database_controler celem pobrania danych z bazy
            //$number_result=mysqli_num_rows($result); //wywołanie funkcji liczacej ilość wierszy w rezultacie 
            if(mysqli_num_rows($result)>0)return $result;//jeżeli ilość wierszy jest wieksza od 0 oznacza to ze urzytkownik dokonał juz poprawnego zamownia i sa one mozliwe do wyświetlenia, if zwraca rezultat do funkcji wywołujacej
            else return false;//jeżeli ilość wierszy jest równa 0 oznacza że użytkownik nie dokonał zadenego zamowienia zwraca false
        }
        public function display($result,$who)
        {
            echo "<table>  <tr id='main_row'> <th >Id order</th> <th>Where transport</th> <th>From transport</th> <th>When transport</th> <th>Fullname recipient</th> <th>Recipient's phone number</th>";//Wyświetlenie nagłowków tabeli
            if($who=='adm')echo " <th>Logged</th> <th>Fullname sender</th> <th>E-mail sender</th> <th>Sender's phone numer</th> ";//Użytkownik będący adminem bedzie miał wyświetle wiecej danych dotyczacyh zamawiajacego usługe transportu
            echo "<td>Edit</td><td>Delete</td></tr>";//Wyświetlenie opisu przycisków
            for($i=1; $i<=mysqli_num_rows($result);$i++)//rozpoczecie pętli for składajacej sie z zmienej 'i' równej 1 i iterowanej po każdym przesciu petli do mometu kiedy wartość 'i' bedzie równa 'number_result' czyli ilosci wierszy w tablicy 'result'
            {
                $row=mysqli_fetch_assoc($result);//Przekazanie do tablicy asocjacyjnej 'row' jednego wiersza z tablicy 'result'
                if($row['id_client']=='0')//(if i else if tylko dla danych wyświetlanych dla administratora sprawdza czy użytkownik ma konto w bazie (jeśli nie ma konta do zmienych przekazywane sa dane z tabeli 'order_transport')(jeśli ma konto pobierane sa dane z tabeli 'customer' i przekazywane do zmienych) )
                {
                    $fullname_sender=$row['fullname_sender'];
                    $email_sender=$row['email_sender'];
                    $tel_sender=$row['tel_sender'];
                    $logged='No';
                }
                else if($row['id_order']!='0')
                {
                    $result_cus=database_controler::check_database(1,'customer','id_customer',$row['id_client']);
                    $result_assoc=$result_cus->fetch_assoc();
                    if (isset($result_assoc['name']))$fullname_sender=$result_assoc['name'];
                    if (isset($result_assoc['email']))$email_sender=$result_assoc['email'];
                    if (isset($result_assoc['phone_number']))$tel_sender=$result_assoc['phone_number'];
                    $logged='Yes';
                }
                echo "<tr class='second_row'> <td >".$row['id_order']."</td> <td>".$row['where_transport']."</td> <td>".$row['form_transport']."</td> <td>".$row['when_transport']."</td> <td>".$row['fullname_recipient']."</td> <td>".$row['tel_recipient']."</td>";//wyświetlenie danchy o zamowieniu (dla obu typów użytkownikow(admina i klienta))
                if($who=='adm')echo " <td>".$logged."</td> <td>".$fullname_sender."</td> <td>".$email_sender."</td> <td>".$tel_sender."</td> ";//dane wyswietlane tylko dla użytkownika z prawami administratora
                echo "<td><form method='post' action='update.php'><button name='update' value='".$row['id_order']."'>Edit</button> </form></td> <td><form method='post' action='controler/delete.php'><button name='delete' value='".$row['id_order']."'>Delete</button> </form></td> </tr>";//wyświetlenie guźików pozwalajacych na edycje lub na usunięcie danych w bazie
            }
            echo "</table>";//zakonczenie tabeli html
        }
        public function display_user_data($id_user)
        {
            require_once('database_controler.php');
            //zaimportowanie kontrolera opowiedzialnego za łączność z baza dancyh
            $result=database_controler::check_database(1,'customer','id_customer',$id_user);
            $result_assoc=$result->fetch_assoc();
            if(mysqli_num_rows($result)==1)echo "<table><tr><td>Fullname: </td> <td>".$result_assoc['name']."</td></tr><tr><td>E-mail</td> <td>".$result_assoc['email']."</td></tr> <tr><td>Phone number:</td><td>".$result_assoc['phone_number']."</td></td></tr> </tabel>";
            else echo"Are you sure you have an account with us?";
        }
        public function main($id_user)//główna funkcja zarządzajaca wyświetlanie danych z bazy użytkownikowi lub administratorom witryny 
        {
            require_once('database_controler.php');
            $result=database_controler::check_database(1,'customer','id_customer',$id_user);//sprawdznie w bazie użytkownika pod kątem jakie ma uprawnienia
            $result_assoc=$result->fetch_assoc();//stworzenie tablicy asocjacyjnej na podstaiw otrzymanego rezultatu
            if($result_assoc['role']=='cus')$result_2=$this->get_order(1,'order_transport','id_client',$id_user);//jeżeli użytkownik ma uprawnienia klienta przekaznie opowiednich danych do funkcji pobierjacej dane
            else if($result_assoc['role']=='adm')$result_2=$this->get_order(2,'order_transport',0,0);//jeżeli użytkownik ma uprawnienia administratora przekaznie opowiednich danych do funkcji pobierjacej dane
            if($result_2!=false)$this->display($result_2,$result_assoc['role']);//jeżeli result_2 nie jest równy false przekaznie danych do wyswietlenia ich użytkownikowi
            else echo "You don't have any order :(";//jezeli result_2 jest równy fales oznacza że nie danych do wyświetlenia
        }
    }
?>