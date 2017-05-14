<?php 
//日期-加減幾天取得新日期
function dateadd($d,$x) {
	$tt=explode("-",$d);
	$the_m=mktime(0, 0, 0, $tt[1], $tt[2], $tt[0]);
	$the_m=$the_m+($x*86400);
	return strftime("%Y-%m-%d",$the_m);
}

//日期-加減幾週取得新日期
function date_add_week($d,$x) {
	$tt=explode("-",$d);
	$the_m=mktime(0, 0, 0, $tt[1], $tt[2], $tt[0]);
	$the_m=$the_m+($x*(86400*7));
	return strftime("%Y-%m-%d",$the_m);
}

//日期-加減幾個月取得新日期
function date_add_month($d,$x) {
	$tt=explode("-",$d);
	$a=intval($x/12);			//有幾年
	$tt[0]=$tt[0]+$a;			//加幾年
	$tt[1]=$tt[1]+($x%12);		//加幾月
	if ($tt[1]>12) {			//超過一年
		$tt[0]++;				//加一年
		$tt[1]=$tt[1]-12;		//設定月數
	}	
	if ($tt[1]==2 and $tt[2]>28) $tt[2]=28;
	$the_m=mktime(0, 0, 0, $tt[1], $tt[2], $tt[0]);
	return strftime("%Y-%m-%d",$the_m);
}

//日期-兩個日期相差幾個月
function datediff_month($d1,$d2) {
	$tt1=explode("-",$d1);
	$m1=mktime(0, 0, 0, $tt1[1], $tt1[2], $tt1[0]);
	$tt2=explode("-",$d2);
	$m2=mktime(0, 0, 0, $tt2[1], $tt2[2], $tt2[0]);
	//$w1=date("W",$m1);
	//$w2=date("W",$m2);
	//$y1=date("Y",$m1);
	//$y2=date("Y",$m2);
	//$dy=0;
	return intval((($m2-$m1)/(30*86400)));
}

//日期-兩個日期相差幾週
function datediff_week($d1,$d2) {
	$tt1=explode("-",$d1);
	$m1=mktime(0, 0, 0, $tt1[1], $tt1[2], $tt1[0]);
	$tt2=explode("-",$d2);
	$m2=mktime(0, 0, 0, $tt2[1], $tt2[2], $tt2[0]);
	//$w1=date("W",$m1);
	//$w2=date("W",$m2);
	//$y1=date("Y",$m1);
	//$y2=date("Y",$m2);
	//$dy=0;
	return intval((($m2-$m1)/(7*86400)));
}

//日期-兩個日期相差幾天
function datediff($d1,$d2) {
	$tt1=explode("-",$d1);
	$m1=mktime(0, 0, 0, $tt1[1], $tt1[2], $tt1[0]);
	$tt2=explode("-",$d2);
	$m2=mktime(0, 0, 0, $tt2[1], $tt2[2], $tt2[0]);
	return intval(($m2-$m1)/86400);
}

//日期-取得星期幾(值加1)
function datepart($d) {
	$tt=explode("-",$d);
	$the_m=mktime(0, 0, 0, $tt[1], $tt[2], $tt[0]);
	return strftime("%w",$the_m)+1;
}

//日期-取得星期幾(1~6,星期日是0)
function weekday($d) {
	$tt=explode("-",$d);
	$the_m=mktime(0, 0, 0, $tt[1], $tt[2], $tt[0]);
	$w=strftime("%w",$the_m);
	return $w;
}

//日期-取得星期幾(1~6,星期日7)
function weekday2($d) {
	$tt=explode("-",$d);
	$the_m=mktime(0, 0, 0, $tt[1], $tt[2], $tt[0]);
	$w=strftime("%w",$the_m);
	if ($w==0) $w=7;
	return $w;
}

//日期-取得星期幾(值減1)
function weekday_num($d) {
	$tt=explode("-",$d);
	$the_m=mktime(0, 0, 0, $tt[1], $tt[2], $tt[0]);
	$w=strftime("%w",$the_m);
	if ($w==0) $w=7;
	$w=$w-1;
	return $w;
}

