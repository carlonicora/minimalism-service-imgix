<?php
namespace CarloNicora\Minimalism\Services\Imgix\Configurations;

use CarloNicora\Minimalism\Core\Events\MinimalismErrorEvents;
use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceConfigurations;
use Exception;

class ImgixConfigurations extends AbstractServiceConfigurations {
    /** @var string  */
    private string $domain;

    /** @var string  */
    private string $key;

    /** @var int  */
    private int $defaultImageHeigth;

    /** @var int  */
    private int $defaultImageWidth;

    /**
     * imgixConfigurations constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if (!($this->domain = getenv('MINIMALISM_SERVICE_IMGIX_DOMAIN'))){
            MinimalismErrorEvents::CONFIGURATION_ERROR('MINIMALISM_SERVICE_IMGIX_DOMAIN (incorrect)')->throw();
        }

        if (!($this->key = getenv('MINIMALISM_SERVICE_IMGIX_KEY'))){
            MinimalismErrorEvents::CONFIGURATION_ERROR('MINIMALISM_SERVICE_IMGIX_KEY (incorrect)')->throw();
        }

        $this->defaultImageHeigth = (!empty(getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH'))) ? (int)getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH') : 520;
        $this->defaultImageWidth = (!empty(getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH'))) ? (int)getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH') : 520;
    }

    /**
     * @return int
     */
    public function getDefaultImageHeigth(): int
    {
        return $this->defaultImageHeigth;
    }

    /**
     * @return int
     */
    public function getDefaultImageWidth(): int
    {
        return $this->defaultImageWidth;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}