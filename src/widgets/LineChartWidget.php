<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use yii\helpers\ArrayHelper;

/**
 * Class LineChartWidget
 * @package CottaCush\Cricket\Dashboards\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class LineChartWidget extends BaseChartsJsWidget
{
    public $fill = false;

    protected function getTransformedData()
    {
        $columns = $this->getDataColumns();
        $labels = ArrayHelper::getColumn($this->data, $columns[0]);
        $datasets = [];
        $columnCount = count($columns);
        $colors = $this->getRandomColors($columnCount);

        for ($index = 1; $index < $columnCount; $index++) {
            $color = $colors[$index - 1];
            $datasets[] = [
                'label' => $columns[$index],
                'data' => ArrayHelper::getColumn($this->data, $columns[$index]),
                'fill' => $this->fill,
                'backgroundColor' => "rgba($color, .1)",
                'borderColor' => "rgba($color, 1)",
                'pointHoverBackgroundColor' => "rgb($color)",
                'borderWidth' => 1.5,
                'pointRadius' => 3,
                'pointHoverRadius' => 3
            ];
        }

        return ['labels' => $labels, 'datasets' => $datasets];
    }
}
