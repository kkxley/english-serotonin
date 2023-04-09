<?php

declare(strict_types=1);


namespace app\controllers;

use Serotonin\English\Sentence\Sentence;
use Serotonin\English\SentenceType\SentenceType;
use Serotonin\English\Theme\Theme;
use Serotonin\English\Word\Word;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SentencesController extends Controller
{
    public function actionIndex(string $themePath)
    {
        $typeIds = array_filter(explode(',', Yii::$app->getRequest()->getQueryParam('types')));

        $themeId = Theme::find()
            ->select('theme_id')
            ->where(['path' => $themePath])
            ->scalar();

        $max = Sentence::find()
            ->where(['theme_id' => $themeId])
            ->andWhere(['in', 'type_id', $typeIds])
            ->count();

        if ($max === 0) {
            return $this->asJson(['success' => false]);
        }

        $offset = mt_rand(0, $max - 1);

        $sentence = Sentence::find()
            ->where(['theme_id' => $themeId])
            ->andWhere(['in', 'type_id', $typeIds])
            ->offset($offset)
            ->one();

        if ($sentence === null) {
            return $this->asJson(['success' => false]);
        }

        $confusionWords = Word::findConfusionWords(...$sentence->getEnglishWords());

        return $this->asJson(
            array_merge(
                $sentence->serialize(),
                [
                    'words' => $confusionWords,
                    'success' => true
                ]
            )
        );
    }

    public function actionTypes(): \yii\web\Response
    {
        $types = SentenceType::find()->all();

        return $this->asJson(
            [
                'types' => array_map(fn(SentenceType $type) => $type->serialize(), $types)
            ]
        );
    }
}