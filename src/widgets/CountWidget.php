<?php

namespace CottaCush\Cricket\Dashboard\Widgets;

use CottaCush\Yii2\Helpers\Html;

/**
 * Class CountWidget
 * @package app\widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class CountWidget extends BaseDashboardWidget
{
    protected $queryFunction = 'queryScalar';

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     */
    protected function renderHeader()
    {
        return;
    }

    protected function renderBody()
    {
        echo $this->beginDiv('card-body p-0');

        echo $this->beginDiv('p-3');
        echo Html::tag('h5', $this->model->name, ['class' => 'text-uppercase text-muted m-0 pt-1 pb-2']);
        echo Html::tag('span', $this->getData(), ['class' => 'h2']);
        echo $this->endDiv();

        echo $this->endDiv();
    }
}
