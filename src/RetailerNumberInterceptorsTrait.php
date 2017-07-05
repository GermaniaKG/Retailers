<?php
namespace Germania\Retailers;

trait RetailerNumberInterceptorsTrait
{

    use RetailerNumberProviderTrait;

    /**
     * Sets the Retailer number.
     *
     * @return self
     */
    public function setRetailerNumber( $retailer_number )
    {
        $this->retailer_number = $retailer_number;

        return $this;
    }

}
