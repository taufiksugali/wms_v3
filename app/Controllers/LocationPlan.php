<?php 
namespace App\Controllers;

use App\Models\WarehouseModel;
use App\Models\LocDesignModel;
use App\Models\RealizationAfterModel;
use App\Models\RealizationAfterUnalocatedModel;
use App\Models\LocationSohModel;
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
		$this->locsoh = new LocationSohModel;
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
		$all_stok_lokasi = $this->locsoh->allStokByWh(session('wh_id'));
		
		$data_lokasi = count($all_lokasi);
		$fields = array();

		$view = [
			'all_lokasi' => $all_lokasi,
			'all_stok_lokasi' => $all_stok_lokasi
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
		$stok = $this->locsoh->getTotalItemInStorageForPallet('pallet', $data->row_alias, $data->row_number, $data->block_number, $data->wh_id);
		foreach ($unalocated_inbound as $id) {
			$json[$number] = $this->reafun->materialDetail($id->inbound_id, $wh);
			$number++;
		}
		$json[$number]['stok'] = $stok->stok;

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
		$batch_number = $data->batch_number;
		$quantity_before = $data->quantity_before;
		$reafun_id = $data->reafun_id;

		$wh_id = $this->reafmod->allByInbound($inbound_id)->wh_id;
		$detil_realisasi = $this->reafun->getExpiredDate($inbound_id, $material_id, $batch_number);

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

		$check_soh = $this->locsoh->cekSoh($owner_id, $material_id, $wh_id, $detil_realisasi->expired_date, 'pallet', $row_alias, $row_number, $block_number);
		
		if($check_soh > 0){ //jika data sudah ada-> update
			$stok_before = $this->locsoh->getTotalItemAndIdSohPallet($owner_id, $material_id, $wh_id, $detil_realisasi->expired_date, 'pallet', $row_alias, $row_number, $block_number);

			$this->locsoh->updateSoh($stok_before->loc_soh_id, array('stok'=> $stok_before->stok + $data_insert['stok']));

			$data_insert['new_stok'] = $stok_before->stok.'&'.$data_insert['stok'];
			$data_insert['action'] = 'update';

		}else{ // jika data belum ada

			$this->locsoh->insertSoh($data_insert);
			$data_insert['action'] = 'insert';

		}

		// kurangi data
		$newQty = $quantity_before - $data_insert['stok'];
		$this->reafun->updateStok($reafun_id, array('good_stok'=> $newQty, 'last_action'=> 'dikurangi'.$data_insert['stok']));

		// cek inbound apakah masih memiliki stok tersedia, jika tidak ubah status

		$stok_tersedia = $this->reafun->cekSisaStok($inbound_id)->total;

		if($stok_tersedia == 0){
			$id_reafmod = $this->reafmod->getIdByInbound($inbound_id)->reaf_id;
			$this->reafmod->updateStatusAllocated($id_reafmod, array('allocated_all' => 'yes'));
		}


		echo json_encode($data_insert);
	}
}
