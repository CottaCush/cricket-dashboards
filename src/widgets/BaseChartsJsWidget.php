<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Cricket\Dashboards\Assets\ChartJSAsset;
use CottaCush\Yii2\Helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\JsExpression;

abstract class BaseChartsJsWidget extends BaseDashboardWidget
{
    public $options;
    public $clientOptions = [];
    public $plugins;

    public static $colours = [
        ['hex' => '#E9967A', 'rgb' => '233, 150, 122'],
        ['hex' => '#00BFFF', 'rgb' => '0, 191, 255'],
        ['hex' => '#FFD700', 'rgb' => '255, 215, 0'],
        ['hex' => '#FFFFE0', 'rgb' => '255, 255, 224'],
        ['hex' => '#66CDAA', 'rgb' => '102, 205, 170'],
        ['hex' => '#FF69B4', 'rgb' => '255, 105, 180'],
        ['hex' => '#FF7F50', 'rgb' => '255, 127, 80'],
        ['hex' => '#EEE8AA', 'rgb' => '238, 232, 170'],
        ['hex' => '#B0C4DE', 'rgb' => '176, 196, 222'],
        ['hex' => '#FFB6C1', 'rgb' => '255, 182, 193'],
        ['hex' => '#9ACD32', 'rgb' => '154, 205, 50'],
        ['hex' => '#DB7093', 'rgb' => '219, 112, 147'],
        ['hex' => '#F0E68C', 'rgb' => '240, 230, 140'],
        ['hex' => '#DA70D6', 'rgb' => '218, 112, 214'],
        ['hex' => '#E6E6FA', 'rgb' => '230, 230, 250'],
        ['hex' => '#FF6347', 'rgb' => '255, 99, 71'],
        ['hex' => '#FFDEAD', 'rgb' => '255, 222, 173'],
        ['hex' => '#00CED1', 'rgb' => '0, 206, 209'],
        ['hex' => '#C0C0C0', 'rgb' => '192, 192, 192'],
        ['hex' => '#FFC0CB', 'rgb' => '255, 192, 203'],
        ['hex' => '#BC8F8F', 'rgb' => '188, 143, 143'],
        ['hex' => '#AFEEEE', 'rgb' => '175, 238, 238'],
        ['hex' => '#FA8072', 'rgb' => '250, 128, 114'],
        ['hex' => '#FFFACD', 'rgb' => '255, 250, 205'],
        ['hex' => '#9370DB', 'rgb' => '147, 112, 219'],
        ['hex' => '#98FB98', 'rgb' => '152, 251, 152'],
        ['hex' => '#F08080', 'rgb' => '240, 128, 128'],
        ['hex' => '#FFE4E1', 'rgb' => '255, 228, 225'],
        ['hex' => '#FFA500', 'rgb' => '255, 165, 0'],
        ['hex' => '#ADD8E6', 'rgb' => '173, 216, 230'],
        ['hex' => '#CD5C5C', 'rgb' => '205, 92, 92'],
        ['hex' => '#FFDAB9', 'rgb' => '255, 218, 185'],
        ['hex' => '#D8BFD8', 'rgb' => '216, 191, 216'],
        ['hex' => '#3CB371', 'rgb' => '60, 179, 113'],
        ['hex' => '#F5F5DC', 'rgb' => '245, 245, 220'],
        ['hex' => '#FFA07A', 'rgb' => '255, 160, 122']
    ];

    private static $chartTypeMap = [
        self::TYPE_BAR_CHART => 'bar',
        self::TYPE_PIE_CHART => 'pie',
        self::TYPE_LINE_CHART => 'line',
        self::TYPE_DOUGHNUT => 'doughnut',
        self::TYPE_SCATTER_PLOT => 'scatter',
        self::TYPE_AREA_GRAPH => 'line'
    ];

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     */
    public function init()
    {
        parent::init();

        if (!isset($this->options['id'])) {
            $this->options['id'] = 'widget_' . $this->model->id;
        }

        $this->columns = $this->getDataColumns();
    }

    protected function renderHeader()
    {
        echo $this->beginDiv('cricket-card-header border-bottom');
        echo Html::tag('span', $this->model->name, ['class' => 'h4 cricket-widget-title']);
        echo Html::tag(
            'span',
            Html::a(
                '',
                '',
                [
                    'class' => "fa fa-search-plus zoom-widget-btn",
                    'id' => "zoom-widget-btn-{$this->model->id}",
                    'data-toggle' => 'modal',
                    'data-target' => '#zoomWidgetModal',
                    'data-html2canvas-ignore' => true
                ]
            ),
            ['class' => 'pull-right']
        );
        echo $this->endDiv();
    }

    protected function renderBody()
    {
        echo $this->beginDiv('cricket-card-body');

        $this->renderFilter();
        $this->renderChart();

        echo $this->endDiv();

        $this->registerClientScript();
    }

    private function renderChart()
    {
        echo $this->beginDiv('');
        echo Html::tag('canvas', null, $this->options);
        echo $this->endDiv();
    }

    /**
     * Registers the required js files and script to initialize ChartJS plugin
     */
    protected function registerClientScript()
    {
        $id = $this->options['id'];
        ChartJsAsset::register($this->view);
        $config = Json::encode([
            'type' => $this->getChartsJSType(),
            'data' => $this->getTransformedData() ?: new JsExpression('{}'),
            'options' => $this->clientOptions ?: new JsExpression('{}'),
            'plugins' => $this->plugins
        ]);

        $js[] = "var chartJS_{$id} = new Chart($('#{$id}'), {$config});";

        //Script to handle zooming of chart widgets
        $js[] = "$('#zoom-widget-btn-{$this->model->id}').on('click', function () {
            modalTitle  = $(this).parent().parent().parent().find($('.cricket-widget-title')).html();
            imageSrc = chartJS_{$id}.toBase64Image();
            $('#zoomWidgetModal').find('.modal-title').html(modalTitle);
            $('#zoomWidgetModal').find('.modal-body').html('<canvas id=\"modal{$id}\"></canvas>');
            var canvas{$id} = new Chart($('#modal{$id}'), {$config});
        });";

        $this->view->registerJs(implode("\n", $js));
    }

    protected function getRandomColors($count = 1, $format = 'rgb', $isRandom = false)
    {
        $colors = self::$colours;
        if ($isRandom) {
            shuffle($colors);
        }

        if ($count < 2) {
            $color = current($colors);
            return $color[$format];
        }

        $colors = array_slice($colors, 0, $count);
        return ArrayHelper::getColumn($colors, $format, []);
    }

    protected function renderFooter()
    {
        echo $this->beginDiv('cricket-card-footer border-top');

        echo $this->beginDiv('text-right ');
        echo '&nbsp;';
        echo $this->endDiv();

        echo $this->endDiv();
    }

    protected function getTransformedData()
    {
        return $this->data;
    }

    private function getChartsJSType()
    {
        return ArrayHelper::getValue(self::$chartTypeMap, $this->model->type, 'bar');
    }
}
