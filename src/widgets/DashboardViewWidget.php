<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Cricket\Dashboards\Assets\DashboardViewAsset;
use CottaCush\Cricket\Dashboards\Factories\DashboardWidgetFactory;
use CottaCush\Cricket\Dashboards\Models\Dashboard;
use CottaCush\Cricket\Generators\SQL\SQLQueryBuilderParser;
use CottaCush\Cricket\Widgets\BaseCricketWidget;
use CottaCush\Yii2\Helpers\Html;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

/**
 * Class DashboardViewWidget
 * @package CottaCush\Cricket\Dashboards\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class DashboardViewWidget extends BaseCricketWidget
{
    /** @var Dashboard */
    public $dashboard;

    public $showTitle = false;

    /** @var Connection */
    public $dbConnection = null;

    /** @var DashboardWidgetFactory */
    private $factory;

    /** @var SQLQueryBuilderParser */
    private $parser;
    private $locationalWidgets;

    private $widgets;

    public function init()
    {
        $this->parser = new SQLQueryBuilderParser();
        $this->widgets = $this->dashboard->widgets;

        $this->locationalWidgets = ArrayHelper::index($this->widgets, null, 'location');
        $this->factory = new DashboardWidgetFactory($this->dbConnection);
        DashboardViewAsset::register($this->view);
        krsort($this->locationalWidgets);

        parent::init();
    }

    public function run()
    {
        echo $this->beginDiv('cricket-wrapper');
        $this->renderTitle();

        echo $this->beginDiv('cricket-dashboard-view');
        foreach ($this->locationalWidgets as $location => $widgets) {
            $this->renderLocation($location);
        }
        echo $this->endDiv();
        echo $this->endDiv();
    }

    private function renderTitle()
    {
        if (!$this->showTitle) {
            return;
        }

        echo $this->beginDiv();
        echo Html::tag('h2', $this->dashboard->name);
        echo $this->endDiv();
    }

    private function renderLocation($location)
    {
        $locationWidgets = ArrayHelper::getValue($this->locationalWidgets, $location);

        echo $this->beginDiv('row');
        foreach ($locationWidgets as $widget) {
            $dashboardWidget = $this->factory->createWidget($widget);
            $dashboardWidget->renderWidget();
        }
        echo $this->endDiv();
    }
}
