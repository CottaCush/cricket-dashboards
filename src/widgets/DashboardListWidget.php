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
        $this->beginDiv('container');
        $this->beginDiv('row dashboard-list');
        foreach ($this->dashboards as $dashboard) {
            $this->beginDiv('dashboard-list__item col-sm');
            echo Html::a(
                ArrayHelper::getValue($dashboard, 'name'),
                Url::toRoute(['view', 'id' => Utils::encodeId(ArrayHelper::getValue($dashboard, 'id'))]),
                ['class' => 'dashboard-list__item-link']
            );
            $this->endDiv();
        }
        $this->endDiv();
        $this->endDiv();
    }
}
