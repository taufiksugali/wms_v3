<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = 'user_id';
 
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users()
    {
        $query = $this->db->table('users')->get();
        return $query->getResult();
    }

    public function get_userbyid($id)
	{
		$query = $this->db->table($this->table)
		->where($this->primaryKey, $id)
		->limit(1)
		->get();
		return $query->getRow();
	}

    public function generate_id() 
    {
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(user_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(user_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "LOG".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
        //UID21031600002
    }

    public function login($user_email, $user_password)
	{
		$query = $this->db->table($this->table)
		->where('email', $user_email)
		->where('password', $user_password)
		->limit(1)
		->get();
		return $query->getRow();
	}

    public function insert_data($data){
        return $this->db->table($this->table)->insert($data);
    }

    public function update_user($id, $data)
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

	public function checkEmail($email)
    {
        $query = $this->db->table($this->table)
                ->where('email', $email)
                ->limit(1)
                ->get();
		return $query->getRow();
    }

    public function updateUser($id, $data)
	{
		$this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
	}

    public function getUserById($id)
	{
		$query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
		return $query->getRow();
	}
}