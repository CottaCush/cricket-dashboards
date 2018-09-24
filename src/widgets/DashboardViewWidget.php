<?php

namespace CottaCush\Cricket\Widgets;

use CottaCush\Cricket\Dashboard\Interfaces\WidgetInterface;
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

    public $showTitle = false;

    /** @var Connection */
    private $dbConnection;
    private $parser;
    private $locationalWidgets;

    private $widgets;

    public function init()
    {
        $this->dbConnection = $this->dashboard->project->getLocalDbConnection();
        $this->parser = new SQLQueryBuilderParser();
        $this->widgets = $this->dashboard->widgets;

        $this->locationalWidgets = ArrayHelper::index($this->widgets, null, 'location');
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
            $this->renderWidget($widget);
        }
        echo $this->endDiv();
    }

    private function renderWidget(WidgetInterface $widget)
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
