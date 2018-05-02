<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\contextmenu;

use yii\web\AssetBundle;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class JqueryContextMenuAsset extends AssetBundle
{
    public $sourcePath = '@npm/jquery-contextmenu/dist';

    public $js = [
        'jquery.contextMenu.min.js',
    ];

    public $css = [
        'jquery.contextMenu.min.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}