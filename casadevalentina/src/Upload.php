<?php
namespace CV;

use Aws\S3;

class Upload
{
    private $s3Instance;
    private $bucket;
    private $key;
    private $body;
    private $acl;
    private $options = [];
    private $file;
    public function __construct(S3\S3Client $s3)
    {
        $this->s3Instance = $s3;
        $this->setBucket('cdv-testes');
        $this->setAcl('public-read');
    }

    public function upload($files,$diretorio = null)
    {
        $this->setFile($files);
        $this->setBody(file_get_contents($this->getFile('tmp_name')));
        $name = ($this->hasKey()) ? $this->getKey() : $this->getFile('name');
        if(!is_null($diretorio)){
            return $this->getInstanceS3()->upload($this->getBucket(), $diretorio.'/'.$name, $this->getBody(), $this->getAcl(),$this->getOptions());
        }
        return $this->getInstanceS3()->upload($this->getBucket(), $name, $this->getBody(), $this->getAcl(),$this->getOptions());
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
        if ($acl === null || empty($acl)) {
            throw new \InvalidArgumentException("Act wouldn't null or empty");
        }
        $this->acl = $acl;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        if ($body === null || empty($body)) {
            throw new \InvalidArgumentException("Body wouldn't null or empty");
        }
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
         return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        if ($key === null) {
            throw new \InvalidArgumentException("Key wouldn't null");
        }
        $this->key = $key;
    }

    public function hasKey(){
        $name = $this->getKey();
        return !empty($name);
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
        $isvalidBucket = $this->getInstanceS3()->isValidBucketName($bucket);

        if ($bucket === null || empty($bucket)) {
            throw new \InvalidArgumentException();
        }
        if ($isvalidBucket === false) {
            throw new S3\Exception\InvalidBucketNameException();
        }
        $this->bucket = $bucket;
    }

    public function getInstanceS3()
    {
        return $this->s3Instance;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions(Array $options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getFile($name)
    {
        return $this->file[$name];
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


}
