<?php

namespace CottaCush\Cricket\Dashboard\Widgets;

use CottaCush\Cricket\Generators\SQL\SQLGenerator;
use CottaCush\Cricket\Generators\SQL\SQLQueryBuilderParser;
use CottaCush\Yii2\Helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Class CountWidget
 * @package app\widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class CountWidget extends BaseDashboardWidget
{
    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @throws \CottaCush\Cricket\Exceptions\SQLQueryGenerationException
     */
    public function renderWidget()
    {
        $parser = new SQLQueryBuilderParser();
        $data = $parser->parse($this->model, [], $this->dbConnection, SQLGenerator::QUERY_ONE);
        $data = array_values($data);

        echo $this->beginDiv(self::$sizes[$this->model->location]);
        echo $this->beginDiv('panel panel-default dashboard-view__count-widget equal-height');
        echo $this->beginDiv('panel-body');
        echo $this->beginDiv('dashboard-view__count-widget--data');
        echo Html::tag(
            'h1',
            ArrayHelper::getValue($data, '0', 0),
            ['class' => 'dashboard-view__count-widget--data-value']
        );
        echo Html::tag('span', $this->model->name, ['class' => 'dashboard-view__count-widget--data-label']);
        echo $this->endDiv();
        echo $this->endDiv();
        echo $this->endDiv();
        echo $this->endDiv();
    }
}
