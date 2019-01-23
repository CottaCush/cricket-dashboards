<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Cricket\Dashboards\Assets\DashboardViewAsset;
use CottaCush\Cricket\Dashboards\Factories\DashboardWidgetFactory;
use CottaCush\Cricket\Dashboards\Models\Dashboard;
use CottaCush\Cricket\Generators\SQL\SQLQueryBuilderParser;
use CottaCush\Cricket\Widgets\BaseCricketWidget;
use CottaCush\Yii2\Helpers\Html;
use CottaCush\Yii2\Widgets\Bootstrap\Modal;
use CottaCush\Yii2\Widgets\EmptyStateWidget;
use yii\db\Connection;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\View;

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
    public $startDate = null;
    public $endDate = null;

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

        $this->view->registerJs('var dashboardName = ' . Json::encode($this->dashboard->name) . ';', View::POS_HEAD);

        parent::init();
    }

    public function run()
    {
        $this->renderTitle();
        if (!$this->widgets) {
            $this->renderEmptyStateWidget();
        } else {
            $this->renderDashboard();
        }
        $this->renderZoomModal();
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

    private function renderDashboard()
    {
        echo $this->beginDiv('cricket-dashboard-view');
        foreach ($this->locationalWidgets as $location => $widgets) {
            $this->renderLocation($location);
        }
        echo $this->endDiv();
    }

    private function renderEmptyStateWidget()
    {
        echo EmptyStateWidget::widget([
            'icon' => 'dropbox',
            'description' => 'No contents have been added to the dashboard yet'
        ]);
    }

    private function renderLocation($location)
    {
        $locationWidgets = ArrayHelper::getValue($this->locationalWidgets, $location);
        $filterValues = [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ];

        echo $this->beginDiv('row');
        foreach ($locationWidgets as $widget) {
            $dashboardWidget = $this->factory->createWidget($widget, $filterValues);
            $dashboardWidget->renderWidget();
        }
        echo $this->endDiv();
    }

    private function renderZoomModal()
    {
        Modal::begin([
            'header' => '<h4 class="modal-title"></h4>',
            'options' => [
                'id' => 'zoomWidgetModal',
                'data-generic-modal' => 'true',
                'class' => 'cricket-zoom-in-modal'
            ],
            'footer' => ''
        ]);
        Modal::end();
    }
}
