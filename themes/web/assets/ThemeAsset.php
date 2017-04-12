<?php
/**
 * @link http://www.bigbrush-agency.com/
 * @copyright Copyright (c) 2015 Big Brush Agency ApS
 * @license http://www.bigbrush-agency.com/license/
 */

namespace themes\web\assets;

use yii\web\AssetBundle;

/**
 * ThemeAsset
 */
class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@themes/web';
    public $publishOptions = ['forceCopy' => YII_ENV_DEV];
    public $css = [
        'css/theme.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}