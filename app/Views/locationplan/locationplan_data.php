<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Putaway</h5>
				<!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Location</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Location Plan</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Dropdowns-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container">
        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Location Plan
                        <span class="d-block text-muted pt-2 font-size-sm">approximate floor plan</span></h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="<?= base_url('location-design/add'); ?>" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Add Location</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <style>
                        .btn-progress{
                            width: 5em;
                            height: 2.5em;
                        }
                        .btn-progress-indicator{
                            position: absolute;
                            z-index: 10;
                            top: 50%;
                            left: 50%; 
                            transform: 
                            translate(-50%, -50%);
                            font-size: .9em;
                        }
                        .btn-progress-50{
                            position: absolute;
                            left:  0;
                            top:  0;
                            height: 100%;
                            background-color: greenyellow;
                        }
                        .btn-progress-75{
                            position: absolute;
                            left:  0;
                            top:  0;
                            height: 100%;
                            background-color: yellow;
                        }
                        .btn-progress-100{
                            position: absolute;
                            left:  0;
                            top:  0;
                            height: 100%;
                            background-color: darksalmon;
                        }
                        
                    </style>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <?= session()->getFlashdata('message'); ?>

                        <?php 
                        if(count($all_lokasi) > 0){
                            foreach($all_lokasi as $result){ ?>
                                <h4 class="m-0">Location <?= $result->row_alias ?></h4>
                                <span class="d-block text-muted pt-2 font-size-sm p-0"><?= $result->block_type ?> <?= $result->row_alias ?></span>
                                <div class="border border-success rounded px-2 py-5 d-flex overflow-auto justify-content-evenly align-items-center mb-5" style="max-width: 100%; ">
                                    <?php
                                    for ($i=1; $i <= $result->row_number ; $i++) { ?>
                                        <div class="mx-5" style="min-width: fit-content;">
                                            <h5 class="text-center" ><?= $result->row_alias." $i" ?></h5>
                                            <?php 
                                            for ($b=1; $b <= $result->block_number ; $b++) { ?>
                                                <button class="btn btn-sm btn-outline-light my-1 position-relative overflow-hidden rounded-pill btn-progress <?= ($result->block_type == 'pallet')?'modal-pallet':'modal-rack' ?>" data-bs-toggle="modal"
                                                    data-wh_id="<?= $result->wh_id ?>"
                                                    data-loc_id="<?= $result->location_id ?>"
                                                    data-block_type="<?= $result->block_type ?>"
                                                    data-row_alias="<?= $result->row_alias ?>"
                                                    data-row_number="<?= $i ?>"
                                                    data-block_number="<?= $b ?>"
                                                    data-max_capacity="<?= $result->max_capacity ?>"
                                                    <?= ($result->block_type == 'rack')?'data-rack_number="'.$result->rack_number.'"':'' ?>
                                                    data-uom_standard="<?= $result->uom_standard ?>"
                                                    >
                                                    <div class="btn-progress-indicator text-nowrap"><b><?= "Block ".$b ?></b></div>
                                                    <div class="btn-progress-50" style="width: 20%;">
                                                    </div>
                                                </button>                                                
                                                <?php
                                                if(($b%2) == 0){
                                                    echo "<br>";
                                                }                                            
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->










    <!-- modal for rack -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
    Launch demo modal
</button> -->

<div class="modal fade" tabindex="-1" id="rackModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">Put Material</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <label><strong>Unalocated inbound :</strong></label>
                        <br>
                        <div class="form-group">
                            <label>Inbound ID
                                <span class="text-danger">*</span>
                            </label>
                            <select class="select2 select form-control custom-select " id="MRInboundId" name="warehouse_name" >

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Block Type
                                <span class="text-danger">*</span>
                            </label>
                            <select class="select2 select form-control custom-select " id="blockType" name="block_type" >
                                <option value="pallet">Pallet</option>
                                <option value="rack">Rack</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="closeModal('#rackModal')">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- modal for pallet
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#palletModal">
    Launch demo modal
</button> -->

<div class="modal fade" tabindex="-1" id="palletModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalPalletTitle">Put Material to Pallet </h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label><strong>Unalocated inbound :</strong>
                        </label>
                        <br>
                        <div class="form-group">
                            <label>Inbound Id
                                <span class="text-danger">*</span>
                            </label><br>
                            <select class="select2 select form-control custom-select " id="MPInboundId" name="block_type" style="width:100%">
                                
                            </select>
                        </div> 
                        <div class="form-group">
                            <label>Materials
                                <span class="text-danger">*</span>
                            </label><br>
                            <select class="select2 select form-control custom-select " id="MPMaterialName" name="block_type" style="width:100%">
                                
                            </select>
                        </div>                                                                   
                    </div>
                    <div class="col-md-6">
                        <label><strong>-</strong>
                        </label>
                        <div class="form-group">
                            <label>Maximum space capacity left(bag)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="max_capacity" class="form-control " placeholder="max-capacity" id="maxCapacity" disabled />
                        </div>  
                         <div class="form-group">
                            <label>Space Available(bag)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="max_capacity" class="form-control " disabled />
                        </div>   
                    </div>                                      
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label><strong>Set Quantity :</strong>
                        </label>
                        <div class="form-group">
                            <label>Quantity to put
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="max_capacity" class="form-control" id="quantityPut" />
                        </div>                                                                                    
                    </div>
                    <div class="col-md-3">
                        <label><strong>-</strong>
                        </label>
                        <div class="form-group">
                            <label>Material Qty Available
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="max_capacity" class="form-control" id="MPMaterialQty" disabled />
                        </div>    
                    </div>                                      
                </div>
            </div>

            <div class="modal-footer">
                <input type="text" id="rowAlias">
                <input type="text" id="rowNumber">
                <input type="text" id="blockNumber">
                <input type="text" id="owner_id">
                <button type="button" class="btn btn-light" onclick="closeModal('#palletModal')">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePalet()">Save changes</button>
            </div>
        </div>
    </div>
</div>


<select data-qty="" value="">
    <option value="id-mat-01" data-qty="10">nama material</option>
</select>