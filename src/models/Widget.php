<?php

namespace CottaCush\Cricket\Dashboards\Models;

use CottaCush\Cricket\Interfaces\CricketQueryableInterface;
use CottaCush\Cricket\Models\BaseCricketModel;
use CottaCush\Cricket\Models\Query;

/**
 * This is the model class for table "widgets".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $location
 * @property int $dashboard_id
 * @property int $query_id
 * @property int $is_active
 * @property int $order
 *
 * @property Dashboard $dashboard
 * @property Query $queryObj
 */
class Widget extends BaseCricketModel implements CricketQueryableInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_widgets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'location', 'dashboard_id'], 'required'],
            [['dashboard_id', 'query_id'], 'integer'],
            [['name', 'type', 'location'], 'string', 'max' => 255],
            [
                ['dashboard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dashboard::class,
                'targetAttribute' => ['dashboard_id' => 'id']
            ],
            [
                ['query_id'], 'exist', 'skipOnError' => true, 'targetClass' => Query::class,
                'targetAttribute' => ['query_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'location' => 'Location',
            'dashboard_id' => 'Dashboard ID',
            'query_id' => 'Query ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDashboard()
    {
        return $this->hasOne(Dashboard::class, ['id' => 'dashboard_id']);
    }

    public function getQueryObj()
    {
        return $this->hasOne(Query::class, ['id' => 'query_id']);
    }

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @return \CottaCush\Cricket\Interfaces\QueryInterface|Query
     */
    public function getQuery()
    {
        return $this->queryObj;
    }
}
