<?php
function paging($total_rows,$max_rows,$cur_page){
    $max_pages=ceil($total_rows/$max_rows);
    $start=$cur_page-5; if($start<1)$start=1;
    $end=$cur_page+5;   if($end>$max_pages)$end=$max_pages;
    $paging='
    <form action="" method="post" name="frmpaging" id="frmpaging">
    <input type="hidden" name="txtCurnpage" id="txtCurnpage" value="1" />
    <ul class="pagination">
    ';

    $paging.='<p align="center" class="paging">';
    $paging.="<strong>Total:</strong> $total_rows <strong>on</strong> $max_pages <strong>page</strong><br>";

    if($cur_page >1){
        $paging.='<li class="page-item"><a class="page-link" href="javascript:gotopage('.($cur_page-1).')"> << </a></li>';
    }
    if($max_pages>1){
        for($i=$start;$i<=$end;$i++)
        {
            if($i!=$cur_page)
                $paging.="<li class='page-item'><a class=\"page-link\" href=\"javascript:gotopage($i)\"> $i </a></li>";
            else
                $paging.="<li class='page-item active'><a class=\"page-link\" href=\"#\" class=\"cur_page\"> $i </a></li>";
        }
    }
    if($cur_page <$max_pages)
        $paging.='<li class="page-item"><a class="page-link" href="javascript:gotopage('.($cur_page+1).')"> » </a></li>';

    $paging.='</ul></p></form>';
    echo $paging;
}
function activeMenu($val,$type='com'){
	$com=isset($_GET['com'])?antiData($_GET['com']):'home';
	$vie=isset($_GET['viewtype'])?antiData($_GET['viewtype']):'';
	if($type=='com' && $com==$val) echo 'active';
	if($type=='viewtype' && $vie==$val) echo 'active';
}
function activeVodMenuByStatus($val){
	$status=isset($_GET['status'])?antiData($_GET['status']):'-1';
	if($status==$val) echo ' active';
}
function isMobile(){
	if(preg_match("/(iPad)/i", $_SERVER["HTTP_USER_AGENT"])) return false;
	elseif(preg_match("/(iPhone|iPod|android|blackberry|Mobile|Lumia)/i", $_SERVER["HTTP_USER_AGENT"])) return true;
	else return false;
}
function un_unicode($str){
	$marTViet=array(
	'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
	'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
	'ì','í','ị','ỉ','ĩ',
	'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ',
	'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
	'ỳ','ý','ỵ','ỷ','ỹ',
	'đ',
	'A','B','C','D','E','F','J','G','H','I','K','L','M',
	'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
	'À','Á','Ạ','Ả','Ã','Â','Ầ','Ấ','Ậ','Ẩ','Ẫ','Ă','Ằ','Ắ','Ặ','Ẳ','Ẵ',
	'È','É','Ẹ','Ẻ','Ẽ','Ê','Ề','Ế','Ệ','Ể','Ễ',
	'Ì','Í','Ị','Ỉ','Ĩ',
	'Ò','Ó','Ọ','Ỏ','Õ','Ô','Ồ','Ố','Ộ','Ổ','Ỗ','Ơ','Ờ','Ớ','Ợ','Ở','Ỡ',
	'Ù','Ú','Ụ','Ủ','Ũ','Ư','Ừ','Ứ','Ự','Ử','Ữ',
	'Ỳ','Ý','Ỵ','Ỷ','Ỹ',
	'Đ',":",",",".","?","`","~","!","@","#","$","%","^","&","*","(",")","'",'"','&','/','|','   ','  ',' ','---','--');

	$marKoDau=array(
	'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
	'e','e','e','e','e','e','e','e','e','e','e',
	'i','i','i','i','i',
	'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
	'u','u','u','u','u','u','u','u','u','u','u',
	'y','y','y','y','y',
	'd',
	'a','b','c','d','e','f','j','g','h','i','k','l','m',
	'n','o','p','q','r','s','t','u','v','w','x','y','z',
	'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
	'e','e','e','e','e','e','e','e','e','e','e',
	'i','i','i','i','i',
	'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
	'u','u','u','u','u','u','u','u','u','u','u',
	'y','y','y','y','y',
	'd',"","","","","","","","","","","","","","",'','','','','','','',' ',' ','-','-','-');

	$str = str_replace($marTViet, $marKoDau, $str);
	return $str;
}
function Substring($str,$start,$len){
	$str=str_replace("  "," ",$str);
	$arr=explode(" ",$str);
	if($start>count($arr))	$start=count($arr);
	$end=$start+$len;
	if($end>count($arr))	$end=count($arr);
	$newstr="";
	for($i=$start;$i<$end;$i++)
	{
		if($arr[$i]!="")
		$newstr.=$arr[$i]." ";
	}
	if($len<count($arr)) $newstr.="...";
	return $newstr;
}
function encrypt($str,$key=KEY_AUTHEN_COOKIE){
	$str = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $str, MCRYPT_MODE_CBC, md5(md5($key))));
	return $str;
}
function decrypt($str,$key=KEY_AUTHEN_COOKIE){
	$str = $decode_u = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($str), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	return $str;
}
function http_url($url){
	if(defined('SSL') && SSL==true) return str_replace('http://','https://',$url);
	else return str_replace('https://','http://',$url);
}
function optimizeHTML($Html) {
  $encoding = mb_detect_encoding($Html);
  $doc = new DOMDocument('', $encoding);
  @$doc->loadHTML('<html><head>'
    . '<meta http-equiv="content-type" content="text/html; charset='
    . $encoding . '"></head><body>'. trim($Html) . '</body></html>');
  $nodes = $doc->getElementsByTagName('body')->item(0)->childNodes;
  $html = '';
  $len = $nodes->length;
  for ($i = 0; $i < $len; $i++) {
    $html .= $doc->saveHTML($nodes->item($i));
  }
  return $html;
}
function antiData($data,$type='plaintext',$tag=false){
	if(empty($data)) return '';
	$data=preg_replace('/\s\s+/', ' ', $data);
	switch($type){
		case 'plaintext': 
			$data=addslashes(trim(strip_tags($data)));
			break;
		case 'html':
			// remove unopentag and unclosetags
			$data=optimizeHTML($data);
			// remove blank tags
			$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
			$data= preg_replace($pattern,'',$data);
			$data= addslashes(trim($data));
			break;
		case 'int':
			$data=(int)trim($data);
			break;
		case 'float':
			$data=(float)trim($data);
			break;
		default: break;
	}
	if($tag) $data=htmlentities($data);
	return $data;
}
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyz012345678901234567890123456789ABCDEFGHIJKLMNOPQRSTUWXYZ012345678901234567890123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function randomNumber() {
    $alphabet = "012345678901234567890123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
//-----------------------CSDL------------------------------
function SysCount($table,$where){
	$sql="SELECT COUNT(*) as num FROM $table WHERE 1=1 $where";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc();
	return $r['num']+0;
}
function SysGetList($table,$fields=array(),$where='',$flag=true){
	if(count($fields)==0){
		$sql="SELECT * FROM $table WHERE 1=1 $where";
	}else{
		$sql="SELECT ";
		foreach($fields as $field){
			$sql.="`$field`,";
		}
		$sql=substr($sql,0,-1)." FROM $table WHERE 1=1 $where ";
	}
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	if($flag){
		$arr=array();
		while($r=$obj->Fetch_Assoc()){
			$arr[]=$r;
		}
		return $arr;
	}
	return $obj;
}
function SysAdd($table,$arr){
	if(!is_array($arr) || count($arr)==0) return false;
	$fields=$values='';
	foreach($arr as $key=>$val){
		$fields.="`$key`,";
		$values.="'$val',";
	}
	$sql="INSERT INTO ".$table."(".substr($fields,0,-1).") VALUES(".substr($values,0,-1).")";
	$obj=new CLS_MYSQL;
	$obj->Exec($sql);
	$id=$obj->LastInsertID();
	return $id;
}
function SysEdit($table,$arr,$where){
	$fields='';
	foreach($arr as $key=>$val){
		$fields.="`$key`='$val',";
	}
	$sql="UPDATE ".$table." SET ".substr($fields,0,-1)." WHERE $where";
	$obj=new CLS_MYSQL;
	return $obj->Exec($sql);
}
function SysActive($table,$where,$status=null){
	if($status!=null) $sql="UPDATE ".$table." SET `isactive`=$status WHERE $where";
	else $sql="UPDATE ".$table." SET `isactive`=if(`isactive`=1,0,1) WHERE $where";
	$obj=new CLS_MYSQL;
	$obj->Exec($sql);
}
function SysTrash($table,$where,$status=null){
	if($status!=null) $sql="UPDATE ".$table." SET `is_trash`=$status WHERE $where";
	else $sql="UPDATE ".$table." SET `is_trash`=if(`is_trash`=1,0,1) WHERE $where";
	$obj=new CLS_MYSQL;
	$obj->Exec($sql);
}
function SysDel($table,$where){
	$sql="DELETE FROM ".$table." WHERE $where";
	$obj=new CLS_MYSQL;
	$obj->Exec($sql);
}
function Curl_Post($url,$jsonBody){
	$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonBody);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($jsonBody))                                                                       
    );                                                                                                                   
    $resp = curl_exec($curl);//var_dump($resp);
    curl_close($curl);
    return json_decode($resp,true);
}
function Curl_Get($url){
	$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);//var_dump($resp);
    curl_close($curl);
    return json_decode($resp,true);
}
?>