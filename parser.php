<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 17.05.2017
 * Time: 21:17
 */

require ('lib/phpQuery.php');
$link = $_POST["link"];
$name = "";
$area = "";
$okpo = "";
$date_start = "";
$date_end = "";
$date_aukcion = "";
$sum_tender = "";
$redmet_torgov = "";
$sum_zatrat = "0";
$lpr = "";
$number = "";
$data = array();
$lots = 0;
$date_add = date("Y-m-d");
$date_end_search = "";

if (stripos($link, "dtek")) {

    $dtek = file_get_contents($link);
    phpQuery::newDocument($dtek);
    $text = pq('table:eq(0)')->html();
    $name = pq($text)->find('tr:eq(0) > td:eq(1)');
    $name = pq($name)->text();

    for ($i=0; $i<=100; $i++) {
        $search = pq($text)->find('tr:eq('.$i.') > td:eq(0)');
        $search = pq($search)->text();
        if ($search == "Дата окончания") {
            $date_end = pq($text)->find('tr:eq('.$i.') > td:eq(1)');
            $date_end = pq($date_end)->text();


        };
        if ($search == "Ответственное лицо") {
            $lpr = pq($text)->find('tr:eq('.$i.') > td:eq(1)');
            $lpr = pq($lpr)->text();

        }
    }

    $date_start = date("Y-m-d");
    $date_og = date("Y-m-d");
    $sum_tender = "0";
    $sum_zatrat = "0";
    $area = "ДТЭК";
    $number = substr($link, stripos($link, "offer_id=")+9, 6);
    

} else {
    $link_temp = substr($link, strpos($link, "UA-"), 22);
    $link = "https://prozorro.gov.ua/tender/" . $link_temp;



    $prozorro = file_get_contents($link);
    phpQuery::newDocument($prozorro);

    $tender_info = pq('.tender--head--inf')->text();


    $name = pq('table:eq(0)')->html();
    $name = pq($name)->find('tr:eq(0) > td:eq(1)');
    $name = pq($name)->text();

    $okpo = pq('table:eq(0)')->html();
    $okpo = pq($okpo)->find('tr:eq(1) > td:eq(1)');
    $okpo = pq($okpo)->text();

    $date_end = pq('table:eq(1)')->html();
    $date_aukcion = pq('table:eq(1)')->html();

    if (strpos($tender_info, "Відкриті торги") > 0) {

        $date_end = pq($date_end)->find('tr:eq(2) > td:eq(1)');

        $proverka = pq($date_aukcion)->find('tr:eq(3) > td:eq(0)');
        $proverka = pq($proverka)->text();
        if ($proverka !== "Очікувана вартість:") {
            $date_aukcion = pq($date_aukcion)->find('tr:eq(3) > td:eq(1)');
        } else {
            $date_aukcion = "-";
        }
    } elseif (strpos($tender_info, "Допорогові закупівлі") > 0) {

        $date_end = pq($date_end)->find('tr:eq(1) > td:eq(1)');
        $proverka = pq($date_aukcion)->find('tr:eq(2) > td:eq(0)');
        $proverka = pq($proverka)->text();
        if ($proverka !== "Очікувана вартість:") {
            $date_aukcion = pq($date_aukcion)->find('tr:eq(2) > td:eq(1)');
        } else {
            $date_aukcion = "-";
        }


    }
    $date_start = pq('.tender--customer--inner:eq(1)')->html();
    $date_start = pq($date_start)->find('.date:eq(0)');
    $date_start = pq($date_start)->text();
    $date_end = pq($date_end)->text();
    $date_ukr = array(" січня ", " лютого ", " березня ", " квітня ", " травня ", " червня ", " липня ", " серпня ", " вересня ", "  жовтня ", " листопада ", " грудня ");
    $date_num = array(".01.", ".02.", ".03.", ".04.", ".05.", ".06.", ".07.", ".08.", ".09.", ".10.", ".11.", ".12.");
    $date_start = str_replace($date_ukr, $date_num, $date_start);
    $date_start = preg_replace("/\s{2,}/", " ", $date_start);
    $date_end = str_replace($date_ukr, $date_num, $date_end);
    $date_aukcion = pq($date_aukcion)->text();
    $date_aukcion = str_replace($date_ukr, $date_num, $date_aukcion);
    $sum_tender = pq('.tender--description--cost--number')->text();
    $sum_tender = preg_replace('/[^,.0-9]/', '', $sum_tender);
    $sum_tender = (int)$sum_tender;
    $lots = pq('#lots')->text();
    if ($lots !== "Лоти") {

        if ($sum_tender < 20000) {
            $sum_zatrat = 17;
        } elseif ($sum_tender < 50000) {
            $sum_zatrat = 119;
        } elseif ($sum_tender < 200000) {
            $sum_zatrat = 340;
        } elseif ($sum_tender < 1000000) {
            $sum_zatrat = 510;
        } elseif ($sum_tender >= 1000000) {
            $sum_zatrat = 1700;
        } else {
            $sum_zatrat = 'проверьте сумму тендера';
        }
    } else {
        $sum_zatrat = 'мультилоты';
    }

    $redmet_torgov = pq('.tender--head--title')->text();
    $lpr = pq('table:eq(0)')->html();
    $lpr = pq($lpr)->find('tr:eq(3) > td:eq(1)');
    $lpr = pq($lpr)->text();
    $lpr = preg_replace("/\s{2,}/", " ", $lpr);
    $date_og_year = substr($link_temp, 3, 4);
    $date_og_month = substr($link_temp, 8, 2);
    $date_og_day = substr($link_temp, 11, 2);
    $date_og = $date_og_year . "-" . $date_og_month . "-" . $date_og_day;
    $number = substr($link, strpos($link, "UA-"), 22);

}
   phpQuery::unloadDocuments();


$data[] = array('name' => $name, 'area' => $area, 'okpo' => $okpo, 'lpr'=>$lpr, 'num'=>$number,'date_start' => $date_start ,'date_end' => $date_end, 'date_aukcion' => $date_aukcion, 'sum_tender' => $sum_tender, 'sum_zatrat' => $sum_zatrat, 'redmet_torgov' => $redmet_torgov, 'date_add' => $date_add, 'date_og'=>$date_og);

echo json_encode($data);
