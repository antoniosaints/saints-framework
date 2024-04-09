<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TableUsuarios extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('usuarios');
        $table
            ->addColumn('nome', 'string')
            ->addColumn('email', 'string')
            ->addColumn('senha', 'string')
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->create();
    }
}
