<?php
error_reporting(E_ALL);
define('ROOT_DIR',__DIR__);
ini_set('display_errors',1);
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Guzzle\Http\EntityBody;
$client = S3Client::factory([
    'key' => 'AKIAJEMXF7D3TXQ25ZKA',
    'secret' => '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',
]);
$res = null;
if($_POST['enviar']){
    $files = $_FILES['teste'];
    $upload = new \CV\Upload($client);
    $upload->setBucket('cdv-testes');
    $upload->setKey($files['name']);
    $upload->setAcl('public-read');
    $upload->setBody(file_get_contents($files['tmp_name']));
    $res = $upload->upload();
}

$client->clearBucket('cdv-testes');
?>

<form action="" enctype="multipart/form-data" method="post">
    <input type="file" name="teste"/>
    <input type="submit" name="enviar" value="ok"/>
    <?php
        if($res != null) {
    ?>
     <img src="<?=$res->get('ObjectURL') ?>" alt=""/>
    <?php
        }
    ?>
</form>