<?php 
namespace App\Models;

use CodeIgniter\Model;

/**
 * 
 */
class LocDesignModel extends Model
{	
	protected $table = 'location';
	protected $primaryKey = 'location_id';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_data($data)
	{
		return $this->db->table($this->table)->insert($data);
	}

	public function is_null_location($wh_id, $block_type, $row_alias)
	{
		$condition = array(
			'wh_id' => $wh_id,
			'block_type' => $block_type,
			'row_alias' => $row_alias
		);
		$query = $this->db->table($this->table)
				->where($condition);
		return $query->countAllResults();

	}

	public function countWhLocationByWhId($wh_id)
	{
		$query = $this->db->table($this->table)
				->where(['wh_id' => $wh_id]);
		return $query->countAllResults();
	}

	public function allLocationByWh($limit, $start, $order, $dir, $wh_id)
	{
		$query = $this->db->query("SELECT `location`.`wh_id`,
					  `location`.`block_type`,
					  `location`.`row_alias`,
					  `location`.`row_number`,
					  `location`.`block_number`,
					  `location`.`rack_number`,
					  `location`.`uom_standard`,
					  `location`.`max_capacity`,
					  (SELECT `warehouse`.`wh_name` FROM `warehouse` WHERE `warehouse`.`warehouse_id` = `location`.`wh_id`) as wh_name
				FROM location
				WHERE `location`.`wh_id` = '$wh_id'
				ORDER BY `location`.$order $dir
				LIMIT $start, $limit
			");
        return $query->getResult();
	}

    public function searchAllLocationByWh($limit, $start, $order, $dir, $wh_id, $search)
	{
		// $query = $this->db->table($this->table)
		// ->where($condition)
		// ->like('block_type', $search)
  //       ->orLike('row_alias', $search)
  //       ->orLike('uom_standard', $search)
  //       ->limit($limit, $start)
  //       ->orderBy($order, $dir)
  //       ->get();
  //       return $query->getResult();


        $query = $this->db->query("SELECT `location`.`wh_id`,
					  `location`.`block_type`,
					  `location`.`row_alias`,
					  `location`.`row_number`,
					  `location`.`block_number`,
					  `location`.`rack_number`,
					  `location`.`uom_standard`,
					  `location`.`max_capacity`,
					  (SELECT `warehouse`.`wh_name` FROM `warehouse` WHERE `warehouse`.`warehouse_id` = `location`.`wh_id`) as wh_name
				FROM location
				WHERE `location`.`wh_id` = '$wh_id' 
				AND `location`.`block_type` LIKE '$search%' 
				OR `location`.`row_alias` LIKE '$search%'
				OR `location`.`uom_standard` LIKE '$search%' 
				ORDER BY `location`.$order $dir
				LIMIT $start, $limit
			");
        return $query->getResult();
	}
	
	public function search_warehouse_count($search)
    {
        $query = $this->db->table($this->table)
        ->selectCount($this->primaryKey, 'total')
        ->like('block_type', $search)
        ->orLike('row_alias', $search)
        ->orLike('uom_standard', $search)
        ->get();
        return $query->getRow()->total;
    }

    public function allLocationByWh2($wh_id)
	{
		$query = $this->db->query("SELECT `location`.`wh_id`,
						`location`.`location_id`,
					  `location`.`block_type`,
					  `location`.`row_alias`,
					  `location`.`row_number`,
					  `location`.`block_number`,
					  `location`.`rack_number`,
					  `location`.`uom_standard`,
					  `location`.`max_capacity`,
					  (SELECT `warehouse`.`wh_name` FROM `warehouse` WHERE `warehouse`.`warehouse_id` = `location`.`wh_id`) as wh_name
				FROM location
				WHERE `location`.`wh_id` = '$wh_id'
				ORDER BY wh_name ASC
			");
        return $query->getResult();
	}

	public function distLocByWh($wh_id)
	{
		$query = $this->db->query("SELECT DISTINCT `location`.`wh_id`,
					  `location`.`block_type`,
					  `location`.`row_alias`,
					  `location`.`row_number`,
					  `location`.`block_number`,
					  `location`.`rack_number`,
					  `location`.`uom_standard`,
					  `location`.`max_capacity`,
					  (SELECT `warehouse`.`wh_name` FROM `warehouse` WHERE `warehouse`.`warehouse_id` = `location`.`wh_id`) as wh_name
				FROM location
				WHERE `location`.`wh_id` = '$wh_id'
				ORDER BY wh_name ASC");
	}

}


 ?>