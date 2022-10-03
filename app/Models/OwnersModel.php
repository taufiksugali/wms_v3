<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class OwnersModel extends Model
{
    protected $table = "owners";
    protected $primaryKey = 'owners_id';
 
    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(owners_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(owners_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OWN".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_owner($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_owner_count()
    {
        $query = $this->db->table($this->table);
        return $query->countAll();
    }

    public function search_owner($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->like('owner_name', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_product_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->like('owner_name', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_all_owner(){
        $query = $this->db->table($this->table)
                ->where('owners_status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_owner_byid($id)
    {
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