<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{

    public function up()
        {
            $this->forge->dropTable('users');
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'title' => [
                    'type'       => 'STRING',
                    'constraint' => '100',
                ],
                'content' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'author' => [
                    'type' => 'STRING',
                    'null' => true,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id', true);//primary key
            $this->forge->createTable('foruser');
        }
    
        public function down()
        {
            $this->forge->dropTable('foruser');
        }
    }

