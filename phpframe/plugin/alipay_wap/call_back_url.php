<?php
session_start();
error_reporting(0);
if($_SESSION["out_ck"]==$_GET['out_trade_no'])
{
echo "请不要重复提交";
exit; 
}
$_SESSION['aliback'] = $_GET;
echo '<script type="text/javascript">location.href="http://sdmb.local/rest/index.php?c=wo&a=wo_kscz&do=cgfh&login_phone='.$_SESSION['user_phone'].'"</script>';

exit;
?>