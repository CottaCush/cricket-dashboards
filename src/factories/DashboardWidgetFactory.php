<?php

namespace CottaCush\Cricket\Dashboard\Factories;

use CottaCush\Cricket\Dashboard\Widgets\CountWidget;
use CottaCush\Cricket\Interfaces\CricketQueryableInterface;
use yii\db\Connection;

class DashboardWidgetFactory
{
    const TYPE_COUNT = 'count';

    private $dbConnection;

    public function __construct(Connection $dbConnection = null)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @param CricketQueryableInterface $model
     * @return CountWidget
     */
    public function createWidget(CricketQueryableInterface $model)
    {
        switch ($model->type) {
            case self::TYPE_COUNT:
                return new CountWidget(['model' => $model, 'dbConnection' => $this->dbConnection]);
        }
    }
}
