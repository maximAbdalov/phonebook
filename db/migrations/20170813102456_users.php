<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */

	public function up()
	{
		$table = $this->table('users');
		$table->addColumn('fio', 'string')
			->addColumn('notes', 'string')
			->addColumn('created_at', 'timestamp')
			->addColumn('updatet_at', 'timestamp')->create();
	}

	public function down()
	{
		$this->dropTable('users');
	}
}
