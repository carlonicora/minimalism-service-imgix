<?php
namespace CarloNicora\Minimalism\Services\Imgix\Tests\Unit;

use CarloNicora\Minimalism\Services\Imgix\Imgix;
use CarloNicora\Minimalism\Services\Imgix\Tests\Abstracts\AbstractTestCase;

class ImgixTest extends AbstractTestCase
{
    /** @var Imgix|null  */
    private ?Imgix $imgix=null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->imgix = new Imgix($this->getImgixConfigurations(), $this->getServices());
    }

    public function testGenerateSignedUrlCorrectly() : void
    {
        $this->setBuilder($this->imgix);

        $this->assertEquals('photo', $this->imgix->generateSignedUrl(''));
    }

    public function testGenerateSignedUrlCorrectlyPassingDetails() : void
    {
        $this->setBuilder($this->imgix);

        $this->assertEquals('photo', $this->imgix->generateSignedUrl('', 10, 10));
    }

    public function testGenerateAvatar() : void
    {
        $this->setBuilder($this->imgix);

        $this->assertEquals('photo', $this->imgix->generateAvatar(''));
    }

    public function testReuseAvatar() : void
    {
        $this->setBuilder($this->imgix);

        $this->assertEquals('http://me', $this->imgix->generateAvatar('http://me'));
    }
}