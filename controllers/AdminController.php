<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Decision;

class AdminController extends Controller
{
    public function actionIndex()
    {
        // Проверяем наличие токена в запросе
        $token = Yii::$app->request->get('token');
        if ($token !== 'xyz123') {
            throw new \yii\web\ForbiddenHttpException('Access denied');
        }

        $decisions = Decision::find()->all();

        return $this->render('index', [
            'decisions' => $decisions,
        ]);
    }

    public function actionDelete($id)
    {
        // Проверяем наличие токена в запросе
        $token = Yii::$app->request->get('token');
        if ($token !== 'xyz123') {
            throw new \yii\web\ForbiddenHttpException('Access denied');
        }

        $decision = Decision::findOne($id);
        if ($decision) {
            $decision->delete();
        }

        return $this->redirect(['index', 'token' => 'xyz123']);
    }
}
