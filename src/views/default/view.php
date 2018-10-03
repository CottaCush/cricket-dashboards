<?php

use CottaCush\Cricket\Dashboard\Widgets\DashboardViewWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = ArrayHelper::getValue($dashboard, 'name');

$this->params['breadcrumbs'] = [
    $dashboard->name,
];

echo Html::beginTag('div', ['class' => 'cricket-wrapper']);
echo DashboardViewWidget::widget(['dashboard' => $dashboard]);
echo Html::endTag('div'); //cricket-wrapper
