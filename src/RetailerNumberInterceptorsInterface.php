<?php
namespace Germania\Retailers;

interface RetailerNumberInterceptorsInterface extends RetailerNumberProviderInterface
{

    /**
     * Sets the Retailer number.
     *
     * @param  int|string $retailer_number
     * @return self
     */
    public function setRetailerNumber( $retailer_number );

}
