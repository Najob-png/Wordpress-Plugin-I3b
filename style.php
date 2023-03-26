<?php
    $theme = get_option("theme");
    $font = get_option("font");
    $fontColor = get_option("fontColor");

    $color = "#ffffff";

    if($theme == "Light")
    {
	    $color = "#eeeeee";
    }
    else
    {
	    $color = "333333";
    }

    echo
	    '
	    <style>
	        *
	        {
	            font-family: '.$font.', sans-serif !important;
	            color: '.$fontColor.' !important;
	        }
	        div
	        {
	            background-color: '.$color.' !important;
	        }
	    </style>
		';