<?php

namespace App\Models;

use CodeIgniter\Model;

class SampleModel extends Model
{
    protected $table = 'sample';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fname','mname','lname'];

     public function update_info($where, $data) {
        $builder = $this->db->table('sample');
        $builder->update($data, $where);
        return $this->db->affectedRows();
    }
    
}