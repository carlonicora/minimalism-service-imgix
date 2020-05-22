<?php
namespace CarloNicora\Minimalism\Services\Imgix\Factories;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceFactory;
use CarloNicora\Minimalism\Core\Services\Exceptions\ConfigurationException;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Services\Imgix\Configurations\ImgixConfigurations;
use CarloNicora\Minimalism\Services\Imgix\Imgix;

class ServiceFactory extends AbstractServiceFactory {
    /**
     * serviceFactory constructor.
     * @param ServicesFactory $services
     * @throws ConfigurationException
     */
    public function __construct(ServicesFactory $services)
    {
        $this->configData = new ImgixConfigurations();

        parent::__construct($services);
    }

    /**
     * @param ServicesFactory $services
     * @return mixed|void
     */
    public function create(ServicesFactory $services)
    {
        return new Imgix($this->configData, $services);
    }
}