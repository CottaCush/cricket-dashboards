<?php

namespace CottaCush\Cricket\Dashboards\Assets;

/**
 * Class Html2CanvasAsset
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Dashboards\Assets
 */
class Html2CanvasAsset extends BaseDashboardsAsset
{
    /**
     * Set the sourcePath as self::ASSETS_PATH by default.
     * @inheritdoc
     */
    public $sourcePath = __DIR__ . '/../asset-files/plugins/html2canvas/';

    public $js = [
        'html2canvas.min.js'
    ];
}
