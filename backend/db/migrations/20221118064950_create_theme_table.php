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
            ->addColumn('path', 'string', ['limit' => 255, 'null' => false, 'comment' => 'Путь темы'])
            ->addColumn('parent_id', 'integer', ['limit' => 11, 'null' => false, 'default' => 0, 'comment' => 'Родительская тема'])
            ->create();

        $theme->insert([
            'title' => 'Past',
            'path' => 'past',
        ])->insert([
            'title' => 'Present',
            'path' => 'present',
        ])->insert([
            'title' => 'Future',
            'path' => 'future',
        ])->insert([ // Past
            'title' => 'Simple',
            'description' => 'The second form (regular / irregular)',
            'parent_id' => 1,
            'path' => 'past-simple',
        ])->insert([
            'title' => 'Continuous',
            'description' => 'was/were + verb + ing',
            'parent_id' => 1,
            'path' => 'past-continuous',
        ])->insert([
            'title' => 'Perfect',
            'description' => 'had + the third form',
            'parent_id' => 1,
            'path' => 'past-perfect',
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => 'had been + verb + ing',
            'parent_id' => 1,
            'path' => 'past-perfect-continuous',
        ])->insert([ // Present
            'title' => 'Simple',
            'description' => "verb / verb + s \n am/is/are",
            'parent_id' => 2,
            'path' => 'present-simple',
        ])->insert([
            'title' => 'Continuous',
            'description' => "am/is/are + verb + ing",
            'parent_id' => 2,
            'path' => 'present-continuous',
        ])->insert([
            'title' => 'Perfect',
            'description' => "have/has + the third form",
            'parent_id' => 2,
            'path' => 'present-perfect',
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => "have/has been + verb + ing",
            'parent_id' => 2,
            'path' => 'present-perfect-continuous',
        ])->insert([ // Future
            'title' => 'Simple',
            'description' => 'will + verb',
            'parent_id' => 3,
            'path' => 'future-simple',
        ])->insert([
            'title' => 'Continuous',
            'description' => 'will be + verb + ing',
            'parent_id' => 3,
            'path' => 'future-continuous',
        ])->insert([
            'title' => 'Perfect',
            'description' => 'will have + the third form',
            'parent_id' => 3,
            'path' => 'future-perfect',
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => 'will have been + verb + ing',
            'parent_id' => 3,
            'path' => 'future-perfect-continuous',
        ])->save();
    }
}
