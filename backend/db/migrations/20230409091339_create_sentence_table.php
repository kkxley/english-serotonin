<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSentenceTable extends AbstractMigration
{
    public function change(): void
    {
        $sentence = $this->table('sentence', ['id' => false, 'primary_key' => 'sentence_id']);
        $sentence
            ->addColumn('sentence_id', 'integer', ['limit' => 11, 'null' => false, 'identity' => true, 'comment' => 'id предложения'])
            ->addColumn('theme_id', 'integer', ['limit' => 11, 'null' => false, 'comment' => 'id темы'])
            ->addColumn('russian', 'string', ['limit' => 1024, 'null' => false, 'comment' => 'Предложение на русском'])
            ->addColumn('english', 'string', ['limit' => 1024, 'null' => false, 'comment' => 'Предложение на английском'])
            ->addColumn('type_id', 'integer', ['limit' => 11, 'null' => false, 'comment' => 'id типа'])
            ->addForeignKey('theme_id', 'theme', 'theme_id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->addForeignKey('type_id', 'sentence_types', 'type_id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->create();

        $sentence->insert([
            'theme_id' => 8,
            'russian' => 'Это хороший результат.',
            'english' => 'It is a good result.',
            'type_id' => 1,
        ])->insert([
            'theme_id' => 8,
            'russian' => 'Он сейчас дома.',
            'english' => 'He is at home now.',
            'type_id' => 1,
        ])->insert([
            'theme_id' => 8,
            'russian' => 'Они отсутствуют.',
            'english' => 'They are away.',
            'type_id' => 1,
        ])->insert([
            'theme_id' => 8,
            'russian' => 'Она очень испугана.',
            'english' => 'She is very afraid.',
            'type_id' => 1,
        ])->insert([
            'theme_id' => 8,
            'russian' => 'Я так устал.',
            'english' => 'I am so tired.',
            'type_id' => 1,
        ])->save();
    }
}
