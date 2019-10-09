<?php


namespace Themosis\ThemosisExtended\VirtualResources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Themosis\Support\Facades\Route;

/**
 * Class AbstractVirtualResource
 * @package Themosis\ThemosisExtended\VirtualResources
 */
abstract class AbstractVirtualResource
{
    /**
     * Virtual Resource endpoint URI.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $virtualResourceBaseUrl;

    /**
     * @var string
     */
    private $virtualResourceEndpointNamespace = 'themosis/virtualresource/v1/';

    /**
     * AbstractVirtualResource constructor.
     * @throws \Exception
     */
    public function __construct() {
        $this->configureEndpoints();
    }

    /**
     * Runs configurations for Virtual Resource endpoint.
     *
     * @return void
     * @throws \Exception
     */
    private function configureEndpoints(): void {
        $this->setEndpoint( $this->virtualResourceEndpointNamespace . $this->getEndpointName() );

        if ( !Route::has( "virtualresource." . $this->getEndpointName() ) ) {
            throw new \Exception( 'Virtual resource route named "virtualresource.' . $this->getEndpointName() . '" does not exist.' );
        };
    }

    /**
     * Returns endpoint name.
     *
     * @return string
     */
    protected function getEndpointName() {
        return strtolower( class_basename( static::class ) );
    }

    /**
     * Setter for Virtual Resource endpoint.
     *
     * @param $endpoint
     * @return void
     */
    protected function setEndpoint( $endpoint ): void {
        $this->endpoint = $endpoint;
    }

    abstract public function getEndpoint();

    abstract public function virtualResourceCallback( Request $request ): JsonResponse;
}