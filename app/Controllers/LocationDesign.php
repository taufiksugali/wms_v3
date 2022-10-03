<?php 
namespace App\Controllers;

use App\Models\WarehouseModel;
use App\Models\LocDesignModel;
use Config\Services;

/**
 * 
 */
class LocationDesign extends BaseController
{
	
	public function __construct()
	{
		$this->warehouse = new WarehouseModel;
		$this->locdesign = new LocDesignModel;
	}

	public function index()
	{	
		$data = [
			'title' => 'Location design',
			'title_menu' => 'Warehouse',
			'sidebar' => 'Warehouse'
		];

		echo view('layout/header', $data);
		echo view('location_design/location_design_data');
		echo view('layout/footer');
	}

	public function add()
	{	

		if(session('wh_id') == null){
			session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Forbidden; You are not a warehouse administrator.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
			return redirect()->to(base_url('locationdesign'));
			exit;
		}

		$data = [
			'title' => 'Location design',
			'title_menu' => 'Warehouse',
			'sidebar' => 'Warehouse',
			'viewjs' => 'location-add'
		];

		$viewsData = [
			'wh_name_list' => $this->warehouse->curent_warehouse(session('wh_id'))
		];
		echo view('layout/header', $data);
		echo view('location_design/location_design_add', $viewsData);
		echo view('layout/footer', $data);
	}

	public function create()
	{	
		$block_type = $this->request->getPost('block_type');
		if($block_type == 'pallet'){
			$rack_number = null;
		}elseif($block_type == 'rack'){
			$rack_number = $this->request->getPost('rack_number');
		}
		$data = [
			'wh_id' => $this->request->getPost('warehouse_name'),
			'block_type' => strtoupper($block_type),
			'row_alias' => strtoupper($this->request->getPost('row_alias')),
			'row_number' => $this->request->getPost('row_number'),
			'block_number' => $this->request->getPost('block_number'),
			'rack_number' => $rack_number,
			'uom_standard' => strtoupper($this->request->getPost('uom')),
			'max_capacity' => $this->request->getPost('max_capacity')

		];
		$cek_available = $this->locdesign->is_null_location($data['wh_id'], $data['block_type'], $data['row_alias']);
		if($cek_available > 0){
			session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Failed; the same block type and row alias already exists.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
			return redirect()->to(base_url('locationdesign/add'));
			exit;
		}else{

			$result = $this->locdesign->insert_data($data);
			if(isset($result)){
				session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Success; New location added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
				return redirect()->to(base_url('locationdesign/add'));
				exit;
			}
		}
		var_dump($cek_available);
	}
	public function getColumns()
	{
		$fields = array('wh_name', 'row_alias', 'block_type', 'row_number', 'block_number', 'uom_standard', 'max_capacity', 'convertion');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
		$columns[] = array(
			'data' => 'action',
			'className' => 'text-center text-nowrap'
		);
		$columns[] = array(
			'data' => 'status',
			'className' => 'text-center'
		);
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
				'className' => 'text-nowrap text-center'
			);
		}
		echo json_encode($columns); 
	}

	public function getData()
	{
		$columns = array( 
			0 => 'wh_id',
			4 => 'row_alias',
			5 => 'block_type',
			6 => 'row_number',
			7 => 'block_number',
			8 => 'uom_standard',
			9 => 'max_capacity',
		);

		$limit = $this->request->getPost('length');
		$start = $this->request->getPost('start');
		$order = $columns[$this->request->getPost('order')[0]['column']];
		$dir = $this->request->getPost('order')[0]['dir']; 
		$requirements = array($limit,$start,$order,$dir);

		$totalData = $this->locdesign->countWhLocationByWhId(session('wh_id'));
		$totalFiltered = $totalData;
		if(empty($this->request->getPost('search')['value'])) { 
			$location = $this->locdesign->allLocationByWh($limit, $start, $order, $dir, session('wh_id'));
		}
		else {
			$search = $this->request->getPost('search')['value']; 
			$location = $this->locdesign->searchAllLocationByWh($limit, $start, $order, $dir, session('wh_id'), $search);
			$totalFiltered = $this->locdesign->search_warehouse_count($search);
		}

		$data = array();
		if(@$location){
			foreach($location as $row){
				$start++;
				$nestedData['number'] = $start;
				$nestedData['action'] = '<a href="'.base_url('warehouse/edit/'.@$row->warehouse_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                </g>
                </svg></span></a>
                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->warehouse_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                </g>
                </svg></span></button>';
				$nestedData['status'] = '<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div></div>';
				$nestedData['wh_name'] = $row->wh_name;
				$nestedData['row_alias'] = $row->row_alias;
				$nestedData['block_type'] = $row->block_type;
				$nestedData['row_number'] = $row->row_number;
				$nestedData['block_number'] = $row->block_number;
				$nestedData['uom_standard'] = $row->uom_standard;
				$nestedData['max_capacity'] = ($row->block_type == 'rack') ? $row->max_capacity.' x '.$row->rack_number : $row->max_capacity;
				$nestedData['convertion'] = 'unset';

				$data[]= $nestedData;
			}
		}

		// $result = array(
		// 	'limit' => $limit,
		// 	'start' => $start,
		// 	'order' => $order,
		// 	'dir' => $dir,
		// 	'req' => ''
		// );
		$json_data = array(
			"draw"            => intval($this->request->getPost('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data
		);

		echo json_encode($json_data);
	}


}





?>