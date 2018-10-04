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

        echo $this->beginDiv(self::$sizes[$this->model->location]);
        echo $this->beginDiv('panel panel-default dashboard-view__count-widget');
        echo $this->beginDiv('panel-body');
        echo $this->beginDiv('dashboard-view__count-widget--data');
        echo Html::tag('span', $this->model->name, ['class' => 'dashboard-view__count-widget--data-label']);
        echo Html::tag('br');
        echo Html::tag(
            'span',
            ArrayHelper::getValue($data, '0', 0),
            ['class' => 'dashboard-view__count-widget--data-value']
        );
        echo $this->endDiv();
        echo $this->endDiv();
        echo $this->endDiv();

        echo $this->endDiv();
    }
}
