<?php

require_once(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'bootstrap.php');

$from = urldecode($_GET['from']);
$to = urldecode($_GET['to']);
$text = urldecode($_GET['text']);

$message = $from . "," . $to . "," . $text;

write_log($message);
//$filename
$accounts_ini = parse_ini_file(CONFIG_DIR . DIRECTORY_SEPARATOR . 'accounts.ini', true);
$account_ini = $accounts_ini[$from];

$config_ini = parse_ini_file(CONFIG_DIR . DIRECTORY_SEPARATOR . 'config.ini', true);

//var_dump($accounts_ini);
//var_dump($account_ini);

//Get all account info
$jid = $account_ini['jid'];
list($username, $server) = explode('@', $jid);
$password = $account_ini['password'];
//default to jid server
if(!empty($account_ini['server'])){
	$server = $account_ini['server'];
}
$host = $account_ini['host'];
$port = $account_ini['port'];
$resource = $account_ini['resource'];

include 'XMPPHP/XMPP.php';
#Use XMPPHP_Log::LEVEL_VERBOSE to get more logging for error reports
#If this doesn't work, are you running 64-bit PHP with < 5.2.6?
$conn = new XMPPHP_XMPP($host, $port, $username, $password, $resource, $server, $printlog=false, $loglevel=XMPPHP_Log::LEVEL_INFO);

$to_jids = $config_ini['debug']['to_jid'];

//var_dump($to_jids);

try {
	$conn->connect();
	$conn->processUntil('session_start');
	$conn->presence();
	foreach($to_jids as $jid){
		$conn->message($jid, $text);
	}
	$conn->disconnect();
	echo "ok";
} catch(XMPPHP_Exception $e) {
	die($e->getMessage());
}

?>
