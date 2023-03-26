<?php

class Style
{
	public function getConfig() : string
	{
		$theme = get_option("theme");
		$font = get_option("font");
		$fontColor = get_option("font_color");

		if($theme == "light")
		{
			$color = "#eeeeee";
		}
		else
		{
			$color = "#333333";
		}
		return
			'
	            font-family: '.$font.', sans-serif !important;
	            color: '.$fontColor.' !important;
	            background-color: '.$color.' !important;
	            padding: 25px;
	            border-radius: 25px;
			';
	}
}