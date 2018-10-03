<?php

namespace CottaCush\Cricket\Dashboard\Controllers;

use CottaCush\Cricket\Constants\Messages;
use CottaCush\Cricket\Controllers\BaseCricketController;
use CottaCush\Cricket\Dashboard\Models\Dashboard;
use CottaCush\Cricket\Libs\Utils;
use yii\data\ActiveDataProvider;

class DefaultController extends BaseCricketController
{
    /**
     * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Dashboard::getDashboards(),
            'sort' => [
                'defaultOrder' => ['name' => SORT_DESC],
                'attributes' => ['name', 'description']
            ],
            'pagination' => [
                'defaultPageSize' => 20
            ],
        ]);

        return $this->render('index', ['reports' => $dataProvider]);
    }

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @param null $id
     * @return string|\yii\web\Response
     */
    public function actionView($id = null)
    {
        $decodedId = Utils::decodeId($id);

        /** @var Dashboard $dashboard */
        $dashboard = Dashboard::getOne($decodedId);

        if (!$dashboard) {
            return $this->returnNotification(
                self::FLASH_ERROR_KEY,
                Messages::getNotFoundMessage(Messages::ENTITY_DASHBOARD)
            );
        }

        return $this->render('view', ['dashboard' => $dashboard]);
    }
}
