<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\SupplierModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;
use App\Models\InboundModel;
use App\Models\InboundDetailModel;
use App\Models\PurchaseOrderModel;
use App\Models\PoDetailModel;
use App\Models\OwnersModel;
use App\Models\MaterialDetailModel;
use App\Models\MaterialSohModel;
use Config\Services;

class Inbound extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->supplier = new SupplierModel();
        $this->customer = new CustomerModel();
        $this->warehouse = new WarehouseModel();
        $this->purchase_order = new PurchaseOrderModel();
        $this->po_detail = new PoDetailModel();
        $this->inbound = new InboundModel();
        $this->inbound_detail = new InboundDetailModel();
        $this->material_detail = new MaterialDetailModel();
        $this->material_soh = new MaterialSohModel();
        $this->owner = new OwnersModel();

        helper(['form', 'url']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Inbound',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound Plan'
        ];	

		echo view('layout/header', $data);
		echo view('inbound/rencana_inbound', $data);
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

        $totalData = $this->inbound->all_inbound_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $inbound = $this->inbound->all_inbound($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $inbound = $this->inbound->search_inbound($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->inbound->search_inbound_count($search);
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
                $nestedData['action'] = '<a href="'. base_url('inbound/detail/'.$row->inbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"/>
					<path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
					<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
				</g>
				</svg></span></a>
                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_inbound" data-id="'.@$row->inbound_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
            'title' => 'Inbound',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

        if($this->request->getPost('po_id')){
            $purchase_order = $this->purchase_order->get_purchase_order($this->request->getPost('po_id'));
        }else{
            $purchase_order = '';
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'po_number' => $this->purchase_order->get_all_po(),
            'purchase_order' =>$purchase_order
		];

		echo view('layout/header', $data);
		echo view('inbound/add_inbound', $dataObject);
		echo view('layout/footer');
	}

    public function add_ver2()
	{
		$data = [
            'title' => 'Inbound',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

        if($this->request->getPost('po_id')){
            $purchase_order = $this->purchase_order->get_purchase_order($this->request->getPost('po_id'));
        }else{
            $purchase_order = '';
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'po_number' => $this->purchase_order->get_all_po(),
            'owner' => $this->owner->get_all_owner(),
            'purchase_order' =>$purchase_order
		];

		echo view('layout/header', $data);
		echo view('inbound/add_inbound_ver2', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Inbound',
            'sidebar' => 'Inbound'
        ];

        $validate = $this->validate([
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/inbound/add'))->withInput();
        } else{
            $id = $this->inbound->generate_id();
           

            $data_inbound = [
                'inbound_id' => $id,
                'inbound_po' => $this->request->getPost('po_id'),
                'inbound_location' => $this->request->getPost('warehouse_id'),
                'inbound_doc_date' => date_format(date_create($this->request->getPost('doc_date')), 'Y-m-d'),
                'inbound_doc' => $this->request->getPost('doc_number'),
                'description' => $this->request->getPost('description'),
                'inbound_type' => 'TY001',
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname')
            ];

            $this->inbound->insert_data($data_inbound);

            if(@$this->request->getPost('purchase_order')){
                $i=0;
                foreach($this->request->getPost('purchase_order') as $row){
                    $detil_id = $this->inbound_detail->generate_id();
                    $data_inbound_detail = [
                        'det_inbound_id' => $detil_id, // nilai ID Detil yang didapat dari generate_ids
                        'inbound_id' => $data_inbound['inbound_id'],
                        'po_detail_id' => $row, //nilai PO ID yang didapat dari table PO. diambil dari element dengan name purhase_order
                        'status' => 1
                    ];
                    $i++;
                    $this->inbound_detail->insert_data($data_inbound_detail);

                    $po_detail = [
                        'status' => 2
                    ];
                    $this->po_detail->update_data($row, $po_detail);

                    $cek = 0;
                    $detail_status = $this->po_detail->check_status($this->request->getPost('po_id'));
                    foreach($detail_status as $ds){
                        if($ds->status == 1){
                            $cek++;
                        }
                    }
                    if($cek == 0){
                        $po_status = [
                            'po_status' => 3
                        ];
                        $this->purchase_order->update_data($this->request->getPost('po_id'), $po_status);
                    } else {
                        $po_status = [
                            'po_status' => 2
                        ];
                        $this->purchase_order->update_data($this->request->getPost('po_id'), $po_status);
                    }
                }
            }
            
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('inbound'));
        }
    }

    public function create_ver2(){
        $data = [
            'title' => 'Inbound',
            'sidebar' => 'Inbound'
        ];

        $validate = $this->validate([
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/inbound/add'))->withInput();
        } else{
            $id = $this->inbound->generate_id();

            $data_inbound = [
                'inbound_id' => $id,
                'inbound_po' => $this->request->getPost('po_id'),
                'inbound_location' => $this->request->getPost('warehouse_id'),
                'inbound_doc_date' => date_format(date_create($this->request->getPost('po_date')), 'Y-m-d'),
                'inbound_doc' => $this->request->getPost('doc_number'),
                'description' => $this->request->getPost('description'),//tambahkan atribute lainnya disini
                'inbound_type' => 'TY001',
                'inbound_rcv_date' => date_format(date_create($this->request->getPost('rec_date')), 'Y-m-d H:i:s'),
                'inbound_rcv_by' => $this->request->getPost('rec_by'),
                'status' => 2,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname')
            ];

            $this->inbound->insert_data($data_inbound);

            if(@$this->request->getPost('purchase_order')){
                $i=0;
                foreach($this->request->getPost('purchase_order') as $row){
                    $detil_id = $this->inbound_detail->generate_id();
                    $good = str_replace(",", "",$this->request->getPost('good['.$i.']'));
                    $not_good = str_replace(",", "",$this->request->getPost('not_good['.$i.']'));
                    $data_inbound_detail = [
                        'det_inbound_id' => $detil_id, // nilai ID Detil yang didapat dari generate_ids
                        'inbound_id' => $data_inbound['inbound_id'],
                        'po_detail_id' => $row, //nilai PO ID yang didapat dari table PO. diambil dari element dengan name purhase_order
                        'qty_good_in' => $good,
                        'qty_notgood_in' => $not_good,
                        'qty_realization' => intval($good) + intval($not_good),
                        'cek' => $this->request->getPost('check['.$i.']'),
                        'status' => 2
                    ];
                    
                    $this->inbound_detail->insert_data($data_inbound_detail);

                    $po_detail = [
                        'status' => 2
                    ];
                    $this->po_detail->update_data($row, $po_detail);

                    $mat_detail_id = $this->material_detail->check_material($this->request->getPost('owner_id'), $this->request->getPost('material_id['.$i.']'), $this->request->getPost('batch['.$i.']'), $this->request->getPost('exp['.$i.']'));
                    if($mat_detail_id == 0){
                        $material_detail = [
                            'mat_detail_id' => $this->material_detail->generate_id(),
                            'owner_id' => $this->request->getPost('owner_id'),
                            'batch_no' => $this->request->getPost('batch['.$i.']'),
                            'expired_date' => date_format(date_create($this->request->getPost('exp['.$i.']')), 'Y-m-d'),
                            'material_id' => $this->request->getPost('material_id['.$i.']'),
                            'create_date' => date('Y-m-d H:i:s'),
                            'status' => 1,
                            'create_by' => session()->get('fullname')
                        ];
                        $this->material_detail->insert_data($material_detail);
    
                        $mat_soh = [
                            'soh_id' => $this->material_soh->generate_id(),
                            'mat_detail_id' => $material_detail['mat_detail_id'],
                            'stock_ok' => $data_inbound_detail['qty_good_in'],
                            'stock_nok' => $data_inbound_detail['qty_notgood_in'],
                            'status' => 1
                        ];

                        $this->material_soh->insert_data($mat_soh);
                    } else {
                        $stock_ok = $this->material_soh->get_currrent_stock($mat_detail_id)->stock_ok;
                        $stock_nok = $this->material_soh->get_currrent_stock($mat_detail_id)->stock_nok;
                        $mat_soh = [
                            'stock_ok' => intval($data_inbound_detail['qty_good_in']) + intval($stock_ok),
                            'stock_nok' => intval($data_inbound_detail['qty_notgood_in']) + intval($stock_nok),
                            'status' => 1
                        ];
                        $this->material_soh->update_data($mat_detail_id, $mat_soh);
                    }
                    $i++;
                    $cek = 0;
                    $detail_status = $this->po_detail->check_status($this->request->getPost('po_id'));
                    foreach($detail_status as $ds){
                        if($ds->status == 1){
                            $cek++;
                        }
                    }
                    if($cek == 0){
                        $po_status = [
                            'po_status' => 3
                        ];
                        $this->purchase_order->update_data($this->request->getPost('po_id'), $po_status);
                    } else {
                        $po_status = [
                            'po_status' => 2
                        ];
                        $this->purchase_order->update_data($this->request->getPost('po_id'), $po_status);
                    }
                }
            }
            
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('inbound'));
        }
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Inbound',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_inbound' => $this->inbound->get_inbound_byid($id),
            'inbound_detail' => $this->inbound->get_inbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('inbound/detail', $dataObject);
		echo view('layout/footer');
	}

    public function get_purchase()
	{
		$purchase_order = $this->purchase_order->get_purchase_order($this->request->getPost('po_id'));
		$do_list = "";
		if(@$purchase_order){
			if(@$purchase_order){
                $i=0;
				foreach ($purchase_order as $row) {
                    $i++;
	                if($row->qty > 1){
	                    $po_uom = $row->uom_name.'(s)';
	                }else{
	                    $po_uom = $row->uom_name;
	                }
					$do_list .= '<tr class="text-nowrap">
		                <td><input type="checkbox" class="listCheckbox purchaseCheck" name="purchase_order[]" value="'.$row->po_detail_id.'"/></td>
		                <td>'.$row->po_detail_id.'</td>
                        <td>'.$row->po_number.'</td>
                        <td>'.date('d-m-Y', strtotime($row->po_date)).'</td>
		                <td>'.$row->material_name.'</td>
		                <td class="text-right">'.number_format($row->qty).' '.$po_uom.'</td>
                        <td>'.$row->due_date.'</td>
		            </tr>';

                    // $do_list .= '<tr class="text-nowrap">
                    //     <td>'.$i.'</td>
		            //     <td hidden="true"><input type="text" name="purchase_order[]" value="'.$row->po_detail_id.'"/></td>
		            //     <td>'.$row->po_detail_id.'</td>
                    //     <td>'.$row->po_number.'</td>
                    //     <td>'.date('d-m-Y', strtotime($row->po_date)).'</td>
		            //     <td>'.$row->material_name.'</td>
                    //     <td>'.$row->due_date.'</td>
                    //     <td><input type="text" style="width: 100px;" name="batch[]"/></td>
                    //     <td><input type="text" id="kt_datepicker_2" readonly="readonly" style="width: 100px;" name="exp[]"/></td>
                    //     <td class="text-right">'.number_format($row->qty).' '.$po_uom.'</td>
                    //     <td class="text-right"><input type="hidden" style="width: 55px;" name="material_id[]" value="'.$row->material_id.'"/></td>
                    //     <td><input type="text" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="qty_realization[]"/></td>
                    //     <td><input type="text" style="width: 55px;" name="left[]"/></td>
                    //     <td><input type="text" value="'.$row->qty.'" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="good[]"/></td>
                    //     <td><input type="text" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="not_good[]"/></td>
                    //     <td><input type="text" style="width: 55px;" name="total[]"/></td>
                    //     <td><input type="checkbox" class="listCheckbox purchaseCheck" name="check[]" value="1"/></td>
                    //     <script src="'.base_url().'/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
		            // </tr>';
				}
			}
		}else{
			$do_list = '<tr class="text-center">
                <td colspan="11">No data available in table</td>
            </tr>';
		}
		$callback = array(
			'do_list' => $do_list
		);
		echo json_encode($callback);
	}

    public function get_purchase_2()
	{
		$purchase_order = $this->purchase_order->get_purchase_order($this->request->getPost('po_id'));
		$do_list = "";
		if(@$purchase_order){
			if(@$purchase_order){
                $i=0;
                $j=0;
				foreach ($purchase_order as $row) {
                    $j++;
	                if($row->qty > 1){
	                    $po_uom = $row->uom_name.'(s)';
	                }else{
	                    $po_uom = $row->uom_name;
	                }
					// $do_list .= '<tr class="text-nowrap">
		            //     <td><input type="checkbox" class="listCheckbox purchaseCheck" name="purchase_order[]" value="'.$row->po_detail_id.'"/></td>
		            //     <td>'.$row->po_detail_id.'</td>
                    //     <td>'.$row->po_number.'</td>
                    //     <td>'.date('d-m-Y', strtotime($row->po_date)).'</td>
		            //     <td>'.$row->material_name.'</td>
		            //     <td class="text-right">'.number_format($row->qty).' '.$po_uom.'</td>
                    //     <td>'.$row->due_date.'</td>
		            // </tr>';

                    $do_list .= '<tr class="text-nowrap">
                        <td>'.$j.'</td>
		                <td hidden="true"><input type="text" name="purchase_order[]" value="'.$row->po_detail_id.'"/></td>
		                <td>'.$row->po_detail_id.'</td>
                        <td>'.$row->po_number.'</td>
                        <td>'.date('d-m-Y', strtotime($row->po_date)).'</td>
		                <td>'.$row->material_name.'</td>
                        <td>'.$row->due_date.'</td>
                        <td><input type="text" style="width: 100px;" name="batch[]" required/></td>
                        <td><input type="text" id="kt_datepicker_2" readonly="readonly" style="width: 100px;" name="exp[]" required/></td>
                        <td class="text-right"><input type="hidden" id="po_qty_'.$i.'" value="'.$row->qty.'" >'.number_format($row->qty).' '.$po_uom.'</td>
                        <td hidden="true"><input type="text" style="width: 55px;" name="material_id[]" value="'.$row->material_id.'"/></td>
                        <td><input type="text" id="realisasi_'.$i.'" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="qty_realization[]" readonly /></td>
                        <td><input type="text" id="sisa_'.$i.'" style="width: 55px;" name="left[]" readonly /></td>
                        <td><input type="text" id="good_qty_'.$i.'" value="'.$row->qty.'" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this); hitung_total('.$i.'); " name="good[]" required /></td>
                        <td><input type="text" id="notgood_qty_'.$i.'" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this); hitung_total('.$i.'); " name="not_good[]" required /></td>
                        <td><input type="text" id="total_'.$i.'" style="width: 55px;" name="total[]" readonly /></td>
                        <td><input type="checkbox" class="listCheckbox purchaseCheck" name="check[]" value="1"/></td>
                        <script src="'.base_url().'/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
		            </tr>';
                    $i++;
				}
			}
		}else{
			$do_list = '<tr class="text-center">
                <td colspan="11">No data available in table</td>
            </tr>';
		}
		$callback = array(
			'do_list' => $do_list
		);
		echo json_encode($callback);
	}

    public function delete(){
        $id = $this->request->getGet('id');

        $result = $this->inbound_detail->delete_data($id);

        $result1 = $this->inbound->delete_data($id);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('inbound'));
    }

}
?>