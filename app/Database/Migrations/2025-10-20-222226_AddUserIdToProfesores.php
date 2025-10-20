<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToProfesores extends Migration
{
    public function up()
    {
        // Agregar columna user_id a la tabla profesores
        $fields = [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ];
        
        $this->forge->addColumn('profesores', $fields);
        
        // Agregar la foreign key a auth_identities
        $this->forge->addForeignKey('user_id', 'auth_identities', 'id', 'SET NULL', 'CASCADE', 'profesores_fk_user_id');
    }

    public function down()
    {
        // Eliminar la foreign key primero
        $this->forge->dropForeignKey('profesores', 'profesores_fk_user_id');
        
        // Eliminar la columna user_id
        $this->forge->dropColumn('profesores', 'user_id');
    }
}
