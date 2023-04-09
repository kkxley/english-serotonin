<?php

namespace app\controllers;

use Serotonin\English\Theme\Theme;
use yii\web\Controller;

class ThemesController extends Controller
{
    public function actionIndex()
    {
        $themes = Theme::find()->all();
        $tree = array_reduce($themes, function ($tree, Theme $theme) {
            if ($theme->isRoot()) {
                $tree[$theme->getId()] = [
                    ...$theme->serialize(),
                    ...($tree[$theme->getId()] ?? [])
                ];

                return $tree;
            }

            $tree[$theme->getParentId()]["child"][] = $theme->serialize();

            return $tree;
        }, []);


        return $this->asJson($tree);
    }
}