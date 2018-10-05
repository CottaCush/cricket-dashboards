<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use yii\helpers\ArrayHelper;

/**
 * Class PieChartWidget
 * @package CottaCush\Cricket\Dashboards\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class PieChartWidget extends BaseChartsJsWidget
{
    public function init()
    {
        parent::init();

        unset($this->clientOptions['scales']);
    }

    protected function getTransformedData()
    {
        $columns = $this->getDataColumns();
        $labels = ArrayHelper::getColumn($this->data, $columns[0]);

        $datasets = [];
        $colors = $this->getRandomColors(count($labels), 'hex');

        for ($index = 1; $index < count($columns); $index++) {
            $datasets[] = [
                'label' => $columns[$index],
                'data' => ArrayHelper::getColumn($this->data, $columns[$index]),
                'backgroundColor' => $colors,
                'borderWidth' => 1.5,
            ];
        }

        return ['labels' => $labels, 'datasets' => $datasets];
    }
}
