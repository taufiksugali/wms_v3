<?php 
namespace App\Controllers;

use App\Models\WarehouseModel;
use App\Models\LocDesignModel;
use App\Models\RealizationAfterModel;
use App\Models\RealizationAfterUnalocatedModel;
use Config\Services;

/**
 * 
 */
class LocationPlan extends BaseController
{
	
	public function __construct()
	{
		$this->warehouse = new WarehouseModel;
		$this->locdesign = new LocDesignModel;
		$this->reafmod = new RealizationAfterModel;
		$this->reafun = new RealizationAfterUnalocatedModel;
	}

	public function index()
	{	
		$data = [
			'title' => 'Location Plan',
			'title_menu' => 'locationplan',
			'sidebar' => 'locationplan',
			'viewjs' => 'locationplan'
		];
		$all_lokasi = $this->locdesign->allLocationByWh2(session('wh_id'));
		
		$data_lokasi = count($all_lokasi);
		$fields = array();

		$view = [
			'all_lokasi' => $all_lokasi
		];
		

		echo view('layout/header', $data);
		echo view('locationplan/locationplan_data', $view);
		echo view('layout/footer');
	}

	public function modalPallet()
	{
		$data = json_decode($this->request->getPost('json'));
		$wh = $data->wh_id;
		$unalocated_inbound = $this->reafmod->allInboundByWH($wh);

		$json=array();

			// $json[$id->inbound_id] = $this->reafun->materialDetail($id,$wh);
		$number = 0;
		foreach ($unalocated_inbound as $id) {
			$json[$number] = $this->reafun->materialDetail($id->inbound_id, $wh);
			// $total_quantity = $this->


			$number++;
		}

		echo json_encode($json);
	}

	public function savePalet()
	{
		$data = json_decode($this->request->getPost('json'));

		$inbound_id = $data->inbound_id;
		$material_id = $data->material_id;
		$row_alias = $data->row_alias;
		$block_number = $data->block_number;
		$qty_put = $data->quantity_put;
		$row_number = $data->row_number;
		$owner_id = $data->owner_id;

		$wh_id = $this->reafmod->allByInbound($inbound_id)->wh_id;
		$detil_realisasi = $this->reafun->getExpiredDate($inbound_id, $material_id)

		$data_insert = [
			'owner_id' => $owner_id,
			'wh_id' => $wh_id,
			'material_id' => $material_id,
			'expired_date' => $detil_realisasi->expired_date,
			'loc_id' => $detil_realisasi->loc_id,
			'block_type' => 'pallet',
			'row_alias' => $row_alias,
			'row_number' => $row_number,
			'block_number' => $block_number,
			'stok' => $qty_put
		];

		echo json_encode($data_insert);
	}
}
