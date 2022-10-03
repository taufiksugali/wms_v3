<?php
namespace App\Models;

use CodeIgniter\Model;

class LocationSohModel extends Model
{
    protected $table = "location_soh";
    protected $primaryKey = 'loc_soh_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function checkSoh($wh_id,$material_id,)
    {

    }
}
?>