<?php

namespace modules\SmartDate;

use Craft;
use DateTime;
use Twig\TwigFunction;

class SmartDateModule extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $twig = Craft::$app->view->getTwig();
        $twig->addFunction(new TwigFunction('smartdate', function (
            DateTime $start_date,
            DateTime $end_date,
            bool $hide_time = false
        ) {
            $now = new DateTime();
            $date_needs_years = ($start_date->format('Y') !== $end_date->format('Y')) || ($start_date->format('Y') !== $now->format('Y'));
            $start_format = '';
            $end_format = '';
            $start_time_format = ('00' === $start_date->format('i') ? 'g' : 'g:i');
            $end_time_format = ('00' === $end_date->format('i') ? 'g' : 'g:i');
            if (null !== $end_date) {
                if ($start_date->format('j F Y') === $end_date->format('j F Y')) {
                    $time_spans_midday = $start_date->format('a') === $end_date->format('a');
                    if ($date_needs_years) {
                        if ($hide_time) {
                            $start_format = 'j F Y';
                        } else {
                            $start_format = $time_spans_midday ? 'j F Y, '.$start_time_format : 'j F Y, '.$start_time_format.'a';
                        }
                    } else {
                        if ($hide_time) {
                            $start_format = 'j F';
                        } else {
                            $start_format = $time_spans_midday ? 'j F, '.$start_time_format : 'j F, '.$start_time_format.'a';
                        }
                    }
                    if ($hide_time) {
                        $end_format = '';
                    } else {
                        $end_format = $end_time_format.'a';
                    }
                } else {
                    if ($date_needs_years) {
                        if ($start_date->format('Y') === $end_date->format('Y')) {
                            $start_format = 'j F';
                        } else {
                            $start_format = 'j F Y';
                        }
                        $end_format = 'j F Y';
                    } else {
                        $start_format = 'j F';
                        $end_format = 'j F';
                    }
                }

                if (empty($end_format)) {
                    return $start_date->format($start_format);
                }

                return $start_date->format($start_format).' - '.$end_date->format($end_format);
            }

            if ($hide_time) {
                $start_format = $date_needs_years ? 'j F Y' : 'j F';
            } else {
                $start_format = $date_needs_years ? 'j F Y, '.$start_time_format.'a' : 'j F, '.$start_time_format.'a';
            }

            return $start_date->format($start_format);
        }));
    }
}
