<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialGroupModel extends Model
{
    protected $table = "material_group";
    protected $primaryKey = 'mat_group_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_mat_group(){
        $query = $this->db->table($this->table)
                ->get();
        return $query->getResult();
    }
}
?>