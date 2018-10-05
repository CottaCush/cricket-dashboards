<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

/**
 * Class ScatterPlotWidget
 * @package CottaCush\Cricket\Dashboards\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class ScatterPlotWidget extends BaseChartsJsWidget
{
    protected function getTransformedData()
    {
        $columns = $this->getDataColumns();
        $datasets = [];

        for ($index = 0; $index < count($columns) - 1; $index++) {
            $randomColor = $this->getRandomColors(1, 'rgb', true);

            $data = array_map(
                function ($row) use ($index, $columns) {
                    return ["x" => $row[$columns[0]], 'y' => $row[$columns[$index + 1]]];
                },
                $this->data
            );

            $datasets[] = [
                'label' => $columns[$index + 1],
                'data' => $data,
                'backgroundColor' => "rgba($randomColor, 1)",
                'borderColor' => "rgba($randomColor, 1)",
                'pointHoverBackgroundColor' => "rgb($randomColor)",
            ];
        }

        return ['datasets' => $datasets];
    }
}
