<?php

declare(strict_types=1);


namespace app\controllers;

use Serotonin\English\Sentence\Sentence;
use Serotonin\English\Word\Word;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SentencesController extends Controller
{
    public function actionIndex(int $themeId)
    {
        $max = Sentence::find()
            ->where(['theme_id' => $themeId])
            ->count();
        $offset = mt_rand(0, $max - 1);

        $sentence = Sentence::find()
            ->where(['theme_id' => $themeId])
            ->offset($offset)
            ->one();

        if ($sentence === null) {
            throw new NotFoundHttpException();
        }

        $confusionWords = Word::findConfusionWords(...$sentence->getEnglishWords());

        return $this->asJson(
            array_merge(
                $sentence->serialize(),
                [
                    'words' => $confusionWords
                ]
            )
        );
    }
}