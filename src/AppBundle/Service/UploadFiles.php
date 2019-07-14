<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 11/07/2019
 * Time: 14:23
 */

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFiles
{
    /**
     * @var string
     */
    private $imagesDir;

    /**
     * @var string
     */
    private $filesDir;

    /**
     * UploadFiles constructor.
     * @param $imagesDir
     * @param $filesDir
     */
    public function __construct($imagesDir, $filesDir)
    {
        $this->imagesDir = $imagesDir;
        $this->filesDir = $filesDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getImagesDir(), $fileName);

        return $fileName;
    }

    public function getImagesDir()
    {
        return $this->imagesDir;
    }

    public function getFilesDir()
    {
        return $this->filesDir;
    }
}
