<?php

namespace App\Controllers;
use App\Models\WarehouseModel;
use Config\Services;

class Warehouse extends BaseController
{
    public function __construct()
    {
        $this->warehouse = new WarehouseModel();

        helper(['form', 'url']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Warehouse',
            'title_menu' => 'Warehouse',
            'sidebar' => 'Warehouse'
        ];	

		echo view('layout/header', $data);
		echo view('warehouse/warehouse_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'warehouse_id',
            1 => 'wh_code',
            2 => 'wh_name',
            3 => 'wh_city',
            4 => 'wh_pic',
            5 => 'wh_pic_phone',
            6 => 'wh_pic_email'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $requirements = array($limit,$start,$order,$dir);

        $totalData = $this->warehouse->all_warehouse_count();
        $totalFiltered = $totalData;
        if(empty($this->request->getPost('search')['value'])) { 
            $warehouse = $this->warehouse->all_warehouse($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $warehouse = $this->warehouse->search_warehouse($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->warehouse->search_warehouse_count($search);
        }

        $data = array();
        if(@$warehouse) {
            foreach ($warehouse as $row) {
                $start++;

                if(@$row->status == 1) {
                    $warehouse_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                } else { 
                    $warehouse_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                }

                if(@$row->wh_city){
                    $city_name = $this->warehouse->get_city_name($row->wh_city);
                }else{
                    $city_name = '';
                }

                $nestedData['number'] = $start;
                $nestedData['wh_code'] = @$row->wh_code;
                $nestedData['wh_name'] = @$row->wh_name;
                $nestedData['wh_address'] = @$row->wh_address;
                $nestedData['wh_city'] = $city_name;
                $nestedData['wh_pic'] = @$row->wh_pic;
                $nestedData['wh_pic_phone'] = @$row->wh_pic_phone;
                $nestedData['wh_pic_email'] = @$row->wh_pic_email;
                $nestedData['status'] = @$warehouse_status;
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
		$fields = array('wh_code', 'wh_name', 'wh_address', 'wh_city', 'wh_pic', 'wh_pic_phone', 'wh_pic_email');
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
            'title' => 'Add warehouse',
            'title_menu' => 'warehouse',
            'sidebar' => 'warehouse'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse_city' => $this->get_regency()
		];
		echo view('layout/header', $data);
		echo view('warehouse/add_warehouse', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Add Warehouse',
            'sidebar' => 'Warehouse'
        ];

        $validate = $this->validate([
            'warehouse_name' => ['label' => 'Warehouse Name', 'rules' => 'required'],
            'warehouse_address' => ['label' => 'Warehouse Address', 'rules' => 'required'],
            'warehouse_city' => ['label' => 'Warehouse City', 'rules' => 'required'],
            'pic_name' => ['label' => 'PIC Name', 'rules' => 'required'],
            'pic_phone' => ['label' => 'PIC Phone', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/warehouse/add'))->withInput();
        } else{
            $id = $this->warehouse->generate_id();

            $data_warehouse = [
                'warehouse_id' => $id,
                'wh_code' => $this->request->getPost('warehouse_code'),
                'wh_name' => $this->request->getPost('warehouse_name'),
                'wh_address' => $this->request->getPost('warehouse_address'),
                'wh_city' => $this->request->getPost('warehouse_city'),
                'wh_pic' => $this->request->getPost('pic_name'),
                'wh_pic_phone' => $this->request->getPost('pic_phone'),
                'wh_pic_email' => $this->request->getPost('pic_email'),
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname')
            ];

            $this->warehouse->insert_data($data_warehouse);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Warehouse successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('warehouse'));
        }
    }

    public function edit($id)
	{
		$data = [
            'title' => 'Edit warehouse',
            'title_menu' => 'Warehouse',
            'sidebar' => 'Warehouse'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse_city' => $this->get_regency(),
            'warehouse' => $this->warehouse->get_warehouse_byid($id)
		];
		echo view('layout/header', $data);
		echo view('warehouse/edit_warehouse', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $data = [
            'title' => 'Edit Warehouse',
            'sidebar' => 'Warehouse'
        ];

        $validate = $this->validate([
            'warehouse_name' => ['label' => 'Warehouse Name', 'rules' => 'required'],
            'warehouse_address' => ['label' => 'Warehouse Address', 'rules' => 'required'],
            'warehouse_city' => ['label' => 'Warehouse City', 'rules' => 'required'],
            'pic_name' => ['label' => 'PIC Name', 'rules' => 'required'],
            'pic_phone' => ['label' => 'PIC Phone', 'rules' => 'required'],
            'status' => ['label' => 'Status', 'rules' => 'required']
        ]);

        $id = $this->request->getPost('warehouse_id');

        if (!$validate) {
            return redirect()->to(base_url('/warehouse/edit'. $id))->withInput();
        } else{

            $data_warehouse = [
                'wh_code' => $this->request->getPost('warehouse_code'),
                'wh_name' => $this->request->getPost('warehouse_name'),
                'wh_address' => $this->request->getPost('warehouse_address'),
                'wh_city' => $this->request->getPost('warehouse_city'),
                'wh_pic' => $this->request->getPost('pic_name'),
                'wh_pic_phone' => $this->request->getPost('pic_phone'),
                'wh_pic_email' => $this->request->getPost('pic_email'),
                'status' => $this->request->getPost('status'),
                'update_date' => date('Y-m-d H:i:s'),
                'update_by' => session()->get('fullname')
            ];

            $this->warehouse->update_data($id, $data_warehouse);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Warehouse successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('warehouse'));
        }
    }

    public function get_regency()
	{
		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $GLOBALS['hris'] . 'api/Hris_Api/getAllRegency?token=0a05252241f3bc45ffc4abaeca369963');
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);

		return @$dataObject->data;
	}

    public function delete(){
        $id = $this->request->getGet('id');
        // var_dump($id);
        // exit;
        $data = [
            'status' => 0
        ];

        $result = $this->warehouse->update_data($id, $data);
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Owner successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('blok'));
    }
}
?>