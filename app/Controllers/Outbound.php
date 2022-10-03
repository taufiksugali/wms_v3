<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialDetailModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;
use App\Models\OwnersModel;
use App\Models\OutboundModel;
use App\Models\OutboundDetailModel;
use Config\Services;

class Outbound extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->material_detail = new MaterialDetailModel();
        $this->customer = new CustomerModel();
        $this->warehouse = new WarehouseModel();
        $this->outbound = new OutboundModel();
        $this->owner = new OwnersModel();
        $this->outbound_detail = new OutboundDetailModel();

        helper(['form', 'url']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound Plan'
        ];	

		echo view('layout/header', $data);
		echo view('outbound/outbound_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'outbound.outbound_id',
            1 => 'outbound.create_date',
            2 => 'outbound.outbound_doc',
            3 => 'outbound.outbound_doc_date',
            4 => 'customer.customer_name',
            5 => 'warehouse.wh_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->outbound->all_outbound_count_bystatus("1");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $outbound = $this->outbound->all_outbound_bystatus($limit, $start, $order, $dir, "1");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $outbound = $this->outbound->search_outbound_bystatus($limit, $start, $search, $order, $dir, "1");
            $totalFiltered = $this->outbound->search_outbound_count_bystatus($search, "1");
        }

        $data = array();
        if(@$outbound) {
            foreach ($outbound as $row) {
                $start++;

                if(@$row->status == 1) {
                    $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                } else if(@$row->status == 2)  { 
                    $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Realization</span>';
                }

                $material_detail = $this->outbound->get_outbound_detail($row->outbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $outbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                foreach($material_detail as $det){
                    $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                    array_push($arrayDetail, $dataDet);
                }
                $outbound_det = join("", $arrayDetail);

                $nestedData['number'] = $start;
                $nestedData['outbound_id'] = @$row->outbound_id;
                $nestedData['outbound_doc'] = @$row->outbound_doc;
                $nestedData['outbound_date'] = date('d-m-Y', strtotime(@$row->create_date));
                $nestedData['customer_name'] = @$row->customer_name;
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['material_name'] = $outbound_mat;
                $nestedData['realization'] = @$outbound_det;
                $nestedData['status'] = $outbound_status;
                $nestedData['action'] = '<a href="'. base_url('outbound/detail/'.$row->outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"/>
					<path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
					<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
				</g>
				</svg></span></a>
                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_outbound" data-id="'.@$row->outbound_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                </g>
                </svg></span></button>';
                
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
		$fields = array('outbound_id', 'outbound_date', 'customer_name', 'warehouse_name', 'material_name', 'realization');
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
			'className' => 'text-center'
		);
		$columns[] = array(
			'data' => 'action',
			'className' => 'text-center text-nowrap'
		);
		echo json_encode($columns); 
	}

    public function add()
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

        if($this->request->getPost('po_id')){
            $outbound = $this->outbound->get_outbound($this->request->getPost('po_id'));
        }else{
            $purchase_order = '';
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'customer' => $this->customer->get_all_customer(),
            'owner' => $this->owner->get_all_owner()
		];

		echo view('layout/header', $data);
		echo view('outbound/add_outbound', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Outbound',
            'sidebar' => 'Outbound'
        ];

        $validate = $this->validate([
            'warehouse_id' => ['label' => 'Warehouse Origin', 'rules' => 'required'],
            'customer_id' => ['label' => 'Customer Name', 'rules' => 'required'],
            'owner_id' => ['label' => 'Owner Name', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/outbound/add'))->withInput();
        } else{
            $id = $this->outbound->generate_id();

            $data_outbound = [
                'outbound_id' => $id,
                'outbound_doc_date' => date_format(date_create($this->request->getPost('doc_date')), 'Y-m-d'),
                'out_date' => date_format(date_create($this->request->getPost('out_date')), 'Y-m-d'),
                'outbound_doc' => $this->request->getPost('doc_number'),
                'description' => $this->request->getPost('description'),
                'penerima' => $this->request->getPost('customer_id'),
                'outbound_wh_asal' => $this->request->getPost('warehouse_id'),
                'outbound_type' => 'TY003',
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname')
            ];

            $this->outbound->insert_data($data_outbound);

            if(@$this->request->getPost('material_id')){
                $i=0;
                foreach($this->request->getPost('material_id') as $row){
                    $detil_id = $this->outbound_detail->generate_id();
                    $data_outbound_detail = [
                        'det_outbound_id' => $detil_id,
                        'outbound_id' => $data_outbound['outbound_id'],
                        'material_detail_id' => $row,
                        'outbound_qty' => $this->request->getPost('quantity['.$i.']'),
                        'location_id' => $this->request->getPost('location['.$i.']'),
                        'status' => 1
                    ];
                    $i++;
                    $this->outbound_detail->insert_data($data_outbound_detail);
                }
            }

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('outbound'));

        }
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_outbound' => $this->outbound->get_outbound_byid($id),
            'outbound_detail' => $this->outbound->get_outbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('outbound/detail', $dataObject);
		echo view('layout/footer');
	}

    public function delete(){
        $id = $this->request->getGet('id');

        $result = $this->outbound_detail->delete_data($id);

        $result1 = $this->outbound->delete_data($id);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outbound'));
    }

    function get_material_byowner(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $data = $this->material_detail->get_material_byowner($owner_id, $warehouse_id);
        echo json_encode($data);
    }

    function get_location_bymaterial(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $data = $this->material_detail->get_location_bymaterial($owner_id, $warehouse_id, $material_id);
        echo json_encode($data);
    }

    function get_qty_bylocation(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $location_id = $this->request->getPost('location_id');
        $data = $this->material_detail->get_qty_bylocation($owner_id, $warehouse_id, $material_id, $location_id);
        echo json_encode($data);
    }
}
?>