<?php

namespace app\controllers;

use Serotonin\English\Theme\Theme;
use yii\web\Controller;

class ThemesController extends Controller
{
    public function actionAll()
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


        return $this->asJson(array_values($tree));
    }

    public function actionIndex(string $themePath)
    {
        /** @var Theme $theme */
        $theme = Theme::find()
            ->where(['path' => $themePath])
            ->one();
        if ($theme->isRoot()) {
            return $this->asJson(['theme' => $theme->serialize()]);
        }

        /** @var Theme $parent */
        $parent = Theme::find()
            ->where(['theme_id' => $theme->getParentId()])
            ->one();

        return $this->asJson(['theme' => array_merge(
            $theme->serialize(),
            ['parent' => $parent->serialize()],
        )]);
    }
}