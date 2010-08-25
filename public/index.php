<?php

require_once(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'bootstrap.php');

include 'XMPPHP/XMPP.php';

#Use XMPPHP_Log::LEVEL_VERBOSE to get more logging for error reports
#If this doesn't work, are you running 64-bit PHP with < 5.2.6?
$conn = new XMPPHP_XMPP('yack.hivalley.com', 5222, 'username', 'secret', 'xmpphp', null, $printlog=false, $loglevel=XMPPHP_Log::LEVEL_INFO);

try {
	$conn->connect();
	$conn->processUntil('session_start');
	$conn->presence();
	$conn->message('otheruser@yack.hivalley.com', 'This is a test message!');
	$conn->disconnect();
} catch(XMPPHP_Exception $e) {
	die($e->getMessage());
}

?>
