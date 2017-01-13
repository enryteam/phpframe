<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
// APPID (开户邮件中可查看)
define("APP_ID",  "wx65216d75b187f567");
// 商户号 (开户邮件中可查看)
define("MCH_ID",  "1383762902");//1349315801
// 商户支付密钥 (https://pay.weixin.qq.com/index.php/account/api_cert)
define("APP_KEY", "035jjs0127b229adaa852ab9212c3b3d");//2178148f6ff56076329f9a8b64a4cb5a

// get prepay id
$prepay_id = generatePrepayId(APP_ID, MCH_ID);
// re-sign it
$response = array(
    'appid'     => APP_ID,
    'partnerid' => MCH_ID,
    'prepayid'  => $prepay_id,
    'package'   => 'Sign=WXPay',
    'noncestr'  => generateNonce(),
    'timestamp' => time(),
);
$response['sign'] = calculateSign($response, APP_KEY);
// send it to APP
echo json_encode(array('code'=>200,'message'=>'微信验证通过','data'=>$response));
exit;
/**
 * Generate a nonce string
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=4_3
 */
function generateNonce()
{
    return md5(uniqid('', true));
}
/**
 * Get a sign string from array using app key
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=4_3
 */
function calculateSign($arr, $key)
{
    ksort($arr);
    $buff = "";
    foreach ($arr as $k => $v) {
        if ($k != "sign" && $k != "key" && $v != "" && !is_array($v)){
            $buff .= $k . "=" . $v . "&";
        }
    }
    $buff = trim($buff, "&");
    return strtoupper(md5($buff . "&key=" . $key));
}
/**
 * Get xml from array
 */
function getXMLFromArray($arr)
{
    $xml = "<xml>";
    foreach ($arr as $key => $val) {
        if (is_numeric($val)) {
            $xml .= sprintf("<%s>%s</%s>", $key, $val, $key);
        } else {
            $xml .= sprintf("<%s><![CDATA[%s]]></%s>", $key, $val, $key);
        }
    }
    $xml .= "</xml>";
    return $xml;
}
/**
 * Generate a prepay id
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=9_1
 */
function generatePrepayId($app_id, $mch_id)
{
    $params = array(
        'appid'            => $app_id,
        'mch_id'           => $mch_id,
        'nonce_str'        => generateNonce(),
        'body'             => 'Test product name',
        'out_trade_no'     => time(),
        'total_fee'        => 1,
        'spbill_create_ip' => '8.8.8.8',
        'notify_url'       => 'http://jjs.51daniu.cn/rechargeNotify.php',
        'trade_type'       => 'APP',
    );
    // add sign
    $params['sign'] = calculateSign($params, APP_KEY);
    // create xml
    $xml = getXMLFromArray($params);
    // send request
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL            => "https://api.mch.weixin.qq.com/pay/unifiedorder",
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => array('Content-Type: text/xml'),
        CURLOPT_POSTFIELDS     => $xml,
    ));
    $result = curl_exec($ch);
    curl_close($ch);
    // get the prepay id from response
    $xml = simplexml_load_string($result);
    return (string)$xml->prepay_id;
}

// pc_base::load_app_class('RestAction');
//
// class wxpay extends RestAction
// {
// 	public function __construct()
// 	{
//
// 		parent::__construct();
// 	}
//
// 	public function index()
// 	{
// 		returnJson('200');
// 	}
// 	public function config()
// 	{
// 		// get prepay id
// 		$prepay_id = self::generatePrepayId(getgpc('fee'));
// 		// re-sign it
// 		$response = array(
// 		    'appid'     => APP_ID,
// 		    'partnerid' => MCH_ID,
// 		    'prepayid'  => $prepay_id,
// 		    'package'   => 'Sign=WXPay',
// 		    'noncestr'  => self::generateNonce(),
// 		    'timestamp' => time(),
// 				'signtrue'  => $_SESSION['signtrue'],
// 		);
//
// 		// send it to APP
// 		returnJson('200','请求成功',$response);
//
// 	}
// 	static function generateNonce()
// 	{
//
// 	    return md5(uniqid('', true));
// 	}
// 	static function calculateSign($arr, $key)
// 	{
// 	    ksort($arr);
// 	    $buff = "";
// 	    foreach ($arr as $k => $v) {
// 	        if ($k != "sign" && $k != "key" && $v != "" && !is_array($v)){
// 	            $buff .= $k . "=" . $v . "&";
// 	        }
// 	    }
// 	    $buff = trim($buff, "&");
// 	    return strtoupper(md5($buff . "&key=" . $key));
// 	}
// 	/**
// 	 * Get xml from array
// 	 */
// 	static function getXMLFromArray($arr)
// 	{
// 	    $xml = "<xml>";
// 	    foreach ($arr as $key => $val) {
// 	        if (is_numeric($val)) {
// 	            $xml .= sprintf("<%s>%s</%s>", $key, $val, $key);
// 	        } else {
// 	            $xml .= sprintf("<%s><![CDATA[%s]]></%s>", $key, $val, $key);
// 	        }
// 	    }
// 	    $xml .= "</xml>";
// 	    return $xml;
// 	}
//
// 	static function generatePrepayId($fee)
// 	{
// 			//$fee = getgpc('fee');
// 			if(empty($fee)||intval($fee)==0)
// 			{
// 				$fee = 1;
// 			}
// 	    $params = array(
// 	        'appid'            => APP_ID,
// 	        'mch_id'           => MCH_ID,
// 	        'nonce_str'        => self::generateNonce(),
// 	        'body'             => '积交所金币充值',
// 	        'out_trade_no'     => time(),
// 	        'total_fee'        => $fee,
// 	        'spbill_create_ip' => '8.8.8.8',
// 	        'notify_url'       => 'http://jjs.51daniu.cn/rechargeNotify.php',
// 	        'trade_type'       => 'APP',
// 	    );
//
// 	    // add sign
// 	    $params['sign'] = self::calculateSign($params, APP_KEY);
//
// 			$_SESSION['signtrue'] = $params['sign'];
// 	    // create xml
// 	    $xml = self::getXMLFromArray($params);
// 	    // send request
// 	    $ch = curl_init();
// 			curl_setopt($ch, CURLOPT_URL, "https://api.mch.weixin.qq.com/pay/unifiedorder");
// 			curl_setopt($ch, CURLOPT_POST,1);
// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
// 			curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/xml'));
// 			curl_setopt($ch, CURLOPT_POSTFIELDS,$xml);
//
//
// 	    echo $result = curl_exec($ch);
// 	    curl_close($ch);
// 	    // get the prepay id from response
// 	    $xml = simplexml_load_string($result);
// 	    return (string)$xml->prepay_id;
// 	}
//
// }
