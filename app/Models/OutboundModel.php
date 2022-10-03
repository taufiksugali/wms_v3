<?php namespace App\Models;

use CodeIgniter\Model;

class OutboundModel extends Model
{
    protected $table = "outbound";
    protected $primaryKey = 'outbound_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(outbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OTB".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_outbound($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_outbound_count()
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id');
        return $query->countAll();
    }

    public function search_outbound($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->like('customer.customer_name', $search)
                ->orLike('warehouse.wh_name', $search)
                ->orLike('trans_type.trans_type_name', $search)
                ->orLike('outbound.outbound_doc', $search)
                ->orLike('outbound.outbound_doc_date', $search)
                ->orLike('outbound.create_date', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_outbound_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->like('customer.customer_name', $search)
                ->orLike('warehouse.wh_name', $search)
                ->orLike('trans_type.trans_type_name', $search)
                ->orLike('outbound.outbound_doc', $search)
                ->orLike('outbound.outbound_doc_date', $search)
                ->orLike('outbound.create_date', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    // Serverside
    public function all_outbound_bystatus($limit, $start, $col, $dir, $status)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->where('outbound.status', $status)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_outbound_count_bystatus($status)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->where('outbound.status', $status);
        return $query->countAllResults();
    }

    public function search_outbound_bystatus($limit, $start, $search, $col, $dir, $status)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->groupStart()
                    ->like('customer.customer_name', $search)
                    ->orLike('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_name', $search)
                    ->orLike('outbound.outbound_doc', $search)
                    ->orLike('outbound.outbound_doc_date', $search)
                    ->orLike('outbound.create_date', $search)
                ->groupEnd()
                ->where('outbound.status', $status)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_outbound_count_bystatus($search, $status)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->groupStart()
                    ->like('customer.customer_name', $search)
                    ->orLike('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_name', $search)
                    ->orLike('outbound.outbound_doc', $search)
                    ->orLike('outbound.outbound_doc_date', $search)
                    ->orLike('outbound.create_date', $search)
                ->groupEnd()
                ->where('outbound.status', $status)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

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

    public function get_outbound_detail($id){
        $query = $this->db->table('outbound_detail')
                ->join('outbound', 'outbound_detail.outbound_id = outbound.outbound_id')
                ->join('material_detail', 'outbound_detail.material_detail_id = material_detail.mat_detail_id')
                ->join('material', 'material_detail.material_id = material.material_id')
                ->join('owners', 'material_detail.owner_id = owners.owners_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('outbound_detail.outbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_outbound_byid($id){
        $query = $this->db->table($this->table)
                ->select('`outbound`.`outbound_id`
                , `outbound`.`outbound_type`
                , `customer`.`customer_name`
                , `outbound`.`outbound_doc`
                , `outbound`.`outbound_doc_date`
                , `outbound`.`create_date`
                , `warehouse`.`wh_name`
                , `outbound`.`status`
                , `outbound`.`out_date`
                , `outbound`.`create_by`
                , `outbound`.`description`
                , `trans_type`.`trans_type_name`')
                ->join('customer', 'outbound.penerima = customer.customer_id')
                ->join('warehouse', 'outbound_wh_asal = warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type = trans_type.trans_type_id')
                ->where('outbound.outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();        
    }
}
?>