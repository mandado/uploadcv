<?php
error_reporting(E_ALL);
define('ROOT_DIR',__DIR__);
ini_set('display_errors',1);
require 'vendor/autoload.php';

use Aws\S3\S3Client;
$client = S3Client::factory([
    'key' => 'AKIAJEMXF7D3TXQ25ZKA',
    'secret' => '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',
]);
$res = null;
if($_POST['enviar']){
    $files = $_FILES['teste'];
    $upload = new \CV\Upload($client);
    $res = $upload->upload($files,'meudiretorio/');
}

$iterator = $client->getIterator('ListObjects', array(
    'Bucket' => 'cdv-testes'
));

foreach ($iterator as $object) {
    echo $object['Key'] . "\n";
}

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