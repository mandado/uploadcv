<?php
namespace CV;

class Upload implements \CV\UploadInterface{
    private $adapter;

    public function upload(){
        return $this->getAdapter()->upload();
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param mixed $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }


    public function setFile($file)
    {
        // TODO: Implement setFile() method.
    }
}