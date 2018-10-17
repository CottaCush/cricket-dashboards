<?php

use CottaCush\Cricket\Dashboards\Models\Dashboard;
use CottaCush\Cricket\Dashboards\Widgets\DashboardViewWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = ArrayHelper::getValue($dashboard, 'name');

$this->params['breadcrumbs'] = [
    $dashboard->name,
];

echo Html::beginTag('div', ['class' => 'text-right']);
echo Html::beginTag('div', ['class' => 'btn-group']);
echo Html::button(
    'Download ' . Html::tag('span', '', ['class' => 'caret']),
    [
        'id' => 'downloadBtn',
        'class' => 'btn btn-default dropdown-toggle',
        'data-toggle' => 'dropdown',
        'aria-haspopup' => 'true',
        'aria-expanded' => 'false'
    ]
);
echo Html::ul(Dashboard::DOWNLOAD_FORMATS, ['item' => function ($item, $index) {
    $link = Html::a($item['type'], '', ['id' => $item['id'], 'class' => $item['class'], 'data-type' => $item['type']]);
    return "<li>{$link}</li>";
}, 'class' => 'dropdown-menu cricket-dashboard-menu']);
echo Html::endTag('div');
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'cricket-wrapper']);
echo DashboardViewWidget::widget(['dashboard' => $dashboard]);
echo Html::endTag('div'); //cricket-wrapper
