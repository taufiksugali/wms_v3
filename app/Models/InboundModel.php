<?php namespace App\Models;

use CodeIgniter\Model;

class InboundModel extends Model
{
    protected $table = "inbound";
    protected $primaryKey = 'inbound_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(inbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(inbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "INB".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_inbound($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.status', 1)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_inbound_count()
    {
        $query = $this->db->table($this->table)
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.status', 1);
        return $query->countAllResults();
    }

    public function search_inbound($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->like('supplier.supplier_name', $search)
                ->orLike('warehouse.wh_name', $search)
                ->orLike('trans_type.trans_type_id', $search)
                ->orLike('inbound.inbound_doc_date', $search)
                ->orLike('inbound.inbound_rcv_date', $search)
                ->orLike('inbound.inbound_rcv_by', $search)
                ->orLike('inbound.create_date', $search)
                ->where('inbound.status', 1)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_inbound_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->like('supplier.supplier_name', $search)
                ->orLike('warehouse.wh_name', $search)
                ->orLike('trans_type.trans_type_id', $search)
                ->orLike('inbound.inbound_doc_date', $search)
                ->orLike('inbound.inbound_rcv_date', $search)
                ->orLike('inbound.inbound_rcv_by', $search)
                ->orLike('inbound.create_date', $search)
                ->where('inbound.status', 1)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    // Serverside
    public function all_inbound_bystatus($limit, $start, $col, $dir, $status, $status1)
    {
        $query = $this->db->table($this->table)
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.status', $status)
                ->orWhere('inbound.status', $status1)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_inbound_count_bystatus($status, $status1)
    {
        $query = $this->db->table($this->table)
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.status', $status)
                ->orWhere('inbound.status', $status1);
        return $query->countAllResults();
       
    }

    public function search_inbound_bystatus($limit, $start, $search, $col, $dir, $status, $status1)
    {
        $query = $this->db->table($this->table)
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->groupStart()
                    ->like('supplier.supplier_name', $search)
                    ->orLike('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_id', $search)
                    ->orLike('inbound.inbound_doc_date', $search)
                    ->orLike('inbound.inbound_rcv_date', $search)
                    ->orLike('inbound.inbound_rcv_by', $search)
                    ->orLike('inbound.create_date', $search)
                ->groupEnd()
                ->where('inbound.status', $status)
                ->orWhere('inbound.status', $status1)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_inbound_count_bystatus($search, $status, $status1)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, supplier.supplier_name, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->groupStart()
                    ->like('supplier.supplier_name', $search)
                    ->orLike('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_id', $search)
                    ->orLike('inbound.inbound_doc_date', $search)
                    ->orLike('inbound.inbound_rcv_date', $search)
                    ->orLike('inbound.inbound_rcv_by', $search)
                    ->orLike('inbound.create_date', $search)
                ->groupEnd()
                ->where('inbound.status', $status)
                ->orWhere('inbound.status', $status1)
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

    public function get_po_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_inbound_detail($id){
        $query = $this->db->table('inbound_detail')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('inbound_detail.inbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_inbound_byid($id){
        $query = $this->db->table($this->table)
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, inbound.inbound_doc, inbound.inbound_doc_date, inbound.description, trans_type.trans_type_name, supplier.supplier_name, inbound.inbound_location, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.inbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();        
    }
}
?>