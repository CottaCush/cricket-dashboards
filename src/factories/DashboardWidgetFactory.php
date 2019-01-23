<?php

namespace CottaCush\Cricket\Dashboards\Factories;

use CottaCush\Cricket\Dashboards\Widgets\BarChartWidget;
use CottaCush\Cricket\Dashboards\Widgets\BaseDashboardWidget;
use CottaCush\Cricket\Dashboards\Widgets\CountWidget;
use CottaCush\Cricket\Dashboards\Widgets\DoughnutWidget;
use CottaCush\Cricket\Dashboards\Widgets\LineChartWidget;
use CottaCush\Cricket\Dashboards\Widgets\PeriodicCountWidget;
use CottaCush\Cricket\Dashboards\Widgets\PieChartWidget;
use CottaCush\Cricket\Dashboards\Widgets\ScatterPlotWidget;
use CottaCush\Cricket\Dashboards\Widgets\TableWidget;
use CottaCush\Cricket\Interfaces\CricketQueryableInterface;
use yii\db\Connection;

class DashboardWidgetFactory
{
    private $dbConnection;

    public function __construct(Connection $dbConnection = null)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @param CricketQueryableInterface $model
     * @param array $extras
     * @return BaseDashboardWidget
     */
    public function createWidget(CricketQueryableInterface $model, $extras = [])
    {
        $config = [
            'model' => $model,
            'dbConnection' => $this->dbConnection,
        ];
        $config = array_merge($config, $extras);

        switch ($model->type) {
            case BaseDashboardWidget::TYPE_TABLE:
                $widget = new TableWidget($config);
                break;

            case BaseDashboardWidget::TYPE_BAR_CHART:
                $widget = new BarChartWidget($config);
                break;

            case BaseDashboardWidget::TYPE_AREA_GRAPH:
                $config['fill'] = true;
            case BaseDashboardWidget::TYPE_LINE_CHART:
                $widget = new LineChartWidget($config);
                break;

            case BaseDashboardWidget::TYPE_PIE_CHART:
                $widget = new PieChartWidget($config);
                break;

            case BaseDashboardWidget::TYPE_DOUGHNUT:
                $widget = new DoughnutWidget($config);
                break;

            case BaseDashboardWidget::TYPE_SCATTER_PLOT:
                $widget = new ScatterPlotWidget($config);
                break;

            case BaseDashboardWidget::TYPE_PERIODIC_COUNT:
                $widget = new PeriodicCountWidget($config);
                break;

            case BaseDashboardWidget::TYPE_COUNT:
            default:
                $widget = new CountWidget($config);
                break;
        }

        return $widget;
    }
}
