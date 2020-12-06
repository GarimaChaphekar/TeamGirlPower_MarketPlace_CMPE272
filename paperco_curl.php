<?php
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://vandanachandola.online/top5.php');
	curl_exec ($ch);
	curl_close($ch);
?>