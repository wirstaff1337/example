<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class BooksController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->with('authors'),
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
        $model = new Book();

        if ($model->load(Yii::$app->request->post())) {
            $model->cover_image = UploadedFile::getInstance($model, 'cover_image');
            if ($model->cover_image) {
                $model->cover_image->saveAs('uploads/' . $model->cover_image->baseName . '.' . $model->cover_image->extension);
                $model->cover_image = 'uploads/' . $model->cover_image->baseName . '.' . $model->cover_image->extension;
            }

            if ($model->save()) {
                $request = Yii::$app->request;
                if (!empty($request->post('Book')['authors'])) {
                    foreach ($request->post('Book')['authors'] as $authorId) {
                        $model->link('authors', Author::findOne($authorId));
                    }
                }
                return $this->redirect(['index']);
            }
        }

        $authors = Author::find()->all();

        return $this->render('store', [
            'model' => $model,
            'authors' => $authors,
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);

        if ($model && $model->load(Yii::$app->request->post())) {
            $model->cover_image = UploadedFile::getInstance($model, 'cover_image');
            if ($model->cover_image) {
                $model->cover_image->saveAs('uploads/' . $model->cover_image->baseName . '.' . $model->cover_image->extension);
                $model->cover_image = 'uploads/' . $model->cover_image->baseName . '.' . $model->cover_image->extension;
            }

            if ($model->save()) {
                $model->unlinkAll('authors', true);
                $request = Yii::$app->request;
                if (!empty($request->post('Book')['authors'])) {
                    foreach ($request->post('Book')['authors'] as $authorId) {
                        $model->link('authors', Author::findOne($authorId));
                    }
                }
                return $this->redirect(['index']);
            }
        }

        $authors = Author::find()->all();

        return $this->render('edit', [
            'model' => $model,
            'authors' => $authors,
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


    protected function findModel(int $id): ?Book
    {
        return Book::findOne($id);
    }
}