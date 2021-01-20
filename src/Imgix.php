<?php
namespace CarloNicora\Minimalism\Services\Imgix;

use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use Imgix\UrlBuilder;

class Imgix implements ServiceInterface
{
    /** @var UrlBuilder|null */
    private ?UrlBuilder $builder=null;

    /**
     * Imgix constructor.
     * @param string $MINIMALISM_SERVICE_IMGIX_DOMAIN
     * @param string $MINIMALISM_SERVICE_IMGIX_KEY
     * @param int $MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGHT
     * @param int $MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH
     */
    public function __construct(
        private string $MINIMALISM_SERVICE_IMGIX_DOMAIN,
        private string $MINIMALISM_SERVICE_IMGIX_KEY,
        private int $MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGHT=520,
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
     * @param int|null $height
     * @param array $params
     * @return string
     */
    public function generateSignedUrl(
        string $photo,
        int $width=null,
        int $height=null,
        array $params=[]
    ): string
    {
        $params['w'] = $width ?? $this->MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH;
        $params['h'] = $height ?? $this->MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGHT;

        return $this->getBuilder()->createURL($photo, $params);
    }

    /**
     * @param string|null $avatarData
     * @param int|null $width
     * @param int|null $height
     * @param array $params
     * @return string|null
     */
    public function generateAvatar(
        ?string $avatarData,
        ?int $width=null,
        ?int $height=null,
        array $params=[],
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
                    $height,
                    $params,
                );
            }
        }

        return $response;
    }

    /**
     * @return int
     */
    public function getDefaultImageHeight() : int
    {
        return $this->MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGHT;
    }

    /**
     * @return int
     */
    public function getDefaultImageWidth() : int
    {
        return $this->MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH;
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