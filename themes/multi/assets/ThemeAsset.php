<?php
/**
 * @link http://www.bigbrush-agency.com/
 * @copyright Copyright (c) 2015 Big Brush Agency ApS
 * @license http://www.bigbrush-agency.com/license/
 */

namespace themes\multi\assets;

use yii\web\AssetBundle;

/**
 * ThemeAsset
 */
class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@themes/multi';
    public $publishOptions = ['forceCopy' => YII_ENV_DEV];
    public $css = [
//        'assets/css/materialize.min.css',
//        'assets/css/style.css',
    ];
    public $js = [
//        'assets/js/materialize.min.js',
//        'assets/js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset',
    ];
}