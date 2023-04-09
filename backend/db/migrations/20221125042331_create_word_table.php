<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateWordTable extends AbstractMigration
{
    public function change(): void
    {
        $words = $this->table('word', ['id' => false, 'primary_key' => 'source']);
        $words->addColumn('source', 'string', ['limit' => 255, 'null' => false, 'comment' => 'Искомое слово'])
            ->addColumn('confusion', 'string', ['limit' => 1024, 'null' => false, 'comment' => 'Слова для путаницы'])
            ->create();

        $words->insert([
            'source' => 'am',
            'confusion' => '|is|are|',
        ])->insert([
            'source' => 'i\'m',
            'confusion' => '|i|',
        ])->insert([
            'source' => 'to',
            'confusion' => '|too|',
        ])->insert([
            'source' => 'a',
            'confusion' => '|an|the|',
        ])->save();
    }
}
