<?php

namespace app\controllers;

use app\models\Author;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\Response;

class AuthorsController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Author::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionCreate(): string|Response
    {
        $model = new Author();

        if ($model && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('store', [
            'model' => $model,
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);

        if ($model && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)?->delete();

        return $this->redirect(['index']);
    }

    public function actionTop(int $year): string
    {
        $authors = Author::find()
            ->select(['authors.id', 'authors.name', 'COUNT(books.id) AS book_count'])
            ->joinWith('books')
            ->where(['books.year' => $year])
            ->groupBy('authors.id')
            ->orderBy(['book_count' => SORT_DESC])
            ->limit(10)
            ->all();

        return $this->render('top-authors', ['authors' => $authors]);
    }

    private function findModel(int $id): ?Author
    {
        return Author::findOne($id);
    }
}