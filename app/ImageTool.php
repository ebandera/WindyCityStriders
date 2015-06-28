<?php
/**
 * Created by PhpStorm.
 * User: ericbandera
 * Date: 5/4/15
 * Time: 1:23 PM
 */

namespace App;


class ImageTool
{
    private $_imagePath,$_imageResource;

    function __construct($imagePath)
    {
        $this->_imagePath=$imagePath;
        $this->_imageResource= imagecreatefromjpeg($imagePath);
    }


    function modifyToOptimalSize($optimalWidth,$optimalHeight,$r,$g,$b,$position='center')
    {
        $imageInfo = getimagesize($this->_imagePath);
        $currentWidth= $imageInfo[0];
        $currentHeight = $imageInfo[1];

        $newImage = imagecreatetruecolor($optimalWidth,$optimalHeight);
        $theColor=imagecolorallocate($newImage,$r,$g,$b);
        imagefill($newImage,0,0,$theColor);

        //do some math
        $ratioWHUploaded = $currentWidth/$currentHeight;
        $ratioWHOptimal = $optimalWidth/$optimalHeight;
        //if uploaded is greatedr than optimal, it is too wide if uploaded is less than optimal, it is too tall
        if($ratioWHUploaded<$ratioWHOptimal)  //too tall, so make height of the current to the optimal
        {
            $multiplier = $optimalHeight/$currentHeight;
            $tempWidth=$currentWidth*$multiplier;
            $tempHeight = $optimalHeight;

        }
        else
        {//too wide, wo make width of the current to the optimal
            $multiplier = $optimalWidth/$currentWidth;
            $tempWidth=$optimalWidth;
            $tempHeight = $currentHeight*$multiplier;
        }
        // echo 'tempw:'.$tempWidth,'temph:'.$tempHeight,'currentw:' .$currentWidth,'currentHieght:' . $currentHeight,'multiplier:'.$multiplier;
        if($position=='center') {
            $pixelL = ($optimalWidth - $tempWidth) / 2;
        }
        elseif($position=='left')
        {
            $pixelL = 0;

        }
        elseif($position=='right')
        {
            $pixelL = ($optimalWidth - $tempWidth) ;
        }
        else
        {
            $pixelL = ($optimalWidth - $tempWidth) / 2;
        }
        $pixelT=($optimalHeight-$tempHeight)/2;
        // echo 'tempw:'.$tempWidth,'temph:'.$tempHeight,'currentw:' .$currentWidth,'currentHieght:' . $currentHeight,'multiplier:'.$multiplier,'pixelL:'.$pixelL,'pixelT:'.$pixelT;


        imagecopyresized($newImage, $this->_imageResource, $pixelL,$pixelT, 0, 0, $tempWidth, $tempHeight,$currentWidth, $currentHeight);

        // imagecopyresampled($newImage, $tempImage, $pixelL, $pixelT, 0, 0, $optimalWidth, $optimalHeight,$tempWidth, $tempHeight );

        imagejpeg($newImage, $this->_imagePath, 100);
        imagedestroy($newImage);

    }


}