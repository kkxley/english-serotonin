<?php

declare(strict_types=1);

namespace Serotonin\English\Sentence;

use yii\db\ActiveRecord;

class Sentence extends ActiveRecord
{
    public static function tableName()
    {
        return '{{sentence}}';
    }

    public function getId(): int
    {
        return (int)$this->getAttribute('sentence_id');
    }

    public function getRussian(): string
    {
        return $this->getAttribute('russian');
    }

    public function getEnglish(): string
    {
        return $this->getAttribute('english');
    }

    public function getEnglishWords(): array
    {
        $sentence = $this->getEnglish();
        $sentence = preg_replace('/[,.!?]/', '', $sentence);
        $sentence = mb_strtolower($sentence);

        return array_map(fn(string $word) => trim($word), explode(' ', $sentence));
    }

    public function serialize(): array
    {
        return [
            'id' => $this->getId(),
            'russian' => $this->getRussian(),
            'length' => count($this->getEnglishWords())
        ];
    }

}