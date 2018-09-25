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
        $data = [];
        $parser->parse($this->model, $data, $this->dbConnection, SQLGenerator::QUERY_ONE);
        $data = array_values($data);

        echo $this->beginDiv(self::$sizes[$this->model->location]);
        echo $this->beginDiv(
            'panel panel-default',
            [
                'style' => 'border-radius: 4px;box-shadow: 0 2px 0 rgba(90,97,105,.07), 0 4px 8px rgba(90,97,105,.08), 0 10px 10px rgba(90,97,105,.03), 0 7px 70px rgba(90,97,105,.08);'
            ]
        );
        echo $this->beginDiv('panel-body');
        echo $this->beginDiv('', ['style' => 'padding: 5px 0;']);
        echo Html::tag('span', $this->model->name, ['class' => 'h5 text-uppercase text-muted']);
        echo Html::tag('br');
        echo Html::tag('span', ArrayHelper::getValue($data, '0', 0), ['class' => 'h2']);
        echo $this->endDiv();
        echo $this->endDiv();
        echo $this->endDiv();
        echo $this->endDiv();
    }
}
