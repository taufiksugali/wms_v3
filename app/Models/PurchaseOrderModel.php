<?php namespace App\Models;

use CodeIgniter\Model;

class PurchaseOrderModel extends Model
{
    protected $table = "purchase_order";
    protected $primaryKey = 'po_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(po_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(po_id, 3, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "PO".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_po($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_po_count()
    {
        $query = $this->db->table($this->table)
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id');
        return $query->countAll();
    }

    public function search_po($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->like('supplier.supplier_name', $search)
                ->orLike('purchase_order.po_number', $search)
                ->orLike('purchase_order.po_date', $search)
                ->orLike('purchase_order.description', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_po_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->like('supplier.supplier_name', $search)
                ->orLike('purchase_order.po_number', $search)
                ->orLike('purchase_order.po_date', $search)
                ->orLike('purchase_order.description', $search)
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

    public function get_all_po(){
        $query = $this->db->table($this->table)
                ->join('supplier', 'purchase_order.supplier_id=supplier.supplier_id')
                ->where('po_status', 1)
                ->orWhere('po_status', 2)
                ->get();
        return $query->getResult();
    }

    public function get_po_detail($id){
        $query = $this->db->table('po_detail')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_detail.po_id', $id)
                ->get();
        return $query->getResult();
    }

    public function get_purchase_order($po_id){
        $query = $this->db->table('po_detail')
                ->select('po_detail.`po_detail_id`, purchase_order.`po_number`, 
                purchase_order.`po_date`, po_detail.`material_id`, material.`material_name`, po_detail.`qty`, uom.`uom_name`, purchase_order.due_date')
                ->join('purchase_order', 'po_detail.`po_id`= purchase_order.`po_id`')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_detail.po_id', $po_id)
                ->where('po_detail.status', 1)
                ->get();
        return $query->getResult();
    }
}
?>