<?php

namespace CottaCush\Cricket\Dashboards\Assets;

use CottaCush\Cricket\Assets\BaseCricketAsset;

/**
 * Class BaseDashboardsAsset
 * @package CottaCush\Cricket\Dashboards\Assets
 * Extend the CottaCush AssetBundle and set $basePath / $baseUrl properties
 * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
 */
class BaseDashboardsAsset extends BaseCricketAsset
{
    /**
     * The main public assets directory.
     */
    const ASSETS_PATH = __DIR__ . '/../asset-files';
    /**
     * The public js asset directory
     */
    const ASSETS_JS_PATH = self::ASSETS_PATH . '/js';
    /**
     * The public css asset directory
     */
    const ASSETS_CSS_PATH = self::ASSETS_PATH . '/css';

    /**
     * Set the sourcePath as self::ASSETS_PATH by default.
     * @inheritdoc
     */
    public $sourcePath = self::ASSETS_PATH;
}
