<?php

namespace Craft;

use Twig_Extension;
use Twig_Function_Method;

class SmartDateTwigExtension extends Twig_Extension
{
	public function getName()
	{
		return 'smartdate';
	}

	public function getFunctions()
	{
		return array(
			'smartDate' => new Twig_Function_Method($this, 'smartDateFunction')
		);
	}

	public function smartDateFunction($startDate, $endDate = null)
	{
		$startFormat = '';
		$endFormat = '';
		$dateNeedsYears = ($endDate != null) && ($startDate->year() != $endDate->year());

		if ($endDate !== null)
		{
			if ($startDate->format('j F Y') == $endDate->format('j F Y'))
			{
				$timeSpansMidday = $startDate->format('a') == $endDate->format('a');
				if ($dateNeedsYears)
				{
					$startFormat = $timeSpansMidday ? 'j F Y, g' : 'j F Y, ga';
				}
				else
				{
					$startFormat = $timeSpansMidday ? 'j F, g' : 'j F, ga';
				}
				$endFormat = 'ga';
			}
			else
			{
				if ($dateNeedsYears)
				{
					if ($startDate->year() == $endDate->year())
					{
						$startFormat = 'j F';
					}
					else
					{
						$startFormat = 'j F Y';
					}
					$endFormat = 'j F Y';
				}
				else
				{
					$startFormat = 'j F';
					$endFormat = 'j F';
				}
			}

			return $startDate->format($startFormat) . ' - ' . $endDate->format($endFormat);
		}
		else
		{
			return $startDate->format('j F Y, ga');
		}
	}
}
