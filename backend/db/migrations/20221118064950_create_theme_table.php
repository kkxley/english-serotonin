<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateThemeTable extends AbstractMigration
{
    public function change(): void
    {
        $theme = $this->table('theme', ['id' => false, 'primary_key' => 'theme_id']);
        $theme->addColumn('theme_id', 'integer', ['limit' => 11, 'null' => false, 'identity' => true, 'comment' => 'id темы'])
            ->addColumn('title', 'string', ['limit' => 255, 'null' => false, 'comment' => 'Название темы'])
            ->addColumn('description', 'string', ['limit' => 255, 'null' => false, 'default' => '', 'comment' => 'Описание'])
            ->addColumn('parent_id', 'integer', ['limit' => 11, 'null' => false, 'default' => 0, 'comment' => 'Родительская тема'])
            ->create();

        $theme->insert([
            'title' => 'Past',
        ])->insert([
            'title' => 'Present',
        ])->insert([
            'title' => 'Future',
        ])->insert([ // Past
            'title' => 'Simple',
            'description' => 'The second form (regular / irregular)',
            'parent_id' => 1
        ])->insert([
            'title' => 'Continuous',
            'description' => 'was/were + verb + ing',
            'parent_id' => 1
        ])->insert([
            'title' => 'Perfect',
            'description' => 'had + the third form',
            'parent_id' => 1
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => 'had been + verb + ing',
            'parent_id' => 1
        ])->insert([ // Present
            'title' => 'Simple',
            'description' => "verb / verb + s \n am/is/are",
            'parent_id' => 2
        ])->insert([
            'title' => 'Continuous',
            'description' => "am/is/are + verb + ing",
            'parent_id' => 2
        ])->insert([
            'title' => 'Perfect',
            'description' => "have/has + the third form",
            'parent_id' => 2
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => "have/has been + verb + ing",
            'parent_id' => 2
        ])->insert([ // Future
            'title' => 'Simple',
            'description' => 'will + verb',
            'parent_id' => 3
        ])->insert([
            'title' => 'Continuous',
            'description' => 'will be + verb + ing',
            'parent_id' => 3
        ])->insert([
            'title' => 'Perfect',
            'description' => 'will have + the third form',
            'parent_id' => 3
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => 'will have been + verb + ing',
            'parent_id' => 3
        ])->save();
    }
}
