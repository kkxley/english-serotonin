<?php

declare(strict_types=1);

namespace Serotonin\English\Word;

use yii\db\ActiveRecord;
use yii\db\conditions\InCondition;
use yii\db\conditions\LikeCondition;
use yii\db\Query;

class Word extends ActiveRecord
{
    public static function tableName()
    {
        return '{{word}}';
    }

    public function getSourceWord(): string
    {
        return $this->getAttribute('source');
    }

    public function getConfusionWords(): string
    {
        return $this->getAttribute('confusion');
    }

    /**
     * @param string ...$baseWords
     * @return array
     */
    static public function findConfusionWords(string ...$baseWords): array
    {
        $query = Word::find()
            ->where(new InCondition('source', 'IN', $baseWords));

        $words = array_reduce($query->all(), function (array $list, Word $word) {
            $list[] = $word->getSourceWord();
            $confusion = trim($word->getConfusionWords(), '|');
            return [...$list, ...explode('|', $confusion)];
        }, []);

        shuffle($words);

        $result = array_unique([...$baseWords, ...array_slice($words, 0, 10)]);
        shuffle($result);
        return $result;
    }
}