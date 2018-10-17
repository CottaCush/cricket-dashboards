<?php

namespace CottaCush\Cricket\Dashboards\Widgets;

use CottaCush\Cricket\Dashboards\Assets\DownloadDashboardAsset;
use CottaCush\Cricket\Dashboards\Models\Dashboard;
use CottaCush\Yii2\Helpers\Html;
use CottaCush\Yii2\Widgets\BaseWidget as Yii2BaseWidget;

/**
 * Class DownloadDashboardDropdownWidget
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Dashboards\Widgets
 */
class DownloadDashboardDropdownWidget extends Yii2BaseWidget
{
    public function init()
    {
        parent::init();
        DownloadDashboardAsset::register($this->view);
    }

    public function run()
    {
        echo Html::beginTag('div', ['class' => 'text-right cricket-dropdown']);
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
            $link = Html::a(
                $item['type'],
                '',
                ['id' => $item['id'], 'class' => $item['class'], 'data-type' => $item['type']]
            );
            return "<li>{$link}</li>";
        }, 'class' => 'dropdown-menu cricket-dropdown-menu']);
        echo Html::endTag('div');
        echo Html::endTag('div');
        echo Html::tag('br');
    }
}
