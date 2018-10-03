<?php

namespace CottaCush\Cricket\Dashboard\Widgets;

use CottaCush\Cricket\Dashboard\Models\Widget;
use CottaCush\Cricket\Generators\SQL\SQLGenerator;
use CottaCush\Cricket\Generators\SQL\SQLQueryBuilderParser;
use CottaCush\Yii2\Helpers\Html;
use CottaCush\Yii2\Widgets\BaseWidget as Yii2BaseWidget;
use yii\helpers\ArrayHelper;

/**
 * Class BaseDashboardWidget
 * @package CottaCush\Cricket\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
abstract class BaseDashboardWidget extends Yii2BaseWidget
{
    /** @var Widget */
    public $model;

    const LOCATION_TOP = 'top';
    const LOCATION_MIDDLE = 'middle';
    const LOCATION_BOTTOM = 'bottom';

    protected $data;
    protected $columns;

    protected $queryFunction = SQLGenerator::QUERY_ALL;

    public static $sizes = [
        self::LOCATION_TOP => 'col-lg-2 col-md-3 col-sm-6 col-12 my-4',
        self::LOCATION_MIDDLE => 'col-lg-4 col-md-6 col-12 my-4',
        self::LOCATION_BOTTOM => 'col-md-6 col-sm-12 my-4',
    ];

    public $dbConnection;

    public function init()
    {
        parent::init();

        $this->data = $this->getData();
    }

    public function renderWidget()
    {
        echo $this->beginDiv($this->getSize());
        echo $this->beginDiv('card card-small');

        $this->renderHeader();

        $this->renderBody();

        $this->renderFooter();

        echo $this->endDiv();
        echo $this->endDiv();
    }

    protected function getSize()
    {
        return ArrayHelper::getValue(self::$sizes, $this->model->location);
    }

    protected function getData()
    {
        $parser = new SQLQueryBuilderParser();
        $data = $parser->parse($this->model, [], $this->dbConnection, $this->queryFunction);
        return $data;
    }

    protected function getDataColumns($data = [])
    {
        if (!$data) {
            $data = $this->data;
        }
        $row = current($data);
        return array_keys($row);
    }

    protected function renderHeader()
    {
        echo $this->beginDiv('card-header border-bottom');
        echo Html::tag('span', $this->model->name . ' - ' . $this->model->type, ['class' => 'h4 p-1']);
        echo $this->endDiv();
    }

    abstract protected function renderBody();

    protected function renderFooter()
    {
        return;
    }

    protected function renderFilter()
    {
        if (!$this->model->queryObj->inputPlaceholders) {
            return;
        }

        echo $this->beginDiv('row border-bottom px-2 py-3 bg-light');
        echo '';
        echo $this->endDiv();
    }
}
