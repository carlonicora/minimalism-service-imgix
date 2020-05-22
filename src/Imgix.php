<?php
namespace CarloNicora\Minimalism\Services\Imgix;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractService;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Core\Services\Interfaces\ServiceConfigurationsInterface;
use Imgix\UrlBuilder;
use CarloNicora\Minimalism\Services\Imgix\Configurations\ImgixConfigurations;

class Imgix extends abstractService {
    /** @var ImgixConfigurations  */
    private ImgixConfigurations $configData;

    /** @var UrlBuilder|null */
    private ?UrlBuilder $builder=null;

    /**
     * abstractApiCaller constructor.
     * @param ServiceConfigurationsInterface $configData
     * @param ServicesFactory $services
     */
    public function __construct(ServiceConfigurationsInterface $configData, ServicesFactory $services)
    {
        parent::__construct($configData, $services);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configData = $configData;
    }

    /**
     * @return UrlBuilder
     */
    private function getBuilder(): UrlBuilder
    {
        if ($this->builder === null) {
            $this->builder = new UrlBuilder($this->configData->getDomain(), true, $this->configData->getKey());
        }

        return $this->builder;
    }

    /**
     * @param string $photo
     * @param int|null $width
     * @param int|null $heigth
     * @return string
     */
    public function generateSignedUrl(string $photo, int $width=null, int $heigth=null): string
    {
        $params = [];

        $params['w'] = $width ?? $this->getDefaultImageWidth();
        $params['h'] = $heigth ?? $this->getDefaultImageHeigth();

        return $this->getBuilder()->createURL($photo, $params);
    }

    /**
     * @param string|null $avatarData
     * @param int $width
     * @param int $heigth
     * @return string|null
     */
    public function generateAvatar(?string $avatarData, ?int $width=null, ?int $heigth=null): ?string
    {
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
    public function getDefaultImageHeigth() : int
    {
        return $this->configData->getDefaultImageHeigth();
    }

    /**
     * @return int
     */
    public function getDefaultImageWidth() : int
    {
        return $this->configData->getDefaultImageWidth();
    }
}