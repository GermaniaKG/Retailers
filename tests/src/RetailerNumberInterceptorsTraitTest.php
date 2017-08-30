<?php
namespace tests;

use Germania\Retailers\RetailerNumberInterceptorsTrait;
use Germania\Retailers\RetailerNumberProviderInterface;

class RetailerNumberInterceptorsTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterAndSetter()
    {
        $mock = $this->getMockForTrait(RetailerNumberInterceptorsTrait::class);

        $retailer_number = 3;

        // Make sure we are really changing the number here
        $this->assertNotEquals( $retailer_number, $mock->getRetailerNumber());

        $mock->setRetailerNumber($retailer_number);
        $this->assertEquals( $retailer_number, $mock->getRetailerNumber());
    }

    public function testSetterWithRetailerNumberProviderInterface()
    {
        $mock = $this->getMockForTrait(RetailerNumberInterceptorsTrait::class);

        // Make sure we are really changing the number here
        $retailer_number = 3;
        $this->assertNotEquals( $retailer_number, $mock->getRetailerNumber());

        $provider = $this->prophesize( RetailerNumberProviderInterface::class );
        $provider->getRetailerNumber()->willReturn( $retailer_number );
        $mock->setRetailerNumber( $provider->reveal() );

        $this->assertEquals( $retailer_number, $mock->getRetailerNumber());
    }
}
