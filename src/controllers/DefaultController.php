<?php

namespace CottaCush\Cricket\Dashboard\Controllers;

use CottaCush\Cricket\Constants\Messages;
use CottaCush\Cricket\Controllers\BaseCricketController;
use CottaCush\Cricket\Dashboard\Models\Dashboard;
use CottaCush\Cricket\Libs\Utils;
use yii\helpers\ArrayHelper;

class DefaultController extends BaseCricketController
{
    /**
     * @author Taiwo Ladipo <taiwo.ladipo@cottacush.com>
     * @return string
     */
    public function actionIndex()
    {
        $dashboards = Dashboard::getDashboards()->asArray()->all();
        $count = count($dashboards);

        if ($count == 1) {
            $dashboard = ArrayHelper::getValue($dashboards, 0);
            return $this->redirect(['view', 'id' => Utils::encodeId(ArrayHelper::getValue($dashboard, 'id'))]);
        }

        return $this->render('index', ['dashboards' => $dashboards, 'count' => $count]);
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
