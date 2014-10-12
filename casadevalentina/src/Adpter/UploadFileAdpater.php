<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 12/10/14
 * Time: 13:32
 */

namespace CV;


class UploadFileAdpater implements UploadFileInterface{
    public function upload()
    {
        echo 'file upload';
    }

    public function deleteFile()
    {
        // TODO: Implement deleteFile() method.
    }

    public function getFileName()
    {
        // TODO: Implement getFileName() method.
    }

    public function getContents()
    {
        echo 'contents';
    }

} 