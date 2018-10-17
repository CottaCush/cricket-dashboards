<?php

namespace CottaCush\Cricket\Dashboards\Assets;

/**
 * Class JsPdfAsset
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 * @package CottaCush\Cricket\Dashboards\Assets
 */
class JsPdfAsset extends BaseDashboardsAsset
{
    /**
     * Set the sourcePath as self::ASSETS_PATH by default.
     * @inheritdoc
     */
    public $sourcePath = __DIR__ . '/../asset-files/plugins/jspdf/';

    public $js = [
        'jspdf.min.js'
    ];
}
