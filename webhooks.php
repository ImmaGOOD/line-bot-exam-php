<?php

// callback.php
require "line-bot-exam-php-master/vendor/autoload.php";
require_once('line-bot-exam-php-master/vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = "PPv2psVIO166J7ouwWrXVHVDBSpJmlajX6E2WIKHw0aXOGnZD1+UFLbXlfk5t9YV56hLZk3JvxIM4GBf7U3jExNolDBVRDk/2kXLsV6Wda5Pj4ecjRoR6vpSJ8Vp7q6KQLBDhEaVyaqtlrkqPJlAMwdB04t89/1O/w1cDnyilFU=";
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            $text = $event['source']['userId'];
            // Get replyToken
            $replyToken = $event['replyToken'];
            // Build message to reply back
            $ss = '';
            if ($event['message']['text'] == 'สวัสดี') {
                $ss = 'สวัสดีจ้า';
            }

            if ($event['message']['text'] == 'ควย') {
                $ss = 'อย่าพูดคำหยาบนะครับ';
            }
            if ($event['message']['text'] == 'ไอดี') {
                $text = $event['source']['userId'];
            }
            $messages = [
                'type' => 'text',
                'text' => $ss
            ];
            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result . "\r\n";
        }
    }
}

function send_ms($id, $m, $img) {

// Parse JSON
    $strAccessToken = "PPv2psVIO166J7ouwWrXVHVDBSpJmlajX6E2WIKHw0aXOGnZD1+UFLbXlfk5t9YV56hLZk3JvxIM4GBf7U3jExNolDBVRDk/2kXLsV6Wda5Pj4ecjRoR6vpSJ8Vp7q6KQLBDhEaVyaqtlrkqPJlAMwdB04t89/1O/w1cDnyilFU=";
// Get POST body content
    $content = file_get_contents('php://input');

    $strUrl = "https://api.line.me/v2/bot/message/push";

    $arrHeader = array();
    $arrHeader[] = "Content-Type: application/json";
    $arrHeader[] = "Authorization: Bearer {$strAccessToken}";

    $arrPostData = array();
    $arrPostData['to'] = $id;
    $i = 0;
    if (!empty($m)) {
        $arrPostData['messages'][$i]['type'] = "text";
        $arrPostData['messages'][$i]['text'] = $m;
        // $arrPostData['messages'][$i]['previewImageUrl'] = "https://www.w3schools.com/w3css/img_lights.jpg";
        $i++;
    }


    $arrPostData['messages'][$i]['type'] = "image";
    $arrPostData['messages'][$i]['originalContentUrl'] = $img;
    $arrPostData['messages'][$i]['previewImageUrl'] = $img;


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);

    echo "OK";
}

//send_ms("Uc0a3582697fe7dd5aa58bb397fe252fe", "มีพัสดุเข้า กรุณาไปรับได้ที่ เคาเตอร์ พร้อมนำคิวอาร์โค้ดที่ได้รับไปแสดง", "http://www.comedu58.com/mtwo/images/material_qr/7qcyv6ratb.png");

//send_ms('Uc0a3582697fe7dd5aa58bb397fe252fe');
