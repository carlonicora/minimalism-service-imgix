<?php
namespace phlow\library\services\imgix;

use carlonicora\minimalism\core\services\abstracts\abstractService;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use carlonicora\minimalism\core\services\interfaces\serviceConfigurationsInterface;
use Imgix\UrlBuilder;
use phlow\library\services\imgix\configurations\imgixConfigurations;

class imgix extends abstractService {
    /** @var imgixConfigurations  */
    private imgixConfigurations $configData;

    /** @var UrlBuilder */
    private UrlBuilder $builder;

    /**
     * abstractApiCaller constructor.
     * @param serviceConfigurationsInterface $configData
     * @param servicesFactory $services
     */
    public function __construct(serviceConfigurationsInterface $configData, servicesFactory $services) {
        parent::__construct($configData, $services);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configData = $configData;
    }

    private function builder(): UrlBuilder {
        if ($this->builder === null) {
            $this->builder = new UrlBuilder($this->configData->domain, true, $this->configData->key);
        }

        return $this->builder;
    }

    /**
     * @param string $photo
     * @param int|null $width
     * @param int|null $heigth
     * @return string
     */
    public function generateSignedUrl(string $photo, int $width=null, int $heigth=null): string {
        $params = [];

        if ($width !== null){
            $params['w'] = $width;
        }

        if ($heigth !== null){
            $params['h'] = $heigth;
        }

        return $this->builder()->createURL($photo, $params);
    }

    /**
     * @param string|null $avatarData
     * @param int $width
     * @param int $heigth
     * @return string|null
     */
    public function generateAvatar(?string $avatarData, int $width=280, int $heigth=280): ?string {
        $response = null;

        if ($avatarData !== null) {
            if (stripos($avatarData, 'http') === 0) {
                $response =  $avatarData;
            } else {
                $response = $this->generateSignedUrl($avatarData, $width, $heigth);
            }
        }

        return $response;
    }

    /**
     * @return int
     */
    public function getDefaultImageHeigth() : int {
        return $this->configData->defaultImageHeigth;
    }

    /**
     * @return int
     */
    public function getDefaultImageWidth() : int {
        return $this->configData->defaultImageWidth;
    }
}