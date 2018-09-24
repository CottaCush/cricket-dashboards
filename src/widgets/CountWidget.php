<?php

namespace CottaCush\Cricket\Report\Widgets;

use CottaCush\Cricket\Dashboard\Models\Dashboard;
use CottaCush\Cricket\Generators\SQLQueryBuilderParser;
use CottaCush\Cricket\Widgets\BaseDashboardWidget;
use CottaCush\Yii2\Helpers\Html;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

/**
 * Class CountWidget
 * @package app\widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class CountWidget extends BaseDashboardWidget
{
    /** @var Dashboard */
    public $dashboard;

    /** @var Connection */
    private $parser;

    public function run()
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

    public function getQuery()
    {
    }
}
