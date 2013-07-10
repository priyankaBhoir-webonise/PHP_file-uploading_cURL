<?php
		$data = array('name' => $_FILES['upload']['name'], 'file' => '@'.$_FILES['upload']['tmp_name'],'type' =>$_FILES['upload']['type']);
		$mycurl = curl_init();
		curl_setopt($mycurl,CURLOPT_URL,"http://localhost/assignment_5_b/upload_curl.php");
		curl_setopt($mycurl,CURLOPT_POST,1);
		curl_setopt($mycurl,CURLOPT_HEADER,1);
		curl_setopt($mycurl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($mycurl,CURLOPT_RETURNTRANSFER,0);
		$abc=curl_exec($mycurl);
?>
