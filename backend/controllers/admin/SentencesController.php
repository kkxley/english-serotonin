<?php

declare(strict_types=1);


namespace app\controllers\admin;

use Serotonin\English\Sentence\Sentence;
use Serotonin\English\Theme\Theme;
use Yii;
use yii\web\Controller;

class SentencesController extends Controller
{
    public function actionAll(): \yii\web\Response
    {
        $limit = 10;
        $themePath = Yii::$app->getRequest()->getQueryParam('themePath', null);
        $page = Yii::$app->getRequest()->getQueryParam('page', 1);

        $sentences = Sentence::find();

        if ($themePath) {
            $themeId = Theme::find()
                ->select('theme_id')
                ->where(['path' => $themePath])
                ->scalar();
            $sentences = $sentences->where(['theme_id' => $themeId]);
        }

        return $this->asJson(
            $sentences->limit($limit)
                ->offset($limit * ($page - 1))
                ->all()
        );
    }

    public function actionAdd(): \yii\web\Response
    {
        $theme = Yii::$app->request->post('theme');
        $type = Yii::$app->request->post('type');
        $russian = Yii::$app->request->post('russian');
        $english = Yii::$app->request->post('english');

        $themeId = Theme::find()
            ->select('theme_id')
            ->where(['path' => $theme])
            ->scalar();

        $sentences = new Sentence();

        $sentences->theme_id = $themeId;
        $sentences->russian = $russian;
        $sentences->english = $english;
        $sentences->type_id = $type;

        return $this->asJson([
            'success' => $sentences->save()
        ]);
    }
}