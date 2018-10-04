<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

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
        echo $this->beginDiv('card-body p-0 cricket-dashboard-view__count-widget');

        echo $this->beginDiv('cricket-dashboard-view__count-widget--data p-3');
        echo Html::tag('span', $this->model->name, ['class' => 'cricket-dashboard-view__count-widget--data-label']);
        echo Html::tag('br');
        echo Html::tag('span', $this->getData(), ['class' => 'cricket-dashboard-view__count-widget--data-value']);
        echo $this->endDiv();

        echo $this->endDiv();
    }
}
