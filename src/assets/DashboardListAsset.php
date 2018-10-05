<?php

namespace CottaCush\Cricket\Dashboards\Assets;

/**
 * Class DashboardListAsset
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Dashboards\Assets
 */
class DashboardListAsset extends BaseDashboardsAsset
{
    public $depends = [
        'CottaCush\Cricket\Report\Assets\DashboardsAsset',
    ];
}
