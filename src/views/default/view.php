<?php

use CottaCush\Cricket\Dashboards\Widgets\DashboardViewWidget;
use CottaCush\Cricket\Dashboards\Widgets\DownloadDashboardDropdownWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = ArrayHelper::getValue($dashboard, 'name');

$this->params['breadcrumbs'] = [
    $dashboard->name,
];

echo DownloadDashboardDropdownWidget::widget();

echo Html::beginTag('div', ['class' => 'cricket-wrapper']);
echo DashboardViewWidget::widget(['dashboard' => $dashboard]);
echo Html::endTag('div'); //cricket-wrapper
