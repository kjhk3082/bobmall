<?
include "./class/library.php";

if(file_exists('./class/db.php')) die();




if(!$_POST[uid]){
    alert('이메일을 입력해 주세요.');
    go('/blank.php');
    exit;
}



if($_POST[upw]!=$_POST[upw2]){
    alert('최고관리자 패스워드가 일치하지 않습니다.');
    go('/blank.php');
    exit;
}


if(!$_POST[db_host]){
    alert('호스트를 입력해 주세요.');
    go('/blank.php');
    exit;
}

if(!$_POST[db_name]){
    alert('데이터베이스 이름을 입력해 주세요.');
    go('/blank.php');
    exit;
}

if(!$_POST[db_id]){
    alert('데이터베이스 아이디를 입력해 주세요.');
    go('/blank.php');
    exit;
}

if(!$_POST[db_pw]){
    alert('데이터베이스 패스워드를 입력해 주세요.');
    go('/blank.php');
    exit;
}



if(!emailCheck($_POST[uid])){
    alert('정상적인 이메일을 입력해 주세요.');
    go('/blank.php');
    exit;
}


if(strlen($_POST[upw])<6){
    alert('최고관리자 패스워드를 6자 이상 입력해 주세요.');
    go('/blank.php');
    exit;
}


if(!$fp = fopen($_SERVER[DOCUMENT_ROOT]."/class/db.php","w")){
    alert('파일 권한 문제로 설치할수 없습니다.\n개발자에게 문의 바랍니다.');
    go('/blank.php');
    exit;
}



//스킨 컴퍼일 폴더 생성
@mkdir('_compile',0777);




fwrite($fp,"<?");
fwrite($fp,"\$dbinfo = array('host'=>'".$_POST[db_host]."','dbid'=>'".$_POST[db_id]."','dbpw'=>'".base64_encode($_POST[db_pw])."','dbnm'=>'".$_POST[db_name]."');");
fwrite($fp,"?>");

fclose($fp);


include_once './class/db.class.php';

$db = new DB();

if($db->connect_error){
    unlink('./class/db.php');
    alert('데이터베이스 정보를 재확인 바랍니다.');
    go('/blank.php');
}




$url = 'http://work6.kr/solution/license';
$post['host'] = $_SERVER['HOST'];
if(!$post['host']) $post['host'] = $_SERVER['HTTP_HOST'];
if(!$post['host']) $post['host'] = $_SERVER['SERVER_NAME'];

$ch = @curl_init();

if($ch){

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, true);  // Tell cURL you want to post something
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Define what you want to post
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the output in string format
	$res = curl_exec ($ch); // Execute

	curl_close ($ch); // Close cURL handle

}




//데이터베이스 테이블 생성
$res = $db->rows("SHOW TABLES LIKE 'w_banner'");
if($res){
	$query[] = "DROP TABLE w_banner;"; 
}

