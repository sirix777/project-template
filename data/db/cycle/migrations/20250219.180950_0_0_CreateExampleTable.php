<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmF1f7c4b1c523629e49a9c63a7625f56bdfc4 extends Migration
{
    protected const string DATABASE = 'main-db';
    private const string TABLE_NAME = 'example';

    public function up(): void
    {
        $this->table(self::TABLE_NAME)
            ->addColumn('id', 'primary')
            ->addColumn('name', 'string')
            ->addColumn('data', 'jsonb')
            ->addColumn('balance', 'decimal', ['precision' => 60, 'scale' => 0])
            ->addColumn('currency_code', 'int', ['nullable' => false, 'length' => 4])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addColumn('deleted_at', 'datetime', ['nullable' => true])
            ->addColumn('version', 'int', ['default' => 0])
            ->create();
    }

    public function down(): void
    {
        $this->table(self::TABLE_NAME)->drop();
    }
}