<?php
namespace phlow\library\services\imgix\configurations;

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
        if (!getenv('PHLOW_CDN_DOMAIN')){
            throw new configurationException('imgix', 'PHLOW_CDN_DOMAIN is a required configuration');
        }

        if (!getenv('PHLOW_CDN_KEY')){
            throw new configurationException('imgix', 'PHLOW_CDN_KEY is a required configuration');
        }

        $this->domain = getenv('PHLOW_CDN_DOMAIN');
        $this->key = getenv('PHLOW_CDN_KEY');

        $this->defaultImageHeigth = (!empty(getenv('PHLOW_DEFAULT_IMAGE_HEIGTH'))) ? (int)getenv('PHLOW_DEFAULT_IMAGE_HEIGTH') : 520;
        $this->defaultImageWidth = (!empty(getenv('PHLOW_DEFAULT_IMAGE_WIDTH'))) ? (int)getenv('PHLOW_DEFAULT_IMAGE_WIDTH') : 520;
    }
}