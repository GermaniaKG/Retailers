<?php
namespace Germania\Retailers;

trait RetailerNumberProviderTrait
{

    /**
     * @var string|int
     */
    public $retailer_number;


    /**
     * Gets the Retailer number.
     *
     * @return string|int
     */
    public function getRetailerNumber()
    {
        return $this->retailer_number;
    }

}
