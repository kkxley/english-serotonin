<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSentenceTypes extends AbstractMigration
{

    public function change(): void
    {
        $types = $this->table('sentence_types', ['id' => false, 'primary_key' => 'type_id']);
        $types->addColumn('type_id', 'integer', ['limit' => 11, 'null' => false, 'identity' => true, 'comment' => 'id типа'])
            ->addColumn('title', 'string', ['limit' => 255, 'null' => false, 'comment' => 'Название типа'])
            ->create();

        $types->insert([
            'title' => 'Повествовательные',
        ])->insert([
            'title' => 'Вопросы',
        ])->insert([
            'title' => 'Вопросы с сложным подлежащим',
        ])->insert([
            'title' => 'Повествовательные с сложным подлежащим',
        ])->save();
    }
}
