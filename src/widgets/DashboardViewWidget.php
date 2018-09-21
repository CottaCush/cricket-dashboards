<?php

namespace CottaCush\Cricket\Report\Widgets;

use CottaCush\Cricket\Generators\SQLQueryBuilderParser;
use CottaCush\Cricket\Dashboard\Models\Dashboard;
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

    const LOCATION_TOP = 'top';
    const LOCATION_MIDDLE = 'middle';
    const LOCATION_BOTTOM = 'bottom';

    public static $sizes = [
        self::LOCATION_TOP => 'col-lg-3 col-md-3 col-sm-6 col-xs-12',
        self::LOCATION_MIDDLE => 'col-lg-4 col-sm-6 col-xs-12',
        self::LOCATION_BOTTOM => 'col-sm-6 col-xs-12'
    ];
    public $showTitle = false;

    /** @var Connection */
    private $dbConnection;
    private $parser;
    private $locationWidgets;

    private $widgets;

    public function init()
    {
        $this->dbConnection = $this->dashboard->project->getLocalDbConnection();
        $this->parser = new SQLQueryBuilderParser();
        $this->widgets = $this->dashboard->widgets;

        $this->locationWidgets = ArrayHelper::index($this->dashboard->widgets, null, 'location');
        arsort($this->locationWidgets);
        parent::init();
    }

    public function run()
    {
        $this->renderTitle();

        foreach ($this->locationWidgets as $location => $widgets) {
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
        $locationWidgets = ArrayHelper::getValue($this->locationWidgets, $location);

        echo Html::tag('h2', null);
        echo $this->beginDiv('row');
        foreach ($locationWidgets as $widget) {
            $this->renderWidget($widget);
        }
        echo $this->endDiv();
    }

    private function renderWidget(Widget $widget)
    {
        $data = [];

        $this->parser->parse($widget, $data, [], $this->dbConnection, 'queryOne');
        $data = array_values($data);

        echo $this->beginDiv(self::$sizes[$widget->location]);
        echo $this->beginDiv(
            'panel panel-default',
            [
                'style' => 'border-radius: 4px;box-shadow: 0 2px 0 rgba(90,97,105,.07), 0 4px 8px rgba(90,97,105,.08), 0 10px 10px rgba(90,97,105,.03), 0 7px 70px rgba(90,97,105,.08);'
            ]
        );
        echo $this->beginDiv('panel-body');
        echo $this->beginDiv('', ['style' => 'padding: 5px 0;']);
        echo Html::tag('span', $widget->name, ['class' => 'h5 text-uppercase text-muted']) . '<br>';
        echo Html::tag('span', ArrayHelper::getValue($data, '0', 0), ['class' => 'h2']);
        echo $this->endDiv();
        echo $this->endDiv();
        echo $this->endDiv();
        echo $this->endDiv();
    }
}
