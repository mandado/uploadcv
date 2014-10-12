<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 12/10/14
 * Time: 17:02
 */
use Mockery as m;
use Aws\S3;
use Aws\S3\Exception\InvalidBucketNameException;
class UploadTest extends PHPUnit_Framework_TestCase{
    private $s3;

    public function setUp(){
        $this->s3 = S3\S3Client::factory([
            'key' => 'AKIAJEMXF7D3TXQ25ZKA',
            'secret' => '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',
        ]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShoudBeBucketNotNull(){
        $upload = new \CV\Upload($this->s3);
        $upload->setBucket(null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShoudBeBucketNotEmpty(){
        $upload = new \CV\Upload($this->s3);
        $upload->setBucket('');
    }

    /**
     * @expectedException Aws\S3\Exception\InvalidBucketNameException
     */
    public function testShouldBeBucketNotValid(){
        $upload = new \CV\Upload($this->s3);
        $upload->setBucket('áéíóú*-%"');
    }

    public function testShouldBeBucketValid(){
        $upload = new \CV\Upload($this->s3);
        $upload->setBucket('cdv-testes');
        $bucketValid = $upload->getInstanceS3()->isValidBucketName($upload->getBucket());
        $this->assertTrue($bucketValid);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldBeKeyNotNull(){
        $upload = new \CV\Upload($this->s3);
        $upload->setKey(null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldBeKeyNotEmpty(){
        $upload = new \CV\Upload($this->s3);
        $upload->setKey('');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShoudBeActNotNull(){
        $upload = new \CV\Upload($this->s3);
        $upload->setAcl(null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldBeAclNotEmpty(){
        $upload = new \CV\Upload($this->s3);
        $upload->setAcl('');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldBeBodyNotNull(){
        $upload = new \CV\Upload($this->s3);
        $upload->setBody(null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldBeBodyNotEmpty(){
        $upload = new \CV\Upload($this->s3);
        $upload->setBody('');
    }


    public function testShouldBeUploadSuccess(){
        $Mockedfile = m::mock('File');
        $Mockedfile->shouldReceive('getContents')->once()->andReturn('Hello World');
        $FileContents = $Mockedfile->getContents();

        $MockedUpload = m::mock('\CV\Upload');
        $MockedUpload->shouldReceive('upload')->once()->andReturn([
            'ObjectURL' => 'https://cdv-testes.s3.amazonaws.com/text.txt'
        ]);

        $upload = new \CV\Upload($this->s3);
        $upload->setBucket('cdv-testes');
        $upload->setKey('text.txt');
        $upload->setAcl('public-read');
        $upload->setBody($FileContents);
        $response = $MockedUpload->upload();
        $this->assertNotEmpty($response);
    }

    public function testShouldBeUploadSuccessAndObjectURLValid(){
        $Mockedfile = m::mock('File');
        $Mockedfile->shouldReceive('getContents')->once()->andReturn('Hello World');
        $FileContents = $Mockedfile->getContents();

        $MockedUpload = m::mock('\CV\Upload');
        $MockedUpload->shouldReceive('upload')->once()->andReturn([
            'ObjectURL' => 'https://cdv-testes.s3.amazonaws.com/text.txt'
        ]);

        $upload = new \CV\Upload($this->s3);
        $upload->setBucket('cdv-testes');
        $upload->setKey('text.txt');
        $upload->setAcl('public-read');
        $upload->setBody($FileContents);
        $response = $MockedUpload->upload();
        $this->assertEquals('https://cdv-testes.s3.amazonaws.com/text.txt',$response['ObjectURL']);
    }

    public function testShouldBeOptionsIsArray(){
        $upload = new \CV\Upload($this->s3);
        $upload->setOptions([]);

        $this->assertTrue(is_array($upload->getOptions()));
    }

    public function tearDown(){
        unset($this->s3);
        m::close();
    }
}