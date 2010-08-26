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
var_dump($accounts_ini);
var_dump($account_ini);

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

try {
	$conn->connect();
	$conn->processUntil('session_start');
	$conn->presence();
	$conn->message('thansen@one-gear.com', 'This is a test message!');
	$conn->disconnect();
} catch(XMPPHP_Exception $e) {
	die($e->getMessage());
}

?>
