<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_waste_categories_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('waste_categories');

        // Insert default categories
        $data = [
            [
                'name' => 'Sampah Organik',
                'description' => 'Sampah yang berasal dari sisa-sisa makhluk hidup yang dapat terurai secara alami',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sampah Anorganik',
                'description' => 'Sampah yang tidak dapat terurai secara alami seperti plastik, kaca, dan logam',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sampah B3',
                'description' => 'Sampah yang mengandung bahan berbahaya dan beracun seperti baterai, obat-obatan, dan bahan kimia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->insert_batch('waste_categories', $data);
    }

    public function down() {
        $this->dbforge->drop_table('waste_categories');
    }
} 