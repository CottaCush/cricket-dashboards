<?php

namespace CottaCush\Cricket\Dashboards\Factories;

use CottaCush\Cricket\Dashboards\Widgets\BarChartWidget;
use CottaCush\Cricket\Dashboards\Widgets\BaseDashboardWidget;
use CottaCush\Cricket\Dashboards\Widgets\CountWidget;
use CottaCush\Cricket\Dashboards\Widgets\DoughnutWidget;
use CottaCush\Cricket\Dashboards\Widgets\LineChartWidget;
use CottaCush\Cricket\Dashboards\Widgets\PieChartWidget;
use CottaCush\Cricket\Dashboards\Widgets\ScatterPlotWidget;
use CottaCush\Cricket\Dashboards\Widgets\TableWidget;
use CottaCush\Cricket\Interfaces\CricketQueryableInterface;
use yii\db\Connection;

class DashboardWidgetFactory
{
    const TYPE_COUNT = 'count';
    const TYPE_LINE_CHART = 'line-chart';
    const TYPE_PIE_CHART = 'pie-chart';
    const TYPE_AREA_GRAPH = 'area-graph';
    const TYPE_BAR_CHART = 'bar-chart';
    const TYPE_DOUGHNUT = 'doughnut';
    const TYPE_SCATTER_PLOT = 'scatter-plot';
    const TYPE_TABLE = 'table';

    private $dbConnection;

    public function __construct(Connection $dbConnection = null)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @param CricketQueryableInterface $model
     * @return BaseDashboardWidget
     */
    public function createWidget(CricketQueryableInterface $model)
    {
        $config = ['model' => $model, 'dbConnection' => $this->dbConnection];

        switch ($model->type) {
            case self::TYPE_TABLE:
                $widget = new TableWidget($config);
                break;

            case self::TYPE_BAR_CHART:
                $widget = new BarChartWidget($config);
                break;

            case self::TYPE_AREA_GRAPH:
                $config['fill'] = true;
            case self::TYPE_LINE_CHART:
                $widget = new LineChartWidget($config);
                break;

            case self::TYPE_PIE_CHART:
                $widget = new PieChartWidget($config);
                break;

            case self::TYPE_DOUGHNUT:
                $widget = new DoughnutWidget($config);
                break;

            case self::TYPE_SCATTER_PLOT:
                $widget = new ScatterPlotWidget($config);
                break;

            case self::TYPE_COUNT:
            default:
                $widget = new CountWidget($config);
                break;
        }

        return $widget;
    }
}
