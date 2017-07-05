<?php
namespace tests;

use Germania\Retailers\RetailerFilterIterator;
use Germania\Retailers\RetailerNumberProviderInterface;


class RetailerFilterIteratorTest extends \PHPUnit_Framework_TestCase
{

    public $collection;

    public function setUp()
    {
        $provider1 = $this->prophesize( RetailerNumberProviderInterface::class );
        $provider1->getRetailerNumber()->willReturn( 1 );

        $provider2 = $this->prophesize( RetailerNumberProviderInterface::class );
        $provider2->getRetailerNumber()->willReturn( 2 );

        $provider3 = $this->prophesize( RetailerNumberProviderInterface::class );
        $provider3->getRetailerNumber()->willReturn( array(2, "3") );

        $this->collection = new \ArrayIterator([
            $provider1->reveal(),
            $provider2->reveal(),
            $provider3->reveal()
        ]);
    }



    /**
     * @dataProvider provideFilterValuesAndResults
     */
    public function testValuesAndResultCount( $filter_value, $result_count )
    {
        $sut = new RetailerFilterIterator($this->collection, $filter_value);

        $this->assertEquals($result_count, iterator_count($sut));
    }



    public function provideFilterValuesAndResults()
    {

        $parameter_sets = array();
        return array(
            // filter for     // expected result
            [ 1,              1 ],
            [ 2,              2 ],
            [ "2",            2 ],
            [ array(2,"3"),   2 ],
            [ array("2",3),   2 ],
            [ array(3),       1 ],
            [ array("3"),     1 ],


            [ 99,             0 ],
            [ "24",           0 ],
            [ 32.0,           0 ],
            [ 0,              0 ],
            [ array(),        0 ],
            [ array(0),       0 ],
            [ array(66,55),   0 ],
            [ null,           0 ],
        );

    }

}
