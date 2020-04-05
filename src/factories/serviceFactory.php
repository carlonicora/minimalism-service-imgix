<?php
namespace carlonicora\minimalism\services\imgix\factories;

use carlonicora\minimalism\core\services\abstracts\abstractServiceFactory;
use carlonicora\minimalism\core\services\exceptions\configurationException;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use carlonicora\minimalism\services\imgix\configurations\imgixConfigurations;
use carlonicora\minimalism\services\imgix\imgix;

class serviceFactory extends abstractServiceFactory {
    /**
     * serviceFactory constructor.
     * @param servicesFactory $services
     * @throws configurationException
     */
    public function __construct(servicesFactory $services) {
        $this->configData = new imgixConfigurations();

        parent::__construct($services);
    }

    /**
     * @param servicesFactory $services
     * @return mixed|void
     */
    public function create(servicesFactory $services){
        return new imgix($this->configData, $services);
    }
}