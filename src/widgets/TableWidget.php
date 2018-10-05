<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Yii2\Helpers\Html;

/**
 * Class TableWidget
 * @package CottaCush\Cricket\Dashboards\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class TableWidget extends BaseDashboardWidget
{
    public $includeSerialCount = true;
    private $index = 0;

    protected function renderBody()
    {
        echo $this->beginDiv('card-body');

        echo $this->beginDiv('');
        $this->renderFilter();
        echo $this->endDiv();

        $this->renderTable();
        echo $this->endDiv();
    }

    private function renderTable()
    {
        echo Html::beginTag('table', ['class' => 'table table-bordered']);
        $this->renderTableHeader();
        $this->renderTableBody();
        echo Html::endTag('table');
    }

    private function renderTableHeader()
    {
        $columnHeaders = $this->getDataColumns($this->data);

        echo Html::beginTag('thead', ['class' => 'text-center']);
        echo Html::beginTag('tr');

        if ($this->includeSerialCount) {
            $columnHeaders = array_merge(['SN'], $columnHeaders);
        }

        foreach ($columnHeaders as $columnHeader) {
            echo Html::tag(
                'th',
                strtoupper(str_replace('_', ' ', $columnHeader)),
                ['scope' => 'col', 'class' => '']
            );
        }
        echo Html::endTag('tr');
        echo Html::endTag('thead');
    }

    private function renderTableBody()
    {
        echo Html::beginTag('tbody');
        foreach ($this->data as $row) {
            $this->renderTableRow($row);
        }
        echo Html::endTag('tbody');
    }

    private function renderTableRow($row)
    {
        echo Html::beginTag('tr');
        if ($this->includeSerialCount) {
            echo Html::tag('td', ++$this->index);
        }
        foreach ($row as $cell) {
            echo Html::tag('td', $cell);
        }
        echo Html::endTag('tr');
    }
}
