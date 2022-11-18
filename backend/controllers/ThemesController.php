<?php

namespace app\controllers;

use Serotonin\English\Theme\Theme;
use yii\web\Controller;

class ThemesController extends Controller
{
    public function actionIndex()
    {
        $themes = array_map(fn (Theme $theme) => $theme->serialize(), Theme::find()->all());
        return $this->asJson($themes);
    }
}