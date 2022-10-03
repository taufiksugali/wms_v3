<?php
namespace App\Models;

use CodeIgniter\Model;

class RealizationAfterModel extends Model
{
    protected $table = "realization_after";
    protected $primaryKey = 'reaf_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function insertData($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function allInboundByWH($wh_id)
    {
        $data = $this->db->table($this->table)
                ->select('inbound_id')
                ->where('allocated_all', 'no')
                ->get();
        return $data->getResult();
    }

    public function allByInbound($inbound_id)
    {
        $data = $this->db->table($this->table)
                ->where('inbound_id', $inbound_id)
                ->get();
        return $data->getRow();
    }
}
?>