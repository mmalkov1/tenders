 <?php
 require "lib/rb.php";
 R::setup( 'mysql:host=localhost;dbname=tender',
     'root', '' ); //for both mysql or mariaDB


/*
 $db = mysqli_connect('localhost','root','') or die("Невозможно подключиться к БД");
 mysqli_select_db ($db,'tender') or die ("Невозможно получить данные");
 mysqli_query ($db,"SET NAMES utf8");
*/

 $id = $_POST["id"];
 $option = $_POST["option"];
 $info = array();

  //  $info = "";
 switch ($option) {
     case 'edit':
         $torgi = R::findOne('torgi',' id = ? ', array($id) );
         $torgi->date_add=$_POST["date_1"];
         $torgi->date_og=$_POST["date"];
         $torgi->area=$_POST["area"];
         $torgi->link = $_POST["link"];
         $torgi->number = $_POST["number"];
         $torgi->okpo = $_POST["okpo"];
         $torgi->product_group = $_POST["product_group"];
         $torgi->redmet_torgov = $_POST["redmet_torgov"];
         $torgi->sku = $_POST["sku"];
         $torgi->lpr = $_POST["lpr"];
         $torgi->sum_zakaz = $_POST["sum_zakaz"];
         $torgi->zatrati_tender = $_POST["zatrati_tender"];
         $torgi->zatrati_dop = $_POST["zatrati_dop"];
         $torgi->date_start = $_POST["date_start"];
         $torgi->date_end = $_POST["date_end"];
         $torgi->date_aukcion = $_POST["date_aukcion"];
         $torgi->conditions = $_POST["conditions"];
         $torgi->zakazchik = $_POST["name"];
         $torgi->purch_comp = $_POST["purch_comp"];
         $torgi->purch_time = $_POST["purch_time"];
         $torgi->purch_cond = $_POST["purch_cond"];
         $torgi->alignment = $_POST["alignment"];
         $torgi->manager = $_POST["manager"];
         $torgi->dog_lob = $_POST["dog_lob"];
         $torgi->organization = $_POST["organization"];
         $torgi->cond_koord = $_POST["cond_koord"];
         $torgi->tend_send = $_POST["tender"];
         $torgi->tend_got = $_POST["tend_got"];
         $torgi->tend_prep = $_POST["koordinator"];
         $torgi->date_send_purch = $_POST["date_send_purch"];
         $torgi->name_purch = $_POST["purchase"];
         $torgi->date_got_purch = $_POST["date_got_purch"];
         $torgi->sum_per = $_POST["sum_per"];
         $torgi->sum_itog = $_POST["sum_itog"];
         $torgi->sum_purch = $_POST["sum_purch"];
         $torgi->date_app = $_POST["date_app"];
         $torgi->result = $_POST["result1"];
         $torgi->couse = $_POST["couse"];
         $torgi->winner = $_POST["winner"];
         $torgi->sum_win = $_POST["sum_win"];
         $torgi->date_over = $_POST["date_over"];
         $torgi->accent = $_POST['id']."; ".$_POST['date_1']."; ".$_POST['manager']."; ".$_POST['name'];
         R::store($torgi);
         $info["zamena"] = "ОК";
         echo json_encode($info);
         break;


        /* edit($id, $date_add, $date_og, $area,
             $link, $number, $okpo, $product_group,
             $redmet_torgov, $sku, $lpr, $sum_zakaz,
             $zatrati_tender,$zatrati_dop, $date_start,
             $date_end, $date_aukcion, $conditions, $name,
             $purch_comp, $purch_time, $purch_cond, $alignment,
             $manager, $dog_lob, $organiztion, $cond_koord,
             $tender, $tend_got, $koordinator, $date_send_purch,
             $purchase, $date_got_purch, $sum_per, $sum_itog, $sum_purch,
             $date_app, $result1, $couse, $winner, $sum_win, $date_over, $accent,
             $db);
             break;*/
     case 'delete':
            R::trash( 'torgi',$id );
     $info["zamena"] = "ОК";
     echo json_encode($info);
        // delete1($id, $db);
         break;
     case 'add':

         $torgi = R::dispense('torgi');
         $torgi->date_add=$_POST["date_1"];
         $torgi->date_og=$_POST["date"];
         $torgi->area=$_POST["area"];
         $torgi->link = $_POST["link"];
         $torgi->number = $_POST["number"];
         $torgi->okpo = $_POST["okpo"];
         $torgi->product_group = $_POST["product_group"];
         $torgi->redmet_torgov = $_POST["redmet_torgov"];
         $torgi->sku = $_POST["sku"];
         $torgi->lpr = $_POST["lpr"];
         $torgi->sum_zakaz = $_POST["sum_zakaz"];
         $torgi->zatrati_tender = $_POST["zatrati_tender"];
         $torgi->zatrati_dop = $_POST["zatrati_dop"];
         $torgi->date_start = $_POST["date_start"];
         $torgi->date_end = $_POST["date_end"];
         $torgi->date_aukcion = $_POST["date_aukcion"];
         $torgi->conditions = $_POST["conditions"];
         $torgi->zakazchik = $_POST["name"];
         $torgi->purch_comp = $_POST["purch_comp"];
         $torgi->purch_time = $_POST["purch_time"];
         $torgi->purch_cond = $_POST["purch_cond"];
         $torgi->alignment = $_POST["alignment"];
         $torgi->manager = $_POST["manager"];
         $torgi->dog_lob = $_POST["dog_lob"];
         $torgi->organization = $_POST["organization"];
         $torgi->cond_koord = $_POST["cond_koord"];
         $torgi->tend_send = $_POST["tender"];
         $torgi->tend_got = $_POST["tend_got"];
         $torgi->tend_prep = $_POST["koordinator"];
         $torgi->date_send_purch = $_POST["date_send_purch"];
         $torgi->name_purch = $_POST["purchase"];
         $torgi->date_got_purch = $_POST["date_got_purch"];
         $torgi->sum_per = $_POST["sum_per"];
         $torgi->sum_itog = $_POST["sum_itog"];
         $torgi->sum_purch = $_POST["sum_purch"];
         $torgi->date_app = $_POST["date_app"];
         $torgi->result = $_POST["result1"];
         $torgi->couse = $_POST["couse"];
         $torgi->winner = $_POST["winner"];
         $torgi->sum_win = $_POST["sum_win"];
         $torgi->date_over = $_POST["date_over"];
         $torgi->accent = $_POST['id']."; ".$_POST['date_1']."; ".$_POST['manager']."; ".$_POST['name'];
         R::store($torgi);
         $info["zamena"] = "ОК";
         echo json_encode($info);
         break;

     default :
         $info["zamena"] = "НЕТ ОПЦИИ";
         echo json_encode("$info");

 }
 function add ($date_add,  $date_og, $area,
               $link, $number, $name, $okpo, $product_group,
               $redmet_torgov, $sku, $lpr, $sum_zakaz,
               $zatrati_tender, $zatrati_dop, $date_start,
               $date_end, $date_aukcion, $conditions,
               $purch_comp, $purch_time, $purch_cond, $alignment,
               $manager, $dog_lob, $organiztion, $cond_koord,
               $tender, $tend_got, $koordinator, $date_send_purch,
               $purchase, $date_got_purch, $sum_per, $sum_itog, $sum_purch,
               $date_app, $result1, $couse, $winner, $sum_win, $date_over, $accent,
               $db){

     $query = "INSERT INTO torgi (Date_add, Date_og, Area,
               Link, Number, Zakazchik, OKPO, Product_group,
               Redmet_torgov, SKU, LPR, Sum_zakaz,
               Zatrati_tender, Zatrati_dop, Date_start,
               Date_end, Date_aukcion, Conditions,
               purch_comp, purch_time, purch_note, Alignment,
               Manager, Dog_lob, Organization, Cond_koord,
               Tend_send, Tend_got, Tend_prep, Date_send_purch,
               Name_purch, Date_got_purch, Sum_per, Sum_itog, Sum_purch, 
               Date_app, Result, Couse, Winner, Sum_win, Date_over, Accent
               
               ) VALUES 
               ('$date_add', '$date_og', '$area',
                '$link', '$number', '$name', '$okpo', '$product_group',
                '$redmet_torgov', '$sku', '$lpr', '$sum_zakaz',
                '$zatrati_tender', '$zatrati_dop', '$date_start', 
                '$date_end', '$date_aukcion', '$conditions',
                 '$purch_comp', '$purch_time', '$purch_cond', '$alignment',
               '$manager', '$dog_lob', '$organiztion', '$cond_koord',
               '$tender', '$tend_got', '$koordinator', '$date_send_purch',
               '$purchase', '$date_got_purch', '$sum_per', '$sum_itog', '$sum_purch',
               '$date_app', '$result1', '$couse', '$winner', '$sum_win', '$date_over',
               '$accent'
                );";
     $res = mysqli_query ($db, $query);
     verification( $res );
     close ($db);


 }

 function edit($id, $date_add, $date_og, $area,
               $link, $number, $okpo, $product_group,
               $redmet_torgov, $sku, $lpr, $sum_zakaz,
               $zatrati_tender, $zatrati_dop, $date_start,
               $date_end, $date_aukcion, $conditions, $name,
               $purch_comp, $purch_time, $purch_cond, $alignment,
               $manager, $dog_lob, $organiztion, $cond_koord,
               $tender, $tend_got, $koordinator, $date_send_purch,
               $purchase, $date_got_purch, $sum_per, $sum_itog, $sum_purch,
               $date_app, $result1, $couse, $winner, $sum_win, $date_over, $accent,
               $db){

     $query= "UPDATE torgi SET Date_add='$date_add', Date_og='$date_og', Area='$area',
 Link='$link', Number ='$number', OKPO='$okpo', Product_group='$product_group',
  Redmet_torgov='$redmet_torgov', SKU='$sku', LPR='$lpr', Sum_zakaz='$sum_zakaz',
  Zatrati_tender='$zatrati_tender', Zatrati_dop='$zatrati_dop', Date_start='$date_start', 
  Date_end='$date_end',Date_aukcion='$date_aukcion', Conditions='$conditions', Zakazchik='$name',
  purch_comp='$purch_comp', purch_time='$purch_time', purch_note='$purch_cond', Alignment='$alignment',
  Manager='$manager', Dog_lob='$dog_lob', Organization='$organiztion', Cond_koord='$cond_koord',
  Tend_send= '$tender', Tend_got='$tend_got', Tend_prep='$koordinator', Date_send_purch='$date_send_purch',
  Name_purch='$purchase', Date_got_purch='$date_got_purch', Sum_per='$sum_per', Sum_itog='$sum_itog', Sum_purch='$sum_purch', 
  Date_app='$date_app', Result='$result1', Couse='$couse', Winner='$winner', Sum_win='$sum_win', Date_over='$date_over',
  Accent = '$accent'
  WHERE id = '$id'";


     $res = mysqli_query($db, $query);
     verification( $res );
     close( $db );


 }

 function delete1($id, $db){
     $query = "DELETE FROM torgi WHERE id = '$id'";
     $res = mysqli_query($db, $query);
     verification( $res );
     close( $db );
 }




 function verification ($res) {

     if (!res) $info["zamena"] = "ОШИБКА";
     else $info["zamena"] = "ОК";
     echo json_encode($info);


 }

 function close ($db) {
     mysqli_close($db);

 }



 ?>