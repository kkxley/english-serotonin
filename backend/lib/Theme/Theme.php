<?php

declare(strict_types=1);

namespace Serotonin\English\Theme;

use yii\db\ActiveRecord;

class Theme extends ActiveRecord
{
    public static function tableName()
    {
        return '{{theme}}';
    }

    public function getId(): int
    {
        return (int)$this->getAttribute('theme_id');
    }

    public function getTitle(): string
    {
        return $this->getAttribute('title');
    }

    public function isRoot(): bool
    {
        return (int)$this->getAttribute('parent_id') === 0;
    }

    public function getParentId(): int
    {
        return (int)$this->getAttribute('parent_id');
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }

    public function getPath(): string
    {
        return $this->getAttribute('path');
    }

    public function getFormulaSimple(): string
    {
        return $this->getAttribute('formula_simple');
    }

    public function getFormulaQuestion(): string
    {
        return $this->getAttribute('formula_question');
    }

    public function getExamples(): array
    {
        return array_filter(explode('|', $this->getAttribute('examples')));
    }


    public function serialize(): array
    {
        return [
            'path' => $this->getPath(),
            'title' => $this->getTitle(),
            'is_root' => $this->isRoot(),
            'description' => $this->getDescription(),
            'formula_simple' => $this->getFormulaSimple(),
            'formula_question' => $this->getFormulaQuestion(),
            'examples' => $this->getExamples(),
        ];
    }
}