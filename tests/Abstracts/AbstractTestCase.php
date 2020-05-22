<?php
namespace CarloNicora\Minimalism\Services\Imgix\Tests\Abstracts;

use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Services\Imgix\Configurations\ImgixConfigurations;
use CarloNicora\Minimalism\Services\Imgix\Imgix;
use Imgix\UrlBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @return ServicesFactory
     */
    protected function getServices() : ServicesFactory
    {
        return new ServicesFactory();
    }

    /**
     * @param string $name
     * @param string $value
     */
    protected function setEnv(string $name, string $value) : void
    {
        putenv($name.'='.$value);
    }

    /**
     * @param $object
     * @param $parameterName
     * @return mixed|null
     */
    protected function getProperty($object, $parameterName)
    {
        try {
            $reflection = new ReflectionClass(get_class($object));
            $property = $reflection->getProperty($parameterName);
            $property->setAccessible(true);
            return $property->getValue($object);
        } catch (ReflectionException $e) {
            return null;
        }
    }

    /**
     * @param $object
     * @param $parameterName
     * @param $parameterValue
     */
    protected function setProperty($object, $parameterName, $parameterValue): void
    {
        try {
            $reflection = new ReflectionClass(get_class($object));
            $property = $reflection->getProperty($parameterName);
            $property->setAccessible(true);
            $property->setValue($object, $parameterValue);
        } catch (ReflectionException $e) {
        }
    }

    /**
     * @return ImgixConfigurations|MockObject
     */
    protected function getImgixConfigurations() : ImgixConfigurations
    {
        /** @var MockObject|ImgixConfigurations $response */
        $response = $this->getMockBuilder(ImgixConfigurations::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response->method('getDomain')
            ->willReturn('domain');

        $response->method('getKey')
            ->willReturn('key');

        $response->method('getDefaultImageHeigth')
            ->willReturn(123);

        $response->method('getDefaultImageWidth')
            ->willReturn(123);

        return $response;
    }

    protected function setBuilder(Imgix $imgix) : void
    {
        $builder = $this->getMockBuilder(UrlBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $builder->method('createURL')
            ->willReturn('photo');

        $this->setProperty($imgix, 'builder', $builder);
    }
}