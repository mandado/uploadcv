<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 12/10/14
 * Time: 00:52
 */
namespace CV;
interface UploadInterface {
    public function upload();
    public function setFile($file);
}