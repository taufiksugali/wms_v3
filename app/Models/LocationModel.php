<?php namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = "material_location";
    protected $primaryKey = 'location_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(location_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(location_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "LOC".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_material($limit, $start, $col, $dir)
    {
        $query = $this->db->table('inbound_detail')
                ->select('`material`.`material_name`
                , `po_detail`.`material_id`
                , `inbound`.`inbound_id`
                , `inbound_detail`.`qty_good_in`
                , `inbound_detail`.`qty_notgood_in`
                , `inbound_detail`.`qty_realization`
                , `inbound`.`inbound_rcv_date`
                , `warehouse`.`wh_name`
                , `inbound`.`inbound_location`
                , `inbound_detail`.`det_inbound_id`')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_material_count()
    {
        $query = $this->db->table('inbound_detail')
        ->select('`material`.`material_name`
        , `po_detail`.`material_id`
        , `inbound`.`inbound_id`
        , `inbound_detail`.`qty_good_in`
        , `inbound_detail`.`qty_notgood_in`
        , `inbound_detail`.`qty_realization`
        , `inbound`.`inbound_rcv_date`
        , `warehouse`.`wh_name`
        , `inbound`.`inbound_location`
        , `inbound_detail`.`det_inbound_id`')
        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
        ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
        ->join('material', 'po_detail.material_id=material.material_id')
        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
        ->where('inbound_detail.status', 2);
        return $query->countAllResults();
    }

    public function search_material($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table('inbound_detail')
                ->select('`material`.`material_name`
                , `po_detail`.`material_id`
                , `inbound`.`inbound_id`
                , `inbound_detail`.`qty_good_in`
                , `inbound_detail`.`qty_notgood_in`
                , `inbound_detail`.`qty_realization`
                , `inbound`.`inbound_rcv_date`
                , `warehouse`.`wh_name`
                , `inbound`.`inbound_location`
                , `inbound_detail`.`det_inbound_id`')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->like('supplier.supplier_name', $search)
                ->like('material.supplier_name', $search)
                ->orLike('warehouse.material_name', $search)
                ->orLike('inbound_detail.qty_good_in', $search)
                ->orLike('inbound_detail.qty_notgood_in', $search)
                ->orLike('inbound.inbound_rcv_date', $search)
                ->orLike('warehouse.wh_name', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_material_count($search)
    {
        $query = $this->db->table('inbound_detail')
                ->selectCount($this->primaryKey, 'total')
                ->select('`material`.`material_name`
                , `po_detail`.`material_id`
                , `inbound_detail`.`qty_good_in`
                , `inbound_detail`.`qty_notgood_in`
                , `inbound_detail`.`qty_realization`
                , `inbound`.`inbound_rcv_date`
                , `warehouse`.`wh_name`
                , `inbound`.`inbound_location`
                , `inbound_detail`.`det_inbound_id`')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->like('material.supplier_name', $search)
                ->orLike('warehouse.material_name', $search)
                ->orLike('inbound_detail.qty_good_in', $search)
                ->orLike('inbound_detail.qty_notgood_in', $search)
                ->orLike('inbound.inbound_rcv_date', $search)
                ->orLike('warehouse.wh_name', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_detail_material($det_inbound_id){
        $query = $this->db->table('inbound_detail')
                ->select('inbound_detail.det_inbound_id, material.material_name, material_detail.mat_detail_id, inbound_detail.qty_good_in, inbound_detail.qty_notgood_in, inbound_detail.qty_realization, inbound.inbound_id')
                ->join('inbound', 'inbound_detail.inbound_id = inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('material_detail', 'material.material_id=material_detail.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->where('inbound_detail.det_inbound_id', $det_inbound_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_location_byid($id){
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
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
}
?>