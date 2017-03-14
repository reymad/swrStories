<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 14/03/2017
 * Time: 10:55
 */

// info to save as image php
// http://stackoverflow.com/questions/1532993/i-have-a-base64-encoded-png-how-do-i-write-the-image-to-a-file-in-php

/*

$img = $_POST['data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = 'photo.png';
file_put_contents($fileName, $fileData);

*/

// canvas.toDataURL();
// document.getElementById('colors_sketch').toDataURL(); => data/image/png;base64,...

?>
<br>
<div class="sketch text-center">

    <div class="tools text-center">
            <a href="#colors_sketch" data-color="#f00" style="width: 10px; background: #f00;"> </a>
            <a href="#colors_sketch" data-color="#ff0" style="width: 10px; background: #ff0;"> </a>
            <a href="#colors_sketch" data-color="#0f0" style="width: 10px; background: #0f0;"> </a>
            <a href="#colors_sketch" data-color="#0ff" style="width: 10px; background: #0ff;"> </a>
            <a href="#colors_sketch" data-color="#00f" style="width: 10px; background: #00f;"> </a>
            <a href="#colors_sketch" data-color="#f0f" style="width: 10px; background: #f0f;"> </a>
            <a href="#colors_sketch" data-color="#000" style="width: 10px; background: #000;"> </a>
            <a href="#colors_sketch" data-color="#fff" style="width: 10px; background: #fff;"> </a>
            <a href="#colors_sketch" data-size="3" style="background: #ccc">3</a>
            <a href="#colors_sketch" data-size="5" style="background: #ccc">5</a>
            <a href="#colors_sketch" data-size="10" style="background: #ccc">10</a>
            <a href="#colors_sketch" data-size="15" style="background: #ccc">15</a>

            <a href="#colors_sketch" data-tool="marker">Marker</a>
            <a href="#colors_sketch" data-tool="eraser">Eraser</a>
            <!--<a href="#colors_sketch" data-download="png" style="float: right; width: 100px;">Download</a>-->
    </div>
        <br>
    <canvas id="colors_sketch" width="225" height="300" style="border: 1px solid #ccc;"></canvas>

</div>
<br>
<style>
.tools a{
        border: 1px solid black;
        height: 30px;
        line-height: 30px;
        padding: 0 10px;
        vertical-align: middle;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        color: black;
        font-weight: bold;
}
</style>


