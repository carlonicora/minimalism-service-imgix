<?php
namespace CarloNicora\Minimalism\Services\Imgix\Tests\Unit\Factories;

use CarloNicora\Minimalism\Services\Imgix\Configurations\ImgixConfigurations;
use CarloNicora\Minimalism\Services\Imgix\Factories\ServiceFactory;
use CarloNicora\Minimalism\Services\Imgix\Imgix;
use CarloNicora\Minimalism\Services\Imgix\Tests\Abstracts\AbstractTestCase;

class ServiceFactoryTest extends AbstractTestCase
{
    /**
     * @return ServiceFactory
     */
    public function testServiceInitialisation() : ServiceFactory
    {
        $response = new ServiceFactory($this->getServices());

        $this->assertEquals(1,1);

        return $response;
    }

    /**
     * @param ServiceFactory $service
     * @depends testServiceInitialisation
     */
    public function testServiceCreation(ServiceFactory $service) : void
    {
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_DOMAIN', 'domain');
        $this->setEnv('MINIMALISM_SERVICE_IMGIX_KEY', 'key');
        $config = new ImgixConfigurations();
        $services = $this->getServices();
        $rabbitmq = new Imgix($config, $services);

        $this->assertEquals($rabbitmq, $service->create($services));
    }
}