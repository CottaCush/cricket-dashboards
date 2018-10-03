<?php

namespace CottaCush\Cricket\Report\Assets;

/**
 * Class DashboardListAsset
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Report\Assets
 */
class DashboardViewAsset extends BaseDashboardsAsset
{
    public $depends = [
        'CottaCush\Cricket\Report\Assets\DashboardsAsset'
    ];
}
