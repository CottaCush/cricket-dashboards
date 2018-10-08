<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Cricket\Dashboards\Assets\DashboardListAsset;
use CottaCush\Cricket\Libs\Utils;
use CottaCush\Cricket\Widgets\BaseCricketWidget;
use CottaCush\Yii2\Helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class DashboardListWidget
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Dashboards\Widgets
 */
class DashboardListWidget extends BaseCricketWidget
{
    public $dashboards = [];

    public $showTitle = false;

    public function init()
    {
        DashboardListAsset::register($this->view);
        parent::init();
    }

    public function run()
    {
        $this->renderDashboards();
    }

    private function renderDashboards()
    {
        echo $this->beginDiv('cricket-dashboard-list');
        echo $this->beginDiv('row');
        foreach ($this->dashboards as $dashboard) {
            echo $this->beginDiv('col-lg-3 col-md-3 col-sm-4 col-xs-12');
            echo $this->beginDiv('cricket-dashboard-list__item');
            echo Html::a(
                ArrayHelper::getValue($dashboard, 'name'),
                Url::toRoute(['view', 'id' => Utils::encodeId(ArrayHelper::getValue($dashboard, 'id'))]),
                ['class' => 'cricket-dashboard-list__item-link']
            );
            echo $this->endDiv();
            echo $this->endDiv();
        }
        echo $this->endDiv();
        echo $this->endDiv();
    }
}
