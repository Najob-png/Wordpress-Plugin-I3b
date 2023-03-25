<?php
    header("Content-type: text/css");

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
?>
<style>
    *
    {
        font-family: <?php echo $font;?>sans-serif;
        color: <?php echo $fontColor;?>;
    }
    div
    {
        background-color: <?php echo $color;?>;
    }
</style>