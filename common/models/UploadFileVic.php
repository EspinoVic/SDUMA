<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFileVic extends Model
{
    /**
     * @var UploadedFile
     */
    public $myFile;

    public function rules()
    {
        return [
            [['myFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, pdf'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->myFile->saveAs('uploads/' . $this->myFile->baseName . '.' . $this->myFile->extension);
            return true;
        } else {
            return false;
        }
    }
}


?>