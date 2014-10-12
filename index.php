<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'vendor/autoload.php';

use Aws\S3\S3Client;

$client = S3Client::factory([
    'key' => 'AKIAJEMXF7D3TXQ25ZKA',
    'secret' => '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',
]);
$arch = file_get_contents('testeuploadarquivo.txt');
//$up = $client->upload('cdv-testes', 'textupload.txt', $arch, 'public-read');
//var_dump($up);
//$iterator = $client->getIterator('ListObjects', array(
//    'Bucket' => 'cdv-testes'
//));

//foreach ($iterator as $object) {
//    echo $object['Key'] . "\n";
//}
//
//var_dump($client->getObjectUrl('cdv-testes', 'textupload.txt'));

$upload = new \CV\Upload();
$upload->setAdapter(new \CV\UploadFileAdpater());
$upload->getAdapter()->setBucket('cdv-testes');
$upload->getAdapter()->setName('cdv-testes.txt');
$upload->getAdapter()->setFile($arch);
$upload->getAdapter()->setAcl('public-read');
$upload->upload();
echo $upload->getAdapter()->getUrl();