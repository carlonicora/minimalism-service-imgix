<?php
namespace carlonicora\minimalism\services\imgix\configurations;

use carlonicora\minimalism\core\services\abstracts\abstractServiceConfigurations;
use carlonicora\minimalism\core\services\exceptions\configurationException;

class imgixConfigurations extends abstractServiceConfigurations {
    /** @var string  */
    public string $domain;

    /** @var string  */
    public string $key;

    /** @var int  */
    public int $defaultImageHeigth;

    /** @var int  */
    public int $defaultImageWidth;

    /**
     * imgixConfigurations constructor.
     * @throws configurationException
     */
    public function __construct(){
        if (!getenv('MINIMALISM_SERVICE_IMGIX_DOMAIN')){
            throw new configurationException('imgix', 'MINIMALISM_SERVICE_IMGIX_DOMAIN is a required configuration');
        }

        if (!getenv('MINIMALISM_SERVICE_IMGIX_KEY')){
            throw new configurationException('imgix', 'MINIMALISM_SERVICE_IMGIX_KEY is a required configuration');
        }

        $this->domain = getenv('MINIMALISM_SERVICE_IMGIX_DOMAIN');
        $this->key = getenv('MINIMALISM_SERVICE_IMGIX_KEY');

        $this->defaultImageHeigth = (!empty(getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH'))) ? (int)getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH') : 520;
        $this->defaultImageWidth = (!empty(getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH'))) ? (int)getenv('MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH') : 520;
    }
}