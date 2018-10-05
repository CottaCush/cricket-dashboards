<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Cricket\Generators\SQL\SQLGenerator;
use CottaCush\Yii2\Helpers\Html;

/**
 * Class CountWidget
 * @package app\widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class CountWidget extends BaseDashboardWidget
{
    protected $queryFunction = SQLGenerator::QUERY_SCALAR;

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     */
    protected function renderHeader()
    {
        return;
    }

    protected function renderBody()
    {
        echo $this->beginDiv('card-body cricket-dashboard-view__count-widget equal-height');
        echo $this->beginDiv('cricket-dashboard-view__count-widget--data');
        echo Html::tag(
            'h1',
            $this->getData(),
            ['class' => 'cricket-dashboard-view__count-widget--data-value']
        );
        echo Html::tag('span', $this->model->name, ['class' => 'cricket-dashboard-view__count-widget--data-label']);
        echo $this->endDiv();
        echo $this->endDiv();
    }
}
