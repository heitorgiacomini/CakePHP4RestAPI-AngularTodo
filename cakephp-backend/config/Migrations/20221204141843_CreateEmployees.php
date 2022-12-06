<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateEmployees extends AbstractMigration
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
        $table = $this->table('employees');

        // name
        $table->addColumn("name", "string", [
            "limit" => 50,
            "null" => false
        ]);

        // email
        $table->addColumn("email", "string", [
            "limit" => 50,
            "null" => false
        ]);

        // designation
        $table->addColumn("designation", "string", [
            "limit" => 100,
            "null" => false
        ]);

        // gender
        $table->addColumn("gender", "enum", [
            "values" => ["male", "female", "other"]
        ]);

        // created_at
        $table->addColumn("created_at", "timestamp", [
            "default" => 'CURRENT_TIMESTAMP'
        ]);


        $table->create();
    }
}
