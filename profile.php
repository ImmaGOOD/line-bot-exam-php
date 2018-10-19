<?php


$access_token = 'PPv2psVIO166J7ouwWrXVHVDBSpJmlajX6E2WIKHw0aXOGnZD1+UFLbXlfk5t9YV56hLZk3JvxIM4GBf7U3jExNolDBVRDk/2kXLsV6Wda5Pj4ecjRoR6vpSJ8Vp7q6KQLBDhEaVyaqtlrkqPJlAMwdB04t89/1O/w1cDnyilFU=
';

$userId = 'Uc0a3582697fe7dd5aa58bb397fe252fe';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

