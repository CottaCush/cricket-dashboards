<?php

use CottaCush\Cricket\Dashboards\Widgets\DashboardViewWidget;
use CottaCush\Cricket\Dashboards\Widgets\DownloadDashboardDropdownWidget;
use CottaCush\Cricket\Widgets\DateRangePickerWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = ArrayHelper::getValue($dashboard, 'name');

$this->params['breadcrumbs'] = [
    $dashboard->name,
];

echo Html::beginTag('div', ['class' => 'row']);
echo DownloadDashboardDropdownWidget::widget();

echo DateRangePickerWidget::widget([
    'startDate' => $startDate,
    'endDate' => $endDate,
    'action' => Url::toRoute(['', 'id' => $dashboard->id])
]);
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'cricket-wrapper']);
echo DashboardViewWidget::widget(['dashboard' => $dashboard]);
echo Html::endTag('div'); //cricket-wrapper
