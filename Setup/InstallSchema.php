<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace JonathanMartz\SupportForm\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

/**
 * Class InstallSchema
 * @package JonathanMartz\Support\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var string
     */
    public $table = 'support_request';

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $connection = $setup->getConnection();

        if(!$connection->isTableExists($this->table)) {
            try {
                $table = $connection->newTable($setup->getTable($this->table))
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                        'Id'
                    );

                $table->addColumn(
                    'type',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'type'
                );

                $table->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'email'
                );

                $table->addColumn(
                    'customer_id',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'customer_id'
                );

                $table->addColumn(
                    'message',
                    Table::TYPE_TEXT,
                    1337,
                    ['nullable' => false, 'default' => ''],
                    'message'
                );

                $table->addColumn(
                    'session',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'session'
                );

                $table->addColumn(
                    'ip',
                    Table::TYPE_TEXT,
                    256,
                    ['nullable' => false, 'default' => sha1('brandung :D')],
                    'ip'
                );

                $table->addColumn(
                    'created_at',
                    Table::TYPE_INTEGER,
                    30,
                    ['nullable' => false, 'default' => time()],
                    'Time'
                );

                $table->addColumn(
                    'updated_at',
                    Table::TYPE_INTEGER,
                    30,
                    ['nullable' => false, 'default' => time()],
                    'Time'
                );

                $connection->createTable($table);
            }
            catch(Zend_Db_Exception $e) {
                die($e->getMessage());
            }
        }
        else {
            // $connection->dropTable($this->table);
        }
    }
}
