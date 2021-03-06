<?php

namespace CottaCush\Cricket\Dashboards\Assets;

/**
 * Class ChartJSAsset
 * @package CottaCush\Cricket\Dashboards\Assets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class ChartJSAsset extends BaseDashboardsAsset
{
    /**
     * Set the sourcePath as self::ASSETS_PATH by default.
     * @inheritdoc
     */
    public $sourcePath = __DIR__ . '/../asset-files/plugins/chartsjs/';

    public $js = [
        'Chart.bundle.js',
        'charts_defaults.js'
    ];

    public $productionJs = [
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js',
        'charts_defaults.js'
    ];

    public $depends = [
        'CottaCush\Cricket\Assets\CricketAsset',
    ];
}
