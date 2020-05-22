<?php
namespace CarloNicora\Minimalism\Services\Imgix\Tests\Unit\Configurations;

use CarloNicora\Minimalism\Services\Imgix\Configurations\ImgixConfigurations;
use CarloNicora\Minimalism\Services\Imgix\Tests\Abstracts\AbstractTestCase;

class ImgixConfigurationsTest extends AbstractTestCase
{

    public function testUnconfiguredConfiguration() : void
    {
        $this->expectExceptionCode(500);

        new ImgixConfigurations();
    }

    public function testIncompleteConfigurationHost() : void
    {
        $this->expectExceptionCode(500);

        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        new ImgixConfigurations();
    }

    public function testConfiguredConfigurationDomain() : void
    {
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_KEY', 'key');
        $config = new ImgixConfigurations();

        $this->assertEquals('domain', $config->getDomain());
    }

    public function testConfiguredConfigurationKey() : void
    {
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_KEY', 'key');
        $config = new ImgixConfigurations();

        $this->assertEquals('key', $config->getKey());
    }

    public function testConfiguredConfigurationDefaultImageHeight() : void
    {
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_KEY', 'key');
        $config = new ImgixConfigurations();

        $this->assertEquals(520, $config->getDefaultImageHeigth());
    }

    public function testConfiguredConfigurationDefaultImageWidth() : void
    {
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_KEY', 'key');
        $config = new ImgixConfigurations();

        $this->assertEquals(520, $config->getDefaultImageWidth());
    }

    public function testConfiguredConfigurationImageHeight() : void
    {
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_KEY', 'key');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH', 128);
        $config = new ImgixConfigurations();

        $this->assertEquals(128, $config->getDefaultImageHeigth());
    }

    public function testConfiguredConfigurationImageWidth() : void
    {
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_KEY', 'key');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH', 128);
        $config = new ImgixConfigurations();

        $this->assertEquals(128, $config->getDefaultImageWidth());
    }
}