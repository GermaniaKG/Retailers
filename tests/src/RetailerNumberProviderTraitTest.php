<?php
namespace tests;

use Germania\Retailers\RetailerNumberProviderTrait;
use PHPUnit\Framework\TestCase;

class RetailerNumberProviderTraitTest extends TestCase
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
