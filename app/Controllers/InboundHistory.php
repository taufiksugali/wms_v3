<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\SupplierModel;
use App\Models\OwnersModel;
use App\Models\WarehouseModel;
use App\Models\InboundModel;
use App\Models\InboundDetailModel;
use App\Models\MaterialDetailModel;
use App\Models\PurchaseOrderModel;
use App\Models\PoDetailModel;
use Config\Services;

class Inboundhistory extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->supplier = new SupplierModel();
        $this->owner = new OwnersModel();
        $this->warehouse = new WarehouseModel();
        $this->purchase_order = new PurchaseOrderModel();
        $this->po_detail = new PoDetailModel();
        $this->inbound = new InboundModel();
        $this->inbound_detail = new InboundDetailModel();
        $this->material_detail = new MaterialDetailModel();

        helper(['form', 'url']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound History',
            'sidebar' => 'Inbound'
        ];	

		echo view('layout/header', $data);
		echo view('inbound/history_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'inbound.inbound_id',
            1 => 'inbound.inbound_id',
            2 => 'inbound.create_date',
            3 => 'supplier.supplier_name',
            4 => 'warehouse.wh_name',
            5 => 'inbound.inbound_id',
            6 => 'inbound.inbound_id',
            7 => 'purchase_order.due_date',
            8 => 'inbound.status'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->inbound->all_inbound_count_bystatus("2", "3");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $inbound = $this->inbound->all_inbound_bystatus($limit, $start, $order, $dir, "2", "3");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $inbound = $this->inbound->search_inbound_bystatus($limit, $start, $search, $order, $dir, "2", "3");
            $totalFiltered = $this->inbound->search_inbound_count_bystatus($search, "2", "3");
        }

        $data = array();
        if(@$inbound) {
            foreach ($inbound as $row) {
                $start++;

                if(@$row->status == 1) {
                    $inbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Plan</span>';
                } else if(@$row->status == 2)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Recieve</span>';
                } else if(@$row->status == 3)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Put Away</span>';
                }

                $material_detail = $this->inbound->get_inbound_detail($row->inbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $inbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                foreach($material_detail as $det){
                    $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                    array_push($arrayDetail, $dataDet);
                }
                $inbound_det = join("", $arrayDetail);


                $nestedData['number'] = $start;
                $nestedData['inbound_id'] = @$row->inbound_id;
                $nestedData['inbound_date'] = date('d-m-Y', strtotime(@$row->create_date));
                $nestedData['supplier_name'] = @$row->supplier_name;
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['material_name'] = $inbound_mat;
                $nestedData['realization'] = @$inbound_det;
                $nestedData['due_date'] = @$row->due_date;
                $nestedData['status'] = $inbound_status;
                $nestedData['action'] = '<a href="'. base_url('inboundhistory/detail/'.$row->inbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"/>
					<path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
					<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
				</g>
				</svg></span></a>';
                
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
		$fields = array('inbound_id', 'inbound_date', 'supplier_name', 'warehouse_name', 'material_name', 'realization', 'due_date');
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
			'data' => 'status',
			'className' => 'text-center text-nowrap'
		);
		$columns[] = array(
			'data' => 'action',
			'className' => 'text-center text-nowrap'
		);
		echo json_encode($columns); 
	}

    public function detail($id)
	{
		$data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_inbound' => $this->inbound->get_inbound_byid($id),
            'inbound_detail' => $this->inbound->get_inbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('inbound/detail_history', $dataObject);
		echo view('layout/footer');
	}
}
?>