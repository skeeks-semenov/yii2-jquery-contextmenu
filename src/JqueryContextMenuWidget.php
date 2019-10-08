<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\contextmenu;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class JqueryContextMenuWidget extends Widget
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var array
     */
    public $rightClickSelectors = [];

    /**
     * @var array
     */
    public $items = [];

    /**
     * [
     *      'tag' => 'a',
     *      'class' => '',
     *      'label' => 'test',
     * ]
     * @var
     */
    public $button = true;

    /**
     * @var string
     */
    public $triggerId = '';

    public function init()
    {
        if (!$this->triggerId) {
            $this->triggerId = $this->id . "-trigger";
        }


    }

    public function run()
    {
        if ($this->button) {

            $options = (array) $this->button;
            $tag = ArrayHelper::getValue($options, 'tag', 'div');

            $options['id'] = $this->triggerId;

            echo Html::beginTag($tag, $options);
        }

        if ($this->button) {
            echo ArrayHelper::getValue((array) $this->button, 'label', 'left click');
            echo ArrayHelper::getValue((array) $this->button, 'content');
            echo ArrayHelper::getValue((array) $this->button, 'body');
            echo Html::endTag(ArrayHelper::getValue((array) $this->button, 'tag', 'div'));
        }

        JqueryContextMenuAsset::register($this->view);

        $id = $this->id . "-menu";
        //$this->clientOptions['items'] = new JsExpression("jQuery.contextMenu.fromMenu(jQuery('#{$id}'))");
        $this->clientOptions['items'] = (array) $this->items;

        $this->clientOptions['selector'] = "#{$this->triggerId}";
        $this->clientOptions['trigger'] = 'left';

        $jsOptions = Json::encode($this->clientOptions);

        $this->view->registerJs(<<<JS
    jQuery.contextMenu({$jsOptions});
JS
        );

        if ($this->rightClickSelectors) {
            foreach ($this->rightClickSelectors as $selector)
            {
                $this->clientOptions['selector'] = $selector;
                $this->clientOptions['trigger'] = 'right';

                $jsOptions = Json::encode($this->clientOptions);

                $this->view->registerJs(<<<JS
            jQuery.contextMenu({$jsOptions});
JS
                );
            }
        }



    }

}