<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class ImageUploader extends Model
{
    /**
     * The desired extension for the image. Default is PNG
     * @var string
     */
    public $EXTENSION = '.png';
    /**
     * If you want to keep the current image ratio. Otherwise it will return a squared image. Default is true
     * @var [type]
     */
    public $SQUARED;
    /**
     * If you want the name to be random or based on the model id. If random, you will get
     * a different image and name in each instance. If you want to use the same image's name
     * leave as default. Defaul is null.
     * @var [type]
     */
    public $RANDOM_NAME;
    /**
     * The output size. This is the minumum of the sizes of the image. Default is 600.
     * @var integer
     */
    public $DESIRED_SIZE = 600;
    /**
     * The folder where a copy of the image will be uploaded to. Default is images/.
     * All paths are relative to the public folder.
     * @var [string]
     */
    private $PATH;
    /**
     * [$FIELDNAME description]
     * @var [type]
     */
    private $FIELDNAME;

    public function __construct($PATH ='images/', $RANDOM_NAME = null, $SQUARED = true)
    {
        $this->PATH = $PATH;
        $this->RANDOM_NAME = $RANDOM_NAME;
        $this->SQUARED = $SQUARED;
    }



    /**
     * Save an copy of a image to a given
     * @param  [type] $model   [description]
     * @param  [type] $fileField [description]
     * @return [type]          [description]
     */
    public function saveImage($name, $fileField)
    {
        $filename = $this->getName($name);

        $extendedName = $this->PATH . $filename . $this->EXTENSION;

        $file = Image::make($fileField);
            
        $file = $this->resizeImage($file);

        $file = $this->wantsSquaredImage($file);
        
        $file = $file->save($extendedName)->orientate();

        return $extendedName;
    }

    public function getName($name)
    {
        if ($this->RANDOM_NAME) {
            $name = str_random(60);
        }

        return sha1($name);
    }

    private function wantsSquaredImage($file)
    {
        if ($this->SQUARED) {
            $file = $file->crop($this->DESIRED_SIZE, $this->DESIRED_SIZE);
        }

        return $file;
    }

    private function resizeImage($file)
    {
        $file = $file->resize($this->DESIRED_SIZE, null, function ($constraint) {
            $constraint->aspectRatio();
        });
            
        $file = $file->resize(null, $this->DESIRED_SIZE, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $file;
    }
}