$query[] = "CREATE TABLE IF NOT EXISTS `w_banner` (
  `idx` int(10) NOT NULL auto_increment,
  `skin` varchar(200) default NULL COMMENT 'skin',
  `code` varchar(30) default NULL COMMENT '코드명',
  `img` text COMMENT '파일',
  `alt` text COMMENT '파일설명',
  `href` text COMMENT '링크',
  `target` varchar(30) default 'self' COMMENT '링크타켓',
  PRIMARY KEY  (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='배너/이미지 테이블' AUTO_INCREMENT=14 ;"; 

$query[] = "INSERT INTO `w_banner` (`idx`, `skin`, `code`, `img`, `alt`, `href`, `target`) VALUES
(1, 'basic1', 'mobile', '1500093716_phone.png', 'mobile', '', 'self'),
(2, 'basic1', 'ios', '1500103050_ios.png', 'ios', '', 'self'),
(3, 'basic1', 'android', '1500103137_android.png', 'android', '', 'self'),
(4, 'basic1', 'movie', '1500104564_movie.jpg', 'movie', '', 'self'),
(5, 'basic1', 'map', '1500105650_map.jpg', 'map', '', 'self'),
(6, 'basic1', 'funciton', '1500105977_function.jpg', 'funciton', '', 'self'),
(7, 'basic1', 'workspace', '1500107315_workspace.jpg', 'workspace', '', 'self'),
(8, 'basic1', 'staff1', '1500108135_staff1.jpg', 'staff1', '', 'self'),
(9, 'basic1', 'staff2', '1500108148_staff2.jpg', 'staff2', '', 'self'),
(10, 'basic1', 'staff3', '1500108165_staff3.jpg', 'staff3', '', 'self'),
(11, 'basic1', 'staff4', '1500108181_staff4.jpg', 'staff4', '', 'self'),
(12, 'basic1', 'staff5', '1500108196_staff5.jpg', 'staff5', '', 'self'),
(13, 'basic1', 'staff6', '1500108211_staff6.jpg', 'staff6', '', 'self');"; 




$res = $db->rows("SHOW TABLES LIKE 'w_config'");
if($res){
	$query[] = "DROP TABLE w_config;";
}

$query[] = "CREATE TABLE IF NOT EXISTS `w_config` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL COMMENT '코드명',
  `data` text COMMENT '값',
  PRIMARY KEY  (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='설정테이블' AUTO_INCREMENT=31 ;";

$query[] = "INSERT INTO `w_config` (`idx`, `code`, `data`) VALUES
(1, 'site_name', 'opnepage solution - work6.kr'),
(2, 'site_description', ''),
(3, 'site_email', 'cs@work6.kr'),
(4, 'email_server', 'server'),
(5, 'site_stmp_id', ''),
(6, 'site_stmp_pw', ''),
(11, 'company_name', 'work6'),
(12, 'company_addr', '1123 W Olive Ave Sunnyvale, CA 94086 USA'),
(13, 'company_tel', '070-7557-8612'),
(14, 'company_ceo', 'JOHN'),
(15, 'company_number', '840-05-00397'),
(16, 'site_keywords', ''),
(17, 'google_webmaster_code', ''),
(19, 'site_name_en', ''),
(20, 'security_exception_ip', ''),
(21, 'naver_webmaster_code', ''),
(22, 'company_sales_number', ''),
(23, 'company_webmaster', ''),
(26, 'site_stmp_server', ''),
(27, 'site_stmp_port', ''),
(28, 'sms_id', ''),
(29, 'sms_key', ''),
(30, 'skin', 'basic1');";




$res = $db->rows("SHOW TABLES LIKE 'w_level'");
if($res){
	$query[] = "DROP TABLE w_level;";
}

$query[] = "CREATE TABLE IF NOT EXISTS `w_level` (
  `idx` int(10) NOT NULL auto_increment COMMENT '고유값',
  `name` varchar(30) default NULL COMMENT '회원등급명',
  `admin_permision` varchar(1) default NULL COMMENT '관리자접속혀용여부',
  `admin_menu_block` text COMMENT '관리자접근제한메뉴',
  `level` int(4) default NULL COMMENT '회원레벨',
  `insdt` datetime default NULL COMMENT '가입날짜',
  `moddt` datetime default NULL COMMENT '수정날짜',
  PRIMARY KEY  (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='회원등급' AUTO_INCREMENT=3 ;";

$query[] = "INSERT INTO `w_level` (`idx`, `name`, `admin_permision`, `admin_menu_block`, `level`, `insdt`, `moddt`) VALUES
(1, '최고관리자', 'y', NULL, 9999, NULL, NULL),
(2, '일반회원', NULL, NULL, 1, NULL, NULL);";




$res = $db->rows("SHOW TABLES LIKE 'w_member'");
if($res){
	$query[] = "DROP TABLE w_member;";
}

$query[] = "CREATE TABLE IF NOT EXISTS `w_member` (
  `idx` int(10) NOT NULL auto_increment,
  `uid` varchar(255) default NULL COMMENT '아이디',
  `upw` text COMMENT '패스워드',
  `name` varchar(100) default NULL COMMENT '이름',
  `mobile` varchar(15) default NULL COMMENT '휴대폰번호',
  `level` int(4) default NULL COMMENT '레벨',
  `alarm_email` varchar(1) NOT NULL default 'n' COMMENT '이메일 알람 여부',
  `alarm_sms` varchar(1) NOT NULL default 'n' COMMENT 'sms 알람 여부',
  `insdt` datetime default NULL COMMENT '가입날짜',
  `moddt` datetime default NULL COMMENT '수정날짜',
  `logindt` datetime default NULL COMMENT '최근접속날짜',
  `ip` varchar(45) default NULL COMMENT '최근접속아이피',
  `naver_key` text COMMENT '네이버 access키',
  `memo` varchar(255) NOT NULL COMMENT '메모',
  PRIMARY KEY  (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='회원테이블' AUTO_INCREMENT=2 ;";

$query[] = "insert into w_member set uid='".$_POST['uid']."',upw=password('".$_POST['upw']."'),name='최고관리자',level='9999',insdt=now();";




$res = $db->rows("SHOW TABLES LIKE 'w_popup'");
if($res){
	$query[] = "DROP TABLE w_popup;";
}

$query[] = "CREATE TABLE IF NOT EXISTS `w_popup` (
  `idx` int(10) NOT NULL auto_increment,
  `skin` varchar(200) default NULL COMMENT 'skin',
  `name` varchar(200) default NULL COMMENT '팝업명',
  `img` text COMMENT '팝업이미지',
  `enddt` datetime default NULL COMMENT '자동종료일',
  `start_x` int(4) default NULL COMMENT '팝업시작위치X축',
  `start_y` int(4) default NULL COMMENT '팝업시작위치Y축',
  `href` text COMMENT '링크',
  `target` varchar(30) default 'self' COMMENT '링크타켓',
  `offdt` int(4) default NULL COMMENT '꺼있는시간설정',
  PRIMARY KEY  (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='팝업테이블' AUTO_INCREMENT=2 ;";



foreach($query as $k=>$v){
	if(!$db->query($v)){
		unlink('./class/db.php');
		alert('데이터베이스 설치중 문제가 발생하였습니다.');
		go('/blank.php');
		break;
	}
}



go('./remove.php');


?>
