<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Master Data</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Location design</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add location</a>
                    </li>
                </ul>
                <!--end::Page Title-->
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
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Add Location</h3>
                    </div>
                    <?= session()->getFlashdata('message') ?>
                    <!--begin::Form-->
                    <form method="post" class="form" action="<?= base_url('LocationDesign/create'); ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label><strong>Warehouse :</strong></label>
                                    <br>
                                    <div class="form-group">
                                        <label>Warehouse Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="select2 select form-control custom-select " id="warehouseName" name="warehouse_name" >
                                            <?php 
                                            foreach($wh_name_list as $wh){
                                                ?>
                                                <option value="<?= $wh->warehouse_id ?>"><?= $wh->wh_name  ?></option>
                                                <?php
                                            }
                                            ?> 
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
                            <div class="row">
                                <div class="col-md-6">
                                    <label><strong>Location detail :</strong>
                                    </label>
                                    <br>
                                    <div class="form-group">
                                        <label>Row Aliasing (Row Code)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="row_alias" class="form-control " placeholder="Row Code" />
                                    </div>
                                    <div class="form-group">
                                        <label>Row Number
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="row_number" class="form-control " placeholder="Row Number" />
                                    </div>
                                    <div class="form-group">
                                        <label>Block Number
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="block_number" class="form-control " placeholder="Block Number" id="blockNumber">
                                    </div>
                                    <div class="form-group" style="display: none;" id="rackField">
                                        <label>Rack Number / partition
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="rack_number" id="rackNumber" class="form-control " placeholder="Rack number">
                                    </div>                                            
                                </div>
                                <div class="col-md-6">
                                    <label><strong>-</strong>
                                    </label>
                                    <div class="form-group">
                                        <label>Standard UOM
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="select2 select form-control custom-select " id="uom" name="uom" >
                                            <option value="bag">Bag</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Maximum capacity(bag)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="max_capacity" class="form-control " placeholder="max-capacity" />
                                    </div>
                                </div>                                      
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="<?= base_url('locationdesign'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
</div>
<!--end::Entry-->
</div>
                            <!--end::Content-->