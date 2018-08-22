<?php
namespace Germania\Retailers;

trait RetailerNumberAwareTrait
{

    use RetailerNumberProviderTrait;

    /**
     * Sets the Retailer number.
     *
     * @return self
     */
    public function setRetailerNumber( $retailer )
    {
        if ($retailer instanceOf RetailerNumberProviderInterface):
            $this->retailer_number = $retailer->getRetailerNumber();
        else:
            $this->retailer_number = $retailer;
        endif;

        return $this;
    }

}
