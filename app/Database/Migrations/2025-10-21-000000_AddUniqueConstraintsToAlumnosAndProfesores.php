<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUniqueConstraintsToAlumnosAndProfesores extends Migration
{
    public function up()
    {
        // Agregar índice UNIQUE para DNI y Email en tabla alumnos
        $this->forge->addKey('DNI', false, true, 'unique_alumnos_dni');
        $this->forge->processIndexes('alumnos');

        $this->forge->addKey('Email', false, true, 'unique_alumnos_email');
        $this->forge->processIndexes('alumnos');

        // Agregar índice UNIQUE para DNI y Email en tabla profesores
        $this->forge->addKey('DNI', false, true, 'unique_profesores_dni');
        $this->forge->processIndexes('profesores');

        $this->forge->addKey('Email', false, true, 'unique_profesores_email');
        $this->forge->processIndexes('profesores');
    }

    public function down()
    {
        // Eliminar índices UNIQUE de alumnos
        $this->forge->dropKey('alumnos', 'unique_alumnos_dni');
        $this->forge->dropKey('alumnos', 'unique_alumnos_email');

        // Eliminar índices UNIQUE de profesores
        $this->forge->dropKey('profesores', 'unique_profesores_dni');
        $this->forge->dropKey('profesores', 'unique_profesores_email');
    }
}