//日期-兩個日期的差距
function diffymd($date1,$date2){
	if(strtotime($date1)>strtotime($date2)){
		$tmp=$date2;
		$date2=$date1;
		$date1=$tmp;
	}
	list($Y1,$m1,$d1)=explode('-',$date1);
	list($Y2,$m2,$d2)=explode('-',$date2);
	$Y=$Y2-$Y1;
	$m=$m2-$m1;
	$d=$d2-$d1+1;
	if($d<0){
		$d+=(int)date('t',strtotime("-1 month $date2"));
		$m--;
	}
	if($m<0){
		$m+=12;
		$y--;
	}
	if ($Y1==$Y2 and $m1==$m2 and $m1==2 and $d1==1 and ($d2==28 or $d2==29)) {
		$Y=0;
		$m=1;
		$d=0;	
	}
	if ($Y1==$Y2 and $m1==$m2 and ($m1==1 or $m1==3 or $m1==5 or $m1==7 or $m1==8 or $m1==10 or $m1==12) and $d1==1 and ($d2==31)) {
		$Y=0;
		$m=1;
		$d=0;	
	}
	if ($Y1==$Y2 and $m1==$m2 and ($m1==4 or $m1==6 or $m1==9 or $m1==11 ) and $d1==1 and ($d2==30)) {
		$Y=0;
		$m=1;
		$d=0;	
	}
	return array($Y,$m,$d);
}

//時間-加減幾分取得新時間
function timeadd($t,$m) {		//$m==分鐘
	$tt=explode(":",$t);
	$the_m=mktime($tt[0],$tt[1],0, 1,1,2000);
	$the_m=$the_m+($m*60);
	return strftime("%H:%M",$the_m);
}

//時間-兩個時間相差幾小時
function timediff($bt,$et) {
	$bt=substr($bt,0,5);
	$et=substr($et,0,5);
	$t1=explode(":",$bt);
	$m1=mktime($t1[0],$t1[1], 0, 1, 1, 2000);
	//
	$t2=explode(":",$et);
	$m2=mktime($t2[0],$t2[1], 0, 1, 1, 2000);
	$work_hr=(($m2-$m1)/60)/60;
	return $work_hr;
}

//時間-兩個時間相差幾分鐘
function timediffm($bt,$et) {
	$t1=explode(":",substr($bt,0,5));
	$m1=mktime($t1[0],$t1[1], 0, 1, 1, 2000);
	//
	$t2=explode(":",substr($et,0,5));
	$m2=mktime($t2[0],$t2[1], 0, 1, 1, 2000);
	$work_m=(($m2-$m1)/60);
	return $work_m;
}

//時間-兩個時間相差幾分鐘
function timetonow($bt,$et) {
	$t1=explode(":",substr($bt,0,5));
	$m1=mktime($t1[0],$t1[1], 0, 1, 1, 2000);
	//
	$t2=explode(":",substr($et,0,5));
	$m2=mktime($t2[0],$t2[1], 0, 1, 1, 2000);
	$work_m=(($m2-$m1)/60);
	return $work_m;
}

//時間-重組timestamp
function show_timestamp($timestamp) {
	if (strlen($timestamp)==14) {
		$xout=substr($timestamp,0,4)."-".substr($timestamp,4,2)."-".substr($timestamp,6,2)."&nbsp;".substr($timestamp,8,2).":".substr($timestamp,10,2).":".substr($timestamp,12,2);
	} else {
		$xout=$timestamp;
	}   
	return $xout;
}
 
//時間-重組timestamp
function show_timestamp_d($timestamp) {
	if (strlen($timestamp)==14) {
		$xout=substr($timestamp,0,4)."-".substr($timestamp,4,2)."-".substr($timestamp,6,2);
	} else {
		$xout=substr($timestamp,0,10);
	}   
	return $xout;
}

//時間-重組timestamp
function show_timestamp_s($time) {
	if (strlen($time)==8) {
		$xout=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
	} else {
		$xout=$time;
	}
	return $xout;
}

//時間-帶入日期取得時間戳記
function datenum($d1) {
     $tt1=explode("-",$d1);
     $m1=mktime(0, 0, 0, $tt1[1], $tt1[2], $tt1[0]);
	 return $m1;
}

//擷取字串中間的一段文字
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}