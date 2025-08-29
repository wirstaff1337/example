<?php

namespace app\controllers;

use app\models\Author;
use app\models\Subscription;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\Response;

class SubscriptionsController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionIndex(): string|Response
    {
        $model = new Subscription();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Вы успешно подписались!');
            return $this->redirect(['index']);
        }

        $authors = Author::find()->all();

        return $this->render('index', [
            'model' => $model,
            'authors' => $authors,
        ]);
    }
}