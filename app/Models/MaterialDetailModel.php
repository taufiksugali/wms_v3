<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialDetailModel extends Model
{
    protected $table = "material_detail";
    protected $primaryKey = 'mat_detail_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(mat_detail_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(mat_detail_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "MTD".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function check_material($owner_id, $material_id, $batch_no, $exp_date){
        $query = $this->db->table($this->table)
                ->select('material_detail.mat_detail_id')
                ->where('owner_id', $owner_id)
                ->where('material_id', $material_id)
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

    public function insert_data($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function update_data($id, $data)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function get_location_bymaterial($owner_id, $warehouse_id, $mat_detail_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->get();
        return $query->getResult();
    }

    public function get_qty_bylocation($owner_id, $warehouse_id, $mat_detail_id, $location_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->where('material_location.location_id', $location_id)
                ->get();
        return $query->getResult();
    }

    public function get_material_byowner($owner_id, $warehouse_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->groupBy('`material_detail`.`mat_detail_id`')
                ->get();
        return $query->getResult();
    }

    public function get_all_material(){
        $query = $this->db->table($this->table)
                ->select('material_detail.mat_detail_id, material.material_name, material.material_id, material_detail.expired_date, material_detail.batch_no')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->where('warehouse_soh.stock_ok > 0')
                ->get();
        return $query->getResult();
    }
}
?>