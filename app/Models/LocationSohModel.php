<?php
namespace App\Models;

use CodeIgniter\Model;

class LocationSohModel extends Model
{
    protected $table = "location_soh";
    protected $primaryKey = 'loc_soh_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function cekSoh($owner_id, $material_id, $wh_id, $expired_date, $block_type, $row_alias, $row_number, $block_number)
    {
        $query = $this->db->table($this->table)
                ->where('owner_id', $owner_id)
                ->where('material_id', $material_id)
                ->where('wh_id', $wh_id)
                ->where('expired_date', $expired_date)
                ->where('block_type', $block_type)
                ->where('row_alias', $row_alias)
                ->where('row_number', $row_number)
                ->where('block_number', $block_number)
                ->get();
        return $query->getNumRows();
    }

    public function getTotalItemAndIdSohPallet($owner_id, $material_id, $wh_id, $expired_date, $block_type, $row_alias, $row_number, $block_number)
    {
        $query = $this->db->table($this->table)
                ->select('`location_soh`.`stok`,
                          `location_soh`.`loc_soh_id`')
                ->where('owner_id', $owner_id)
                ->where('material_id', $material_id)
                ->where('wh_id', $wh_id)
                ->where('expired_date', $expired_date)
                ->where('block_type', $block_type)
                ->where('row_alias', $row_alias)
                ->where('row_number', $row_number)
                ->where('block_number', $block_number)
                ->get();
        return $query->getRow();
    }

    public function insertSoh($data)
    {
        $query = $this->db->table($this->table)
                ->insert($data);
    }

    public function updateSoh($id, $new_stok)
    {   
        
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($new_stok);
    }

    public function getTotalItemInStorageForPallet($type, $row_alias, $row_number, $block_number, $wh_id)
    {
        $query = $this->db->table($this->table)
                ->select('SUM(`location_soh`.`stok`) as stok')
                ->where('block_type', $type)
                ->where('row_alias', $row_alias)
                ->where('row_number', $row_number)
                ->where('block_number', $block_number)
                ->where('wh_id', $wh_id)
                ->get();
        return $query->getRow();
    }

    public function allStokByWh($wh_id)
    {
        $query = $this->db->table($this->table)
                ->where('wh_id', $wh_id)
                ->get();
        return $query->getResult();
    }
}
?>