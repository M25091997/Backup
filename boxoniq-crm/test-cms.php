<?php 

$data = array("key" => "H4lmFvSEIU56i7Hc8u5GpiSpVLnJ8CTxZL6cEPRerjOIj","action"=>'add', "domain"=>'businessleads.org.in', "user"=>'jhgjhguijhgjh', "pass"=>'1234565789', "email"=>'info@jh5alak.com', "package"=>'Basic Plan', "inode"=>'1',"limit_nproc"=>'1',"limit_nofile"=>'1',"server_ips"=>'194.233.71.106');
$url = "https://194.233.71.106:2304/v1/account";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt ($ch, CURLOPT_POST, 1);
$response = curl_exec($ch);
print_r($response);
curl_close($ch);




?>