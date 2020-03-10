<?php
require __DIR__.'/../vendor/autoload.php';

$client     = new GuzzleHttp\Client();
$file       = fopen("../img/sample.png", 'r');
$upload     = $client->request('POST', 'https://telegra.ph/upload', 
    [
        'multipart' => [
            [
                'name'     => 'file',
                'filename' => 'blob',
                'contents' => $file
            ]
        ]
    ]);
    
$response   = $upload->getBody()->getContents();
$json       = json_decode($response);

if(!empty($json[0]->src)){
    echo "uploaded successfully <br>";
    echo "Image url : https://telegra.ph" . $json[0]->src;
} else {
    echo "upload failed";
}