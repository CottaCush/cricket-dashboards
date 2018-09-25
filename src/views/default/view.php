<?php

use CottaCush\Cricket\Dashboard\Widgets\DashboardViewWidget;
use yii\helpers\ArrayHelper;

$this->title = ArrayHelper::getValue($dashboard, 'name');

$this->params['breadcrumbs'] = [
    $dashboard->name,
];

echo DashboardViewWidget::widget(['dashboard' => $dashboard]);
