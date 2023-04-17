<?php

declare(strict_types=1);

namespace Serotonin\English\Sentence;

use yii\db\ActiveRecord;

class Sentence extends ActiveRecord
{
    public static function tableName(): string
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
        return array_map(fn(string $word) => trim($word), explode(' ', $this->getPureSentence($this->getEnglish())));
    }

    private function getPureSentence (string $sentence): string
    {
        $sentence = preg_replace('/[,.!?]/', '', $sentence);
        return mb_strtolower($sentence);
    }

    public function isValid (array $words): bool
    {
        return $this->getPureSentence($this->getEnglish()) === implode(' ', $words);
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