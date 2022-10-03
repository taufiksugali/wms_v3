<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\LocationModel;
use App\Models\WhAreaModel;
use App\Models\BlokModel;
use App\Models\RakModel;
use App\Models\ShelfModel;
use App\Models\InboundDetailModel;
use App\Models\InboundModel;
use App\Models\PurchaseOrderModel;
use App\Models\PoDetailModel;
use Config\Services;

class Location extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->location = new LocationModel();
        $this->area = new WhAreaModel();
        $this->blok = new BlokModel();
        $this->rak = new RakModel();
        $this->shelf = new ShelfModel();
        $this->po_detail = new PoDetailModel();
        $this->inbound_detail = new InboundDetailModel();
        $this->inbound = new InboundModel();

        helper(['form', 'url']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Materiallocation',
            'title_menu' => 'Material Location',
            'sidebar' => 'Location'
        ];	

		echo view('layout/header', $data);
		echo view('location/material_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'inbound.inbound_id',
            1 => 'inbound.inbound_id',
            2 => 'inbound.create_date',
            3 => 'inbound.inbound_doc',
            4 => 'supplier.supplier_name',
            5 => 'warehouse.warehouse_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->location->all_material_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $location = $this->location->all_material($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $location = $this->location->search_material($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->location->search_material_count($search);
        }

        $data = array();
        if(@$location) {
            foreach ($location as $row) {
                $start++;

                if(@$row->status == 1) {
                    $inbound_status = '<span class="label label-light-success label-pill label-inline mr-2">'.$row->status.'</span>';
                } else if(@$row->status == 2)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">'.$row->status.'</span>';
                }

                $nestedData['number'] = $start;
                $nestedData['inbound_id'] = @$row->inbound_id;
                $nestedData['recieve_date'] = date('d-m-Y', strtotime(@$row->inbound_rcv_date));
                $nestedData['material_name'] = @$row->material_name;
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['qty_good'] = @$row->qty_good_in;
                $nestedData['qty_not_good'] = @$row->qty_notgood_in;
                $nestedData['qty_total'] = @$row->qty_realization;
                $nestedData['action'] = '<a href="'. base_url('location/add/'.$row->det_inbound_id.'/'.$row->inbound_location).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Map\Marker2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                </g>
            </svg><!--end::Svg Icon--></span></a>';
                
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->request->getPost('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data
                );
            
        echo json_encode($json_data);
    }

    public function getColumns()
	{
		$fields = array('inbound_id', 'recieve_date', 'material_name', 'warehouse_name', 'qty_good', 'qty_not_good', 'qty_total');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
                'className' => 'text-nowrap'
			);
		}
		$columns[] = array(
			'data' => 'action',
			'className' => 'text-center text-nowrap'
		);
		echo json_encode($columns); 
	}

    public function add($id, $warehouse)
	{
		$data = [
            'title' => 'Materiallocation',
            'title_menu' => 'Location',
            'sidebar' => 'Material Location' 
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse_area' => $this->area->get_wharea_bywhid($warehouse),
            'blok' => $this->blok->get_all_blok(),
            'rak' => $this->rak->get_all_rak(),
            'shelf' => $this->shelf->get_all_shelf(),
            'detail_material' => $this->location->get_detail_material($id)
		];

		echo view('layout/header', $data);
		echo view('location/set_location', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Materiallocation',
            'sidebar' => 'Inbound'
        ];

        // $validate = $this->validate([
        //     'area_id[]' => ['label' => 'Warehouse', 'rules' => 'required']
        // ]);

        // if (!$validate) {
        //     return redirect()->to(base_url('/location/add'))->withInput();
        // } else{

            $i = 0;
            $good = $this->request->getPost('qty_good');
            $not_good = $this->request->getPost('qty_not_good');
            $total = $good + $not_good;

            $qty_all = 0;
            foreach($this->request->getPost('area_id') as $row){
                $id = $this->location->generate_id();
                $data_location = [
                    'location_id' => $id,
                    'material_detail_id' => $this->request->getPost('mat_detail_id'),
                    'shelf_id' => $this->request->getPost('shelf_id['.$i.']'),
                    'qty' => $this->request->getPost('quantity['.$i.']'),
                    'status' => 1,
                    'create_date' => date('Y-m-d H:i:s'),
                    'create_by' => session()->get('fullname')
                ];
    
                $this->location->insert_data($data_location);
                $i++;
            }

            $inbound_detail_id = $this->request->getPost('detail_id');
            $data_inbound_detail = [
                'status' => 3
            ];
            $this->inbound_detail->update_data($inbound_detail_id, $data_inbound_detail);

            $cek = 0;
            $detail_status = $this->inbound_detail->check_status($this->request->getPost('inbound_id'));
            foreach($detail_status as $ds){
                if($ds->status == 2){
                    $cek++;
                }
            }
            if($cek == 0){
                $inbound_status = [
                    'status' => 3
                ];
                $this->inbound->update_data($this->request->getPost('inbound_id'), $inbound_status);
            }
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material Location successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('location'));

        // }
    }
}
?>