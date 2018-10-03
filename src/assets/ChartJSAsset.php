<?php

namespace CottaCush\Cricket\Dashboard\Assets;

use CottaCush\Cricket\Assets\BaseCricketAsset;

/**
 * Class ChartJSAsset
 * @package CottaCush\Cricket\Dashboard\Assets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class ChartJSAsset extends BaseCricketAsset
{
    /**
     * Set the sourcePath as self::ASSETS_PATH by default.
     * @inheritdoc
     */
    public $sourcePath = __DIR__ . '/../asset-files/plugins/chartsjs/';

    public $js = [
        'Chart.bundle.min.js',
        'charts_defaults.js'
    ];
    public $css = [
        'custom-bootstrap.css',
        'dashboard_styles.css'
    ];

    public $productionJs = [
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js',
    ];

    public $depends = [
        'CottaCush\Cricket\Assets\BaseCricketAsset',
    ];
}
