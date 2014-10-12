<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 12/10/14
 * Time: 01:34
 */
namespace CV;
interface UploadS3Interface {
    const BUCKETACLPUBLIC = 'public-read';
    const BUCKETACLPRIVATE = 'private';

    public function upload();
    public function setFile($file);
}