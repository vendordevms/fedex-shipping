<?php

namespace Vendordevms\FedexShipping;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vendordevms\FedexShipping\Skeleton\SkeletonClass
 */
class FedexShippingFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fedex-shipping';
    }
}
