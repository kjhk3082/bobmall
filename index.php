<?
include "./class/common.class.php";


$tpl->define('tpl', $cfg['skin'].'/main.htm');
$tpl->assign(array('data'=>$data));
$tpl->print_('tpl');

?>
