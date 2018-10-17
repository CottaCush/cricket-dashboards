<?php

namespace CottaCush\Cricket\Dashboards\Assets;

/**
 * Class DashboardsAsset
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Report\Assets
 */
class DownloadDashboardAsset extends BaseDashboardsAsset
{
    public $js = [
        'js/download-dashboard.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'CottaCush\Cricket\Dashboards\Assets\Html2CanvasAsset',
        'CottaCush\Cricket\Dashboards\Assets\JsPdfAsset'
    ];
}
