<?php
namespace app\widgets;

use yii\helpers\ArrayHelper;
use iutbay\yii2kcfinder\KCFinderAsset;

class CKEditorOnChange extends \dosamigos\ckeditor\CKEditor
{

    public $enableKCFinder = true;
    public $output;

    /**
     * Registers CKEditor plugin
     */
    protected function registerPlugin()
    {
       
        $this->registerOnChange();        

        parent::registerPlugin();
    }

    /**
     * Registers KCFinder
     */
    protected function registerOnChange()    {
       
        $browseOptions = [
            'config.extraPlugins' => 'onchange'
        ];
        $this->clientOptions = ArrayHelper::merge($browseOptions, $this->clientOptions);
    }

}