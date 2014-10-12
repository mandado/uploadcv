<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 12/10/14
 * Time: 01:35
 */
namespace CV;
use Aws\S3;

class UploadS3Adpter implements \CV\UploadS3Interface{
    private $bucket;
    private $name;
    private $s3;
    private $file;
    private $acl;
    private $result;

    public function __construct(S3\S3Client $s3){
        $this->setS3($s3);
    }


    public function upload(){
        $this->result = $this->getS3()->upload($this->getBucket(),$this->getName(),$this->getFile(),$this->getAcl());
    }

    /**
     * @return mixed
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     * @param mixed $acl
     */
    public function setAcl($acl)
    {
        $this->acl = $acl;
    }

    /**
     * @return mixed
     */
    public function getBucket()
    {
        return $this->bucket;
    }

    /**
     * @param mixed $bucket
     */
    public function setBucket($bucket)
    {
        $this->bucket = $bucket;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getS3()
    {
        return $this->s3;
    }

    /**
     * @param mixed $s3
     */
    public function setS3($s3)
    {
        $this->s3 = $s3;
    }

    /**
     * @return mixed
     */
    public function getUrl(){
        return $this->result['ObjectURL'];
    }

}