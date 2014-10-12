<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 12/10/14
 * Time: 01:34
 */
namespace CV;
interface UploadFileInterface {
    public function upload();
    public function deleteFile();
    public function getFileName();
    public function getContents();
} 