<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Cricket\Generators\SQL\SQLGenerator;
use CottaCush\Yii2\Helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Class PeriodicCountWidget
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Dashboards\Widgets
 */
class PeriodicCountWidget extends BaseDashboardWidget
{
    protected $queryFunction = SQLGenerator::QUERY_ALL;

    protected function renderHeader()
    {
        return;
    }

    public function init()
    {
        parent::init();
        if (empty($this->data)) {
            $this->data = [];
        }
    }

    protected function renderBody()
    {

        $latestData = array_pop($this->data);
        $count = ArrayHelper::getValue($latestData, 'count', 0);
        $percentageChange = ArrayHelper::getValue($latestData, 'percentage_change', 0);
        $lastDate = ArrayHelper::getValue($latestData, 'last_date', 0);

        echo $this->beginDiv('cricket-dashboard-view__count-widget equal-height');
        echo $this->beginDiv('cricket-dashboard-view__count-widget--data');
        echo Html::tag(
            'h4',
            $count,
            ['class' => 'cricket-dashboard-view__count-widget--data-value']
        );
        echo Html::tag('span', $this->model->name, ['class' => 'cricket-dashboard-view__count-widget--data-label']);

        echo Html::beginTag('span', ['class' => 'cricket-dashboard-view__count-widget--periodic-data']);
        echo Html::tag('span',
            is_null($percentageChange) ? Html::tag('span', 'N/A ', ['class' => 'text-muted']) : $this->getValueWithIcon($percentageChange)
        );
        echo Html::tag('span', 'last ' . $this->model->interval);
        echo Html::endTag('span');

        if ($lastDate) {
            echo Html::tag(
                'span',
                'as at ' .  date('j M Y g:ia', strtotime($lastDate)),
                ['class' => 'text-muted cricket-dashboard-view__count-widget--last-date']
            );
        }

        echo $this->endDiv();
        echo $this->endDiv();
    }

    private function getValueWithIcon($value)
    {
        if ($value > 0) {
            return '<span class = "text-success">
                <span class = "fa fa-caret-up"></span>' . ' ' . number_format($value, 2) . '% ' .
                '</span>';
        } elseif ($value > 0) {
            return '<span class = "text-danger">
                <span class = "fa fa-caret-down"></span>' . ' ' . number_format($value, 2) . '% ' .
                '</span>';
        }
        return '<span class = "text-muted">' . $value . ' ' . '</span>';
    }
}
