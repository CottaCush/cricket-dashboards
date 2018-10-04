<?php

namespace CottaCush\Cricket\Report\Assets;

/**
 * Class DashboardsAsset
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Report\Assets
 */
class DashboardsAsset extends BaseDashboardsAsset
{
    public $css = [
        'css/styles.css'
    ];

    public $depends = [
        'CottaCush\Cricket\Assets\CricketAsset'
    ];
}
