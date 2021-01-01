<?php
namespace CarloNicora\Minimalism\Services\Imgix;

use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use Imgix\UrlBuilder;

class Imgix implements ServiceInterface
{
    /** @var UrlBuilder|null */
    private ?UrlBuilder $builder=null;

    public function __construct(
        private string $MINIMALISM_SERVICE_IMGIX_DOMAIN,
        private string $MINIMALISM_SERVICE_IMGIX_KEY,
        private int $MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH=520,
        private int $MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH=520,
    )
    {
    }

    /**
     * @return UrlBuilder
     */
    private function getBuilder(): UrlBuilder
    {
        if ($this->builder === null) {
            $this->builder = new UrlBuilder(
                $this->MINIMALISM_SERVICE_IMGIX_DOMAIN,
                true,
                $this->MINIMALISM_SERVICE_IMGIX_KEY);
        }

        return $this->builder;
    }

    /**
     * @param string $photo
     * @param int|null $width
     * @param int|null $heigth
     * @param array $params
     * @return string
     */
    public function generateSignedUrl(
        string $photo,
        int $width=null,
        int $heigth=null,
        array $params=[]
    ): string
    {
        $params['w'] = $width ?? $this->MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH;
        $params['h'] = $heigth ?? $this->MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH;

        return $this->getBuilder()->createURL($photo, $params);
    }

    /**
     * @param string|null $avatarData
     * @param int|null $width
     * @param int|null $heigth
     * @return string|null
     */
    public function generateAvatar(
        ?string $avatarData,
        ?int $width=null,
        ?int $heigth=null
    ): ?string
    {
        $response = null;

        if ($avatarData !== null) {
            if (stripos($avatarData, 'http') === 0) {
                $response =  $avatarData;
            } else {
                $response = $this->generateSignedUrl(
                    $avatarData,
                    $width,
                    $heigth
                );
            }
        }

        return $response;
    }

    /**
     *
     */
    public function initialise(): void {}

    /**
     *
     */
    public function destroy(): void {}
}