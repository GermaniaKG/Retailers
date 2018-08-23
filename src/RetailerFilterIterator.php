<?php
namespace Germania\Retailers;

class RetailerFilterIterator extends \FilterIterator
{

    /**
     * @var array
     */
    public $retailer_filter;


    /**
     * @param \Traversable $collection      Collecrtion of RetailerNumberProviderInterface
     * @param array|int    $retailer_filter The Salesman ID to filter for
     */
    public function __construct( \Traversable $collection, $retailer_filter )
    {
        // Allow for getRetailerNumber
        $this->retailer_filter = $retailer_filter instanceOf RetailerNumberProviderInterface
        ? $retailer_filter->getRetailerNumber()
        : $retailer_filter;

        // Cast to array
        if (!is_array($this->retailer_filter)) {
            $this->retailer_filter = array( $this->retailer_filter );
        }

        // Take care of Traversable's two faces,
        // since both IteratorAggregate and Iterator implement Traversable
        parent::__construct( $collection instanceOf \IteratorAggregate ? $collection->getIterator() : $collection );

    }


    public function accept()
    {
        $item = $this->getInnerIterator()->current();

        // Disclose items not implementing RetailerNumberProviderInterface
        if (!$item instanceOf RetailerNumberProviderInterface) {
            return false;
        }

        // Cast to array
        $item_retailer_number = $item->getRetailerNumber();
        if (!is_array($item_retailer_number)) {
            $item_retailer_number = array( $item_retailer_number );
        }

        // Check intersection
        return array_intersect($this->retailer_filter, $item_retailer_number);
    }
}
