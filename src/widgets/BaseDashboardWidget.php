<?php

namespace CottaCush\Cricket\Widgets;

use CottaCush\Cricket\Dashboard\Models\Widget;
use CottaCush\Cricket\Generators\SQLQueryBuilderParser;
use CottaCush\Yii2\Widgets\BaseWidget as Yii2BaseWidget;

/**
 * Class BaseDashboardWidget
 * @package CottaCush\Cricket\Widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class BaseDashboardWidget extends Yii2BaseWidget
{
    /** @var Widget */
    public $model;

    /** @var SQLQueryBuilderParser */
    public $parser;

    const LOCATION_TOP = 'top';
    const LOCATION_MIDDLE = 'middle';
    const LOCATION_BOTTOM = 'bottom';

    public static $sizes = [
        self::LOCATION_TOP => 'col-lg-3 col-md-3 col-sm-6 col-xs-12',
        self::LOCATION_MIDDLE => 'col-lg-4 col-sm-6 col-xs-12',
        self::LOCATION_BOTTOM => 'col-sm-6 col-xs-12'
    ];

    protected function getData()
    {
    }
}
