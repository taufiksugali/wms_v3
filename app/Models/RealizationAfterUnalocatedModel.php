<?php
namespace App\Models;

use CodeIgniter\Model;

class RealizationAfterUnalocatedModel extends Model
{
    protected $table = "realization_after_unalocated";
    protected $primaryKey = 'reafun_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function check_material($inbound_id, $material_id, $batch_no, $exp_date){
        $query = $this->db->table($this->table)
                ->select('realization_after_unalocated.reafun_id')
                ->where('inbound_id', $owner_id)
                ->where('', $material_id)
                ->where('batch_no', $batch_no)
                ->where('expired_date', $exp_date)
                ->limit(1)
                ->get();
        if($query->getNumRows() > 0){
            return $query->getRow()->mat_detail_id;
        }else{
            return 0;
        }
    }

    public function insertData($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function materialDetail($inbound_id, $wh_id)
    {
        $query = $this->db->table($this->table)
                ->select('`realization_after_unalocated`.`reafun_id`,
                         `realization_after_unalocated`.`inbound_id`,
                         `realization_after_unalocated`.`material_id`,
                         `realization_after_unalocated`.`expired_date`,
                         `realization_after_unalocated`.`batch_no`,
                         `realization_after_unalocated`.`good_stok`,
                         `realization_after_unalocated`.`bad_stok`,
                         `material`.material_name`,
                         `realization_after`.`owner_id`'
                        )
                ->join('realization_after', 'realization_after.inbound_id=realization_after_unalocated.inbound_id', 'left')
                ->join('material', 'material.material_id=realization_after_unalocated.material_id', 'left')
                ->where('realization_after_unalocated.inbound_id', $inbound_id)
                ->where('`realization_after_unalocated`.`good_stok` > ', 0)
                ->get();
        return $query->getResult();
    }

    public function getExpiredDate($inbound_id, $material_id, $batch_no)
    {
        $query = $this->db->table($this->table)
                ->select('`realization_after_unalocated`.`expired_date`,
                          `realization_after_unalocated`.`reafun_id` as loc_id')
                ->where('inbound_id', $inbound_id)
                ->where('material_id', $material_id)
                ->where('batch_no', $batch_no)
                ->get();
        return $query->getRow();
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
        return $query->num_rows();
    }

    public function updateStok($id,$data)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function cekSisaStok($inbound_id)
    {
        $query = $this->db->table($this->table)
                ->select('SUM(`realization_after_unalocated`.`good_stok`) as total')
                ->where('inbound_id', $inbound_id)
                ->get();
        return $query->getRow();
    }

    public function updateStatusAllocated($id, $data)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function getIdByInbound($inbound_id)
    {
        $query = $this->db->table($this->table)
                ->select('`realization_after_unalocated`.`reaf_id`')
                ->where('inbound_id', $inbound_id)
                ->get();
        return $query->getRow;

    }
}
?>