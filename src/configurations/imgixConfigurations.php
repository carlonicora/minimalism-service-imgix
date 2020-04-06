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
        if (!getenv('IMGIX_DOMAIN')){
            throw new configurationException('imgix', 'IMGIX_DOMAIN is a required configuration');
        }

        if (!getenv('IMGIX_KEY')){
            throw new configurationException('imgix', 'IMGIX_KEY is a required configuration');
        }

        $this->domain = getenv('IMGIX_DOMAIN');
        $this->key = getenv('IMGIX_KEY');

        $this->defaultImageHeigth = (!empty(getenv('IMGIX_DEFAULT_IMAGE_HEIGTH'))) ? (int)getenv('IMGIX_DEFAULT_IMAGE_HEIGTH') : 520;
        $this->defaultImageWidth = (!empty(getenv('IMGIX_DEFAULT_IMAGE_WIDTH'))) ? (int)getenv('IMGIX_DEFAULT_IMAGE_WIDTH') : 520;
    }
}