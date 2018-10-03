<?php

namespace CottaCush\Cricket\Dashboard\Widgets;

use yii\helpers\ArrayHelper;

/**
 * Class BarChartWidget
 * @package CottaCush\Cricket\Dashboard\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class BarChartWidget extends BaseChartsJsWidget
{
    protected $type = 'bar';

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
                'backgroundColor' => "rgba($color, 1)",
                'borderColor' => "rgba($color, 1)",
                'pointHoverBackgroundColor' => "rgb($color)",
            ];
        }

        return ['labels' => $labels, 'datasets' => $datasets];
    }
}
