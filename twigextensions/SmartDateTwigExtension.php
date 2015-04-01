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
		return 'wut';
	}
}

/*

{% macro smartDate( start_date, end_date ) -%}
    {%- set date_needs_years = ( end_date is not null and start_date.year != end_date.year ) or ( start_date.year != now.year ) -%}
    {%- if end_date -%}
        {%- if start_date|date( 'j F Y' ) == end_date|date( 'j F Y' ) -%}
            {%- set time_spans_midday = start_date|date( 'a' ) == end_date|date( 'a' ) -%}
            {%- if date_needs_years -%}
                {%- if time_spans_midday -%}
                    {{- start_date|date( 'j F Y, g' ) }}–{{- end_date|date( 'ga' ) -}}
                {%- else -%}
                    {{- start_date|date( 'j F Y, ga' ) -}}–{{- end_date|date( 'ga' ) -}}
                {%- endif -%}
            {%- else -%}
                {%- if time_spans_midday -%}
                    {{- start_date|date( 'j F, g' ) }}–{{- end_date|date( 'ga' ) -}}
                {%- else -%}
                    {{- start_date|date( 'j F, ga' ) -}}–{{- end_date|date( 'ga' ) -}}
                {%- endif -%}
            {%- endif -%}
        {%- else -%}
            {%- if date_needs_years -%}
                {%- if start_date|date( 'Y' ) == end_date|date( 'Y' ) -%}
                    {{- start_date|date( 'j F' ) -}}–{{- end_date|date( 'j F Y' ) -}}
                {%- else -%}
                    {{- start_date|date( 'j F Y' ) -}}–{{- end_date|date( 'j F Y' ) -}}
                {%- endif -%}
            {%- else -%}
                {{- start_date|date( 'j F' ) -}}–{{- end_date|date( 'j F' ) -}}
            {%- endif -%}
        {%- endif -%}
    {%- else -%}
        {%- if date_needs_years -%}
            {{- start_date|date( 'j F Y, ga' ) -}}
        {%- else -%}
            {{- start_date|date( 'j F, ga' ) -}}
        {%- endif -%}
    {%- endif -%}
{%- endmacro %}

*/
