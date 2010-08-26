<?php

function write_log($message, $level = null){
	$data = time() . " " . $message;
	file_put_contents(LOG_DIR . DIRECTORY_SEPARATOR . 'application.log', $data . "\n", FILE_APPEND);
}

//For PHP 5.2 compatability
if(!function_exists('parse_ini_string')){
	function parse_ini_string($ini, $process_sections = false, $scanner_mode = null){
		# Generate a temporary file.
		$tempname = tempnam(sys_get_temp_dir(), 'ini');
		$fp = fopen($tempname, 'w');
		fwrite($fp, $ini);
		$ini = parse_ini_file($tempname, !empty($process_sections));
		fclose($fp);
		@unlink($tempname);
		return $ini;
	}
}