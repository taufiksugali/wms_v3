<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialGroupModel;
use App\Models\UomModel;
use Config\Services;

class Material extends BaseController
{
    public function __construct()
    {
        if (session()->get('logged_in') == null) {
			session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Sorry, Your session has been ended.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
		}
		date_default_timezone_set('Asia/Jakarta');
        $this->material = new MaterialModel();
        $this->material_group = new MaterialGroupModel();
        $this->uom = new UomModel();

        helper(['form', 'url']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index()
    {
        $data = [
            'title' => 'Material',
            'title_menu' => 'Material',
            'sidebar' => 'Material'
        ];	

		echo view('layout/header', $data);
		echo view('material/material_data', $data);
		echo view('layout/footer');
    }

    public function getData()
    {

        $columns = array( 
            0 => 'material_id',
            1 => 'material_name',
            2 => 'description',
            3 => 'mat_group_name',
            4 => 'uom_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->material->all_material_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $material = $this->material->all_material($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $material = $this->material->search_material($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->material->search_material_count($search);
        }

        $data = array();
        if(@$material) {
            foreach ($material as $row) {
                $start++;

                if(@$row->status == 1) {
                    $material_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                } else { 
                    $material_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                }

                $nestedData['number'] = $start;
                $nestedData['material_code'] = @$row->material_code;
                $nestedData['material_name'] = @$row->material_name;
                $nestedData['description'] = @$row->description;
                $nestedData['mat_group'] = @$row->mat_group_name;
                $nestedData['mat_uom'] = @$row->uom_name;
                $nestedData['status'] = $material_status;
                $nestedData['action'] = '<a href="'.base_url('material/edit/'.@$row->material_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                </g>
                </svg></span></a>
                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_material" data-id="'.@$row->material_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
		$fields = array('material_code', 'material_name', 'description', 'mat_group', 'mat_uom');
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
            'title' => 'Add material',
            'title_menu' => 'Material',
            'sidebar' => 'Material'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'mat_group' => $this->material_group->get_all_mat_group(),
            'mat_uom' => $this->uom->get_all_uom()
		];
		echo view('layout/header', $data);
		echo view('material/add_material', $dataObject);
		echo view('layout/footer');
	}

    public function create()
    {
        $data = [
            'title' => 'Add material',
            'sidebar' => 'Material'
        ];

        $validate = $this->validate([
            'material_name' => ['label' => 'Material Name', 'rules' => 'required'],
            'mat_group_id' => ['label' => 'Material Group', 'rules' => 'required'],
            'material_weight' => ['label' => 'Weight', 'rules' => 'required'],
            'material_length' => ['label' => 'Length', 'rules' => 'required'],
            'material_height' => ['label' => 'Height', 'rules' => 'required'],
            'material_width' => ['label' => 'Width', 'rules' => 'required'],
            'material_uom' => ['label' => 'Material Unit', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/material/add'))->withInput();
        } else{
            $id = $this->material->generate_id();

            $data_material = [
                'material_id' => $id,
                'material_code' => $this->request->getPost('material_code'),
                'material_name' => $this->request->getPost('material_name'),
                'description' => $this->request->getPost('description'),
                'mat_group_id' => $this->request->getPost('mat_group_id'),
                'mat_uom' => $this->request->getPost('material_uom'),
                'material_weight' => $this->request->getPost('material_weight'),
                'material_height' => $this->request->getPost('material_height'),
                'material_length' => $this->request->getPost('material_length'),
                'material_width' => $this->request->getPost('material_width'),
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname')
            ];

            $this->material->insert_data($data_material);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('material'));
        }
    }

    public function edit($id)
	{
		$data = [
            'title' => 'Edit Material',
            'title_menu' => 'Material',
            'sidebar' => 'Material'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'mat_group' => $this->material_group->get_all_mat_group(),
            'mat_uom' => $this->uom->get_all_uom(),
            'material_edit' => $this->material->get_material_byid($id)
		];
		echo view('layout/header', $data);
		echo view('material/edit_material', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $data = [
            'title' => 'Edit material',
            'sidebar' => 'material'
        ];

        $validate = $this->validate([
            'material_name' => ['label' => 'Material Name', 'rules' => 'required'],
            'mat_group_id' => ['label' => 'Material Group', 'rules' => 'required'],
            'material_weight' => ['label' => 'Weight', 'rules' => 'required'],
            'material_length' => ['label' => 'Length', 'rules' => 'required'],
            'material_height' => ['label' => 'Height', 'rules' => 'required'],
            'material_width' => ['label' => 'Width', 'rules' => 'required'],
            'material_uom' => ['label' => 'Material Unit', 'rules' => 'required'],
            'status' => ['label' => 'Status', 'rules' => 'required']
        ]);

        $id = $this->request->getPost('material_id');

        if (!$validate) {
            return redirect()->to(base_url('/material/edit'. $id))->withInput();
        } else{

            $data_material = [
                'material_code' => $this->request->getPost('material_code'),
                'material_name' => $this->request->getPost('material_name'),
                'description' => $this->request->getPost('description'),
                'mat_group_id' => $this->request->getPost('mat_group_id'),
                'mat_uom' => $this->request->getPost('material_uom'),
                'material_weight' => $this->request->getPost('material_weight'),
                'material_height' => $this->request->getPost('material_height'),
                'material_length' => $this->request->getPost('material_length'),
                'material_width' => $this->request->getPost('material_width'),
                'status' => $this->request->getPost('status'),
                'update_date' => date('Y-m-d H:i:s'),
                'update_by' => session()->get('fullname')
            ];

            $this->material->update_data($id, $data_material);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('material'));
        }
    }
}