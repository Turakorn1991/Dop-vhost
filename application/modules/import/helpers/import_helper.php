<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/17/2017 AD
 * Time: 08:10
 */
if(!function_exists('makeText')){
    function makeText($str="",$length=20){
        $len=0;

        if($str){
            $len=strlen(str_replace(array('่','้','๊','๋','็','ู','ุ','์','ื','ิ','ี'),'',$str));
        }

        $space=($len<$length)?str_repeat('&nbsp; ',($length-$len)/2) :"";
            return $str.$space;
    }
}
if(!function_exists('monthName')){
    function monthName($month){
        $f_m = array("01"=>"มกราคม",
            "02"=>"กุมภาพันธ์",
            "03"=>"มีนาคม",
            "04"=>"เมษายน",
            "05"=>"พฤษภาคม",
            "06"=>"มิถุนายน",
            "07"=>"กรกฎาคม",
            "08"=>"สิงหาคม",
            "09"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม"
        );
        return @$f_m[$month];
    }
};
if(!function_exists('dateTH')){
    function dateTH($date="",$flag="/",$disp='normal'){
        $add=543;

        if($date&&$date!="0000-00-00"){
            list($y,$m,$d)=explode('-',trim($date));
            if($disp=="normal"){
                return $d.$flag.$m.$flag.($y+$add);
            }elseif($disp=="long"){
                return (int)$d.$flag.monthName($m).$flag.($y+$add);
            }
            return $d.$flag.$m.$flag.($y+$add);
        }
        return "";

    }
}
if(!function_exists('age')){
    function age($date){
        if(!empty($date)) {
            $from = new DateTime($date);
            $to = new DateTime('today');
            return $from->diff($to)->y;
        }
        return "";
    }
}
if(!function_exists('ThaiBahtConversion')){
    function ThaiBahtConversion($amount_number)
    {
        
        $amount_number = number_format($amount_number, 2, ".","");
        //echo "<br />amount = " . $amount_number . "<br />";
        $pt = strpos($amount_number , ".");
        $number = $fraction = "";
        if ($pt === false)
            $number = $amount_number;
        else
        {
            $number = substr($amount_number, 0, $pt);
            $fraction = substr($amount_number, $pt + 1);
        }

        //list($number, $fraction) = explode(".", $number);
        $ret = "";
        $baht = ReadNumber ($number);
        if ($baht != "")
            $ret .= $baht . "บาท";

        $satang = ReadNumber($fraction);
        if ($satang != "")
            $ret .=  $satang . "สตางค์";
        else
            $ret .= "ถ้วน";
        //return iconv("UTF-8", "TIS-620", $ret);
        return $ret;
    }

    function ReadNumber($number)
    {
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0) return $ret;
        if ($number > 1000000)
        {
            $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while($number > 0)
        {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
                ((($divider == 10) && ($d == 1)) ? "" :
                    ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : "");
            $number = $number % $divider;
            $divider = $divider / 10;
            $pos++;
        }
        return $ret;
    }
}
if(!function_exists('yeardiff')){
    function yeardiff($date=0){
        if(!empty($date)) {
            $from = new DateTime($date);
            $to = new DateTime('today');
            $y=$from->diff($to)->y;

            if (!$y){
                $m=$from->diff($to)->m;
                if(!$m){
                    $d=$from->diff($to)->d;
                    return  array('value'=>$d,'unit'=>"วัน");
                }
                return  array('value'=>$m,'unit'=>"เดือน");
            }
            return  array('value'=>$y,'unit'=>"ปี");
        }

        return  array('value'=>'','unit'=>"");
    }
};
if(!function_exists('sex')){
    function sex($sex=0){
        if($sex==0){
            return 'ไม่ทราบ';
        }
        elseif($sex==1){
            return 'ชาย';
        }
        elseif($sex==2){
            return 'หญิง';
        }
        elseif($sex==9){
            return 'ไม่สามารถระบุได้';
        }
    }
}
if(!function_exists('digiTh')){
    function digiTh($digi=""){
        $list=array('๐','๑','๒','๓','๔','๕','๖','๗','๘','๙');
        $text="";

      if($digi){
          foreach (str_split($digi) as $val){
              if(is_numeric($val)){
                $text.=$list[$val];
              }else{
                $text.=$val;
              }
             
          }

      }
      return $text;
    }
}

