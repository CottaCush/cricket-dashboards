<?php

namespace CottaCush\Cricket\Dashboards;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module as BaseModule;
use yii\db\Connection;

/**
 * Class Module
 * @package CottaCush\Cricket\Dashboards
 * @author Olawale Lawal <wale@cottacush.com>
 */
class Module extends BaseModule
{
    public $controllerNamespace = 'CottaCush\Cricket\Dashboards\Controllers';
    public $layout = 'main';

    public $permissionValues;

    /** @var Connection */
    public $db = null;

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if (isset($this->db)) {
            Yii::$app->set('db', $this->db);
        }

        $this->params['permissionValues'] = $this->getReportPermissionFilter();
    }

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @return mixed|null
     */
    public function getReportPermissionFilter()
    {
        $values = null;

        if ($this->permissionValues instanceof \Closure) { //Callback
            $callback = $this->permissionValues;
            $values = $callback($this);
        } else { //Use the flat value
            $values = $this->permissionValues;
        }

        return $values;
    }
}
