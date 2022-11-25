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

    public function serialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'is_root' => $this->isRoot(),
            'parent_id' => $this->getParentId(),
        ];
    }
}