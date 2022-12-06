<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTodo extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('todo');

        // name
        $table->addColumn("name", "string", [
            "limit" => 50,
            "null" => false
        ]);

        // status
        $table->addColumn("status", "boolean", [
            'default' => false,
            'null' => false,
        ]);



        $table->create();
    }
}
