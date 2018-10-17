<?php

namespace CottaCush\Cricket\Dashboards\Assets;

/**
 * Class DownloadDashboardAsset
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Dashboards\Assets
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
