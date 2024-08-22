<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Decision;

class SiteController extends Controller
{
    public function actionIndex()
    {
        // Получаем ID случайного изображения из диапазона
        $imageId = rand(1, 1000); // Выберите диапазон по своему усмотрению

        // Проверяем, что изображение не было отклонено ранее
        $decision = Decision::findOne(['image_id' => $imageId]);

        if ($decision) {
            // Если изображение было решено, то выбираем другое
            return $this->actionIndex();
        }

        return $this->render('index', [
            'imageId' => $imageId,
        ]);
    }

    public function actionDecision()
    {
        if (Yii::$app->request->isAjax) {
            $imageId = Yii::$app->request->post('image_id');
            $decision = Yii::$app->request->post('decision');

            // Сохраняем решение
            $model = new Decision();
            $model->image_id = $imageId;
            $model->decision = $decision;
            $model->save();

            return $this->asJson(['success' => true]);
        }
        throw new \yii\web\BadRequestHttpException('Invalid request');
    }
}
