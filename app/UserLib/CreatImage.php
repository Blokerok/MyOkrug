<?php


namespace App\UserLib;



class CreatImage
{

    static public function creat_img($img,$x,$y)
    {
        $height = $img->getHeight();
        $width = $img->getWidth();


        if ($width >= $x && $height >= $y) {
            $hulf_width = (int)($x / 2);
            $hulf_height = (int)($y / 2);

            if ($width > $height && $width / $height >= 1.45) {
                $img->resize(NULL, $y, function ($constraint) {
                    $constraint->aspectRatio();
                    //  $constraint->upsize();
                });

                $width_mediana = (int)($img->getWidth() / 2);
                $x_crop = abs($hulf_width - $width_mediana);

                //dd($img->getWidth().' '.$img->getHeight().' '.$width_mediana.' '.$x_crop);

                $img->crop($x, $y, $x_crop, 0);

            } elseif ($width < $height && $height / $width >= 1.45) {
                $img->resize($x, NULL, function ($constraint) {
                    $constraint->aspectRatio();

                });
                $height_mediana = (int)($img->getHeight() / 2);
                $y_crop = abs($hulf_height - $height_mediana);
                $img->crop($x, $y, 0, $y_crop);
            } else {



                $img->resize(($height>$width ? $x:NULL),($height>$width ? NULL:$x), function ($constraint) {
                    $constraint->aspectRatio();

                });

                $width_mediana = (int)($img->getWidth() / 2);
                $x_crop = abs($hulf_width - $width_mediana);

                //  dd($img->getWidth().' '.$img->getHeight().' '.$width_mediana.' '.$x_crop);
                $img->crop($x, $y, $x_crop, 0);


            }

        }

        return $img;

    }

}
