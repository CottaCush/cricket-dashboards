<?php

namespace CottaCush\Cricket\Dashboard\Models;

use CottaCush\Cricket\Models\BaseCricketModel;

/**
 * This is the model class for table "dashboards".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $project_id
 * @property string $status
 * @property int $is_active
 * @property string $created_at
 * @property int $created_by
 * @property string $last_updated_at
 * @property int $last_updated_by
 *
 * @property Widget[] $widgets
 */
class Dashboard extends BaseCricketModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_dashboards}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['created_at', 'last_updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'created_at' => 'Created At',
            'last_updated_at' => 'Last Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgets()
    {
        return $this->hasMany(Widget::class, ['dashboard_id' => 'id'])->orderBy(['location' => 'ASC']);
    }

    public static function getOne($id)
    {
        return self::find()->where([self::tableName() . '.id' => $id])
            ->joinWith(['widgets.queryObj.placeholders'])
            ->one();
    }
}
