<?php

namespace CottaCush\Cricket\Dashboard\Widgets;

use CottaCush\Cricket\Dashboard\Factories\DashboardWidgetFactory;
use CottaCush\Cricket\Dashboard\Models\Dashboard;
use CottaCush\Cricket\Generators\SQL\SQLQueryBuilderParser;
use CottaCush\Cricket\Widgets\BaseCricketWidget;
use CottaCush\Yii2\Helpers\Html;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

/**
 * Class DashboardViewWidget
 * @package app\widgets
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
        arsort($this->locationalWidgets);
        parent::init();
    }

    public function run()
    {
        $this->renderTitle();

        foreach ($this->locationalWidgets as $location => $widgets) {
            $this->renderLocation($location);
        }
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

        echo Html::tag('h2', null);
        echo $this->beginDiv('row');
        foreach ($locationWidgets as $widget) {
            $this->factory->createWidget($widget)->renderWidget();
        }
        echo $this->endDiv();
    }
}
