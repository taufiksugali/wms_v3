<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = "material";
    protected $primaryKey = 'material_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(material_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(material_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "MTR".$midId;
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
        $query = $this->db->table($this->table)
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_material_count()
    {
        $query = $this->db->table($this->table)
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id');
        return $query->countAll();
    }

    public function search_material($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->like('material.material_name', $search)
                ->orLike('material.description', $search)
                ->orLike('material_group.mat_group_name', $search)
                ->orLike('uom.uom_name', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_material_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->like('material.material_name', $search)
                ->orLike('material.description', $search)
                ->orLike('material_group.mat_group_name', $search)
                ->orLike('uom.uom_name', $search)
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

    public function get_material_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_all_material(){
        $query = $this->db->table($this->table)
                ->where('status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_city_name($regency_id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/getByidRegency?token=0a05252241f3bc45ffc4abaeca369963&id='.$regency_id.'&param=regency_id');
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        
        return $dataObject->data[0]->regency_name .', '. $dataObject->data[0]->province_name;
    }
}
?>