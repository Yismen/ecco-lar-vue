<?php

namespace App\Repositories;

use Intervention\Image\Facades\Image;

class ImageMaker
{
    protected static $FILE;
    protected static $SQUARED;
    protected static $ENCODE;
    protected static $DESIRED_SIZE;

    public static function make($FILE, $SQUARED = null, $ENCODE = null, $DESIRED_SIZE = null)
    {        
        static::$FILE = $FILE;
        static::$SQUARED = $SQUARED ?? true;
        static::$ENCODE = $ENCODE ?? 'png';
        static::$DESIRED_SIZE = $DESIRED_SIZE ?? 600;

        $image = Image::make(static::$FILE);

        $image = static::resizeImage($image);

        $image = static::wantsSquaredImage($image);
        
        return $image->encode(static::$ENCODE);
    }

    private static function wantsSquaredImage($image)
    {
        if (static::$SQUARED) {
            $image = $image->crop(static::$DESIRED_SIZE, static::$DESIRED_SIZE);
        }

        return $image;
    }

    private static function resizeImage($image)
    {
        $image = $image->resize(static::$DESIRED_SIZE, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image = $image->resize(null, static::$DESIRED_SIZE, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $image;
    }
}
