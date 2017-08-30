<?php
namespace tests;

use Germania\Retailers\RetailerNumberProviderTrait;

class RetailerNumberProviderTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInterceptor()
    {
        $mock = $this->getMockForTrait(RetailerNumberProviderTrait::class);

        $retailer_number = 3;

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('retailer_number', $mock);
        $mock->retailer_number = $retailer_number;

        $this->assertEquals( $retailer_number, $mock->getRetailerNumber());
    }
}
