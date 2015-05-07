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

	public function smartDateFunction($startDate, $endDate = null, $now = new DateTime())
	{
		$dateNeedsYears = ($endDate != null && $startDate->format('Y') != $endDate->format('Y')) || ($startDate->format('Y') != $now->format('Y'));
		$startFormat = '';
		$endFormat = '';
		$startDateFormat = ($startDate->format('i') == '00' ? 'g' : 'g:i');
		$endDateFormat = ($endDate->format('i') == '00' ? 'g' : 'g:i');

		if ($endDate !== null)
		{
			if ($startDate->format('j F Y') == $endDate->format('j F Y'))
			{
				$timeSpansMidday = $startDate->format('a') == $endDate->format('a');
				if ($dateNeedsYears)
				{
					$startFormat = $timeSpansMidday ? 'j F Y, '.$startDateFormat : 'j F Y, '.$startDateFormat.'a';
				}
				else
				{
					$startFormat = $timeSpansMidday ? 'j F, '.$startDateFormat : 'j F, '.$startDateFormat.'a';
				}
				$endFormat = $endDateFormat.'a';
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
			$startFormat = $dateNeedsYears ? 'j F Y, '.$startDateFormat.'a' : 'j F, '.$startDateFormat.'a';
			return $startDate->format($startFormat);
		}
	}
}