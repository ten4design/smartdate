<?php

namespace Craft;

craft()->templates->registerTwigAutoloader();

class SmartDateTwigExtensionTest extends BaseTest
{
	public function setUp()
	{
		$this->extension = new CocktailRecipesTwigExtension();
	}

	public function testSameYear() {
		$result = $this->extension->smartDateFunction($startDate, $endDate = null, $now = new DateTime());
		$this->assertSame();
	}

	public function testDiffYear() {}

	public function testNow() {}
}