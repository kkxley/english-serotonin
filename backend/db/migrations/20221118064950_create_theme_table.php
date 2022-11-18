<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateThemeTable extends AbstractMigration
{
    public function change()
    {
        $themes = $this->table('themes', ['id' => false, 'primary_key' => 'theme_id']);
        $themes->addColumn('theme_id', 'integer', ['limit' => 11, 'null' => false, 'identity' => true, 'comment' => 'id темы'])
            ->addColumn('title', 'string', ['limit' => 255, 'null' => false, 'comment' => 'Название темы'])
            ->addColumn('parent_id', 'integer', ['limit' => 11, 'null' => false, 'default' => 0, 'comment' => 'Родительская тема'])
            ->create();

        $themes->insert([
            'title' => 'Present simple',
        ])->insert([
            'title' => 'to be',
            'parent_id' => 1
        ])->insert([
            'title' => 'Вопросы',
            'parent_id' => 1
        ])->save();
    }
}
