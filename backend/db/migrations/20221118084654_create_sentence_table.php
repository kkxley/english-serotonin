<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSentenceTable extends AbstractMigration
{
    public function change()
    {
        $sentence = $this->table('sentence', ['id' => false, 'primary_key' => 'sentence_id']);
        $sentence
            ->addColumn('sentence_id', 'integer', ['limit' => 11, 'null' => false, 'identity' => true, 'comment' => 'id предложения'])
            ->addColumn('theme_id', 'integer', ['limit' => 11, 'null' => false, 'comment' => 'id темы'])
            ->addColumn('russian', 'string', ['limit' => 1024, 'null' => false, 'comment' => 'Предложение на русском'])
            ->addColumn('english', 'string', ['limit' => 1024, 'null' => false, 'comment' => 'Предложение на английском'])
            ->create();

        $sentence->insert([
            'theme_id' => 1,
            'russian' => 'Это хороший результат.',
            'english' => 'It is a good result.',
        ])->insert([
            'theme_id' => 1,
            'russian' => 'Он сейчас дома.',
            'english' => 'He is at home now.',
        ])->insert([
            'theme_id' => 1,
            'russian' => 'Они отсутствуют.',
            'english' => 'They are away.',
        ])->insert([
            'theme_id' => 1,
            'russian' => 'Она очень испугана.',
            'english' => 'She is very afraid.',
        ])->insert([
            'theme_id' => 1,
            'russian' => 'Я так устал.',
            'english' => 'I am so tired.',
        ])->save();
    }
}
