<?php

declare(strict_types=1);


namespace Serotonin\English\SentenceType;

use yii\db\ActiveRecord;

class SentenceType extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{sentence_types}}';
    }

    public function getId(): int
    {
        return (int)$this->getAttribute('type_id');
    }

    public function getTitle(): string
    {
        return $this->getAttribute('title');
    }

    public function serialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle()
        ];
    }
}