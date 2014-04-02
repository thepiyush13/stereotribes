<?php

/**
 * Class to upload images 
 */
class ImageUploader {

    const MAX_IMAGE_SIZE = 2048576;
    const MIN_IMAGE_SIZE = 1;
    const DEFAULT_TARGET_PATH = 'campaign/';
    const DEFAULT_RELATIVE_PATH = '/uploads/';

    protected $baseUploadPath;
    protected $baseRelativePath;
    protected $tempPath;
    protected $targetPath;
    protected $name;
    protected $useAutoName = false;
    protected $destination = '';
    protected $minSize;
    protected $maxSize;
    protected $extension;
    protected $allowed = array();
    protected $allowedMimeTypes = array();
    protected $error = false;
    protected $allowedOptions = array('minSize', 'maxSize', 'targetPath', 'name', 'useAutoName');

    public function __construct($file, $options) {
        $this->init();
        $this->image = $file;
        if (is_array($options) && $options) {
            foreach ($options as $key => $value) {
                //overwrite passed options
                if (in_array($key, $this->allowedOptions)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function setTargetPath($path) {
        $this->targetPath . $path;
    }

    public function init() {
        $this->baseUploadPath = yii::app()->basePath . '/../uploads/';
        $this->maxSize = self::MAX_IMAGE_SIZE;
        $this->minSize = self::MIN_IMAGE_SIZE;
        $this->targetPath = self::DEFAULT_TARGET_PATH;
        $this->allowed = array(
            'image/*',
        );

        $this->allowedMimeTypes = array(
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpe' => 'image/jpeg',
            'gif' => 'image/gif',
            'png' => 'image/png',
        );
    }

    public function process() {
        if ($this->image) {

            //check error
            if ($this->image->getError() !== UPLOAD_ERR_OK) {
                $this->error = "FILE UPLOAD ERROR"; //file upload error
            }

            //check image 
            if (!in_array($this->image->getType(), $this->allowedMimeTypes)) {
                $this->error = "INVALID IMAGE"; //file upload error
            }
            //check size
            if (!($this->image->getSize() <= $this->maxSize && $this->image->getSize() >= $this->minSize)) {
                $this->error = "SIZE ERROR";
            }
            //check extension
            //$this->getExtensionName();
            if ($this->error === false) {
                if (!$this->name) { //name is not passed in option
                    $this->name = ($this->useAutoName) ? md5($this->image->getName() . rand(1, 1000)) : $this->image->getName();
                }

                //save image    
                if ($this->image->saveAs($this->baseUploadPath . $this->targetPath . $this->name)) {
                    
                } else {
                    $this->error = 'File could not be saved';
                }
            } else {
                
            }
        } else {
            $this->error = "Error";
        }
        if ($this->error) {
            return false;
        }
        return true;
    }

    /**
     * return image path
     * 
     */
    public function getImagePath() {
        return self::DEFAULT_RELATIVE_PATH . $this->targetPath . $this->name;
    }

    public function getError() {
        return $this->error;
    }

    

}
