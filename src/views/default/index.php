<?php

use CottaCush\Cricket\Dashboards\Widgets\DashboardListWidget;
use CottaCush\Yii2\Widgets\EmptyStateWidget;
use yii\helpers\Html;

$this->title = 'Dashboards';
$this->params['breadcrumbs'] = [
    $this->title
];

echo Html::beginTag('div', ['class' => 'cricket-wrapper']);
if ($count == 0) :
    echo EmptyStateWidget::widget([
        'icon' => 'file-text',
        'description' => 'No dashboards have been created yet'
    ]);
else :
    echo DashboardListWidget::widget([
        'dashboards' => $dashboards
    ]);
endif;
echo Html::endTag('div'); //cricket-wrapper
