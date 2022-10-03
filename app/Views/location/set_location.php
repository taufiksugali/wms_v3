<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Set Location</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Location</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Set Location</a>
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
                            <h3 class="card-title">Set Locationn</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('location/create'); ?>" onsubmit="return validate_form()">
                            <div class="card-body">
                                <div class="input_fields_loc">
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label class="font-weight-bold">Material Name
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" value="<?= $detail_material->mat_detail_id ?>" name="mat_detail_id" class="form-control" />
                                            <input type="hidden" value="<?= $detail_material->inbound_id ?>" name="inbound_id" class="form-control"/>
                                            <input type="hidden" value="<?= $detail_material->det_inbound_id ?>" name="detail_id" class="form-control" />
                                            <input type="text" value="<?= $detail_material->material_name ?>" name="inbound" disabled class="form-control <?= ($validation->getError('inbound_id')) ? 'is-invalid' : ''; ?>"  placeholder="Enter code" />
                                            <?php if($validation->getError('inbound_id')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Qty Good
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $detail_material->qty_good_in ?>" id="qty_good" name="qty_good" readonly class="form-control <?= ($validation->getError('supplier_id')) ? 'is-invalid' : ''; ?>" id="supplier_id" placeholder="Enter code" />
                                            <?php if($validation->getError('supplier_id')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label class="font-weight-bold">Qty Not Good  
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $detail_material->qty_notgood_in ?>" id="qty_not_good" name="qty_not_good" readonly class="form-control <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" id="warehouse_id" placeholder="Enter code" />
                                            <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <div id="po" class="add_location">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label class="font-weight-bold">Area<span class="text-danger">*</span></label>
                                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('material_id')) ? 'is-invalid' : ''; ?>" value="<?= old('area_id'); ?>" id="area_id0" name="area_id[]">
                                                                <option></option>
                                                                <?php if (@$warehouse_area) :
                                                                    foreach ($warehouse_area as $row) :
                                                                ?>
                                                                <option value="<?= $row->area_id ?>"><?= $row->wh_area_name ?></option>
                                                                <?php endforeach; endif; ?>
                                                            </select>
                                                            <?php if($validation->getError('area_id')){ echo '<div class="invalid-feedback">'.$validation->getError('area_id').'</div>'; } ?>
                                                        </div>
                                                        <div class="col-5">
                                                            <label class="font-weight-bold">Block<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <select class="select form-control custom-select showproduct <?= ($validation->getError('blok_id')) ? 'is-invalid' : ''; ?>" value="<?= old('blok_id'); ?>" id="blok_id0" name="blok_id[0]">
                                                                <option></option>
                                                                <?php if (@$blok) :
                                                                    foreach ($blok as $row) :
                                                                ?>
                                                                <option value="<?= $row->blok_id ?>"><?= $row->blok_name ?></option>
                                                                <?php endforeach; endif; ?>
                                                            </select>
                                                                <?php if($validation->getError('quantity')){ echo '<div class="invalid-feedback">'.$validation->getError('quantity').'</div>'; } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label class="font-weight-bold">Rack<span class="text-danger">*</span></label>
                                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('material_id')) ? 'is-invalid' : ''; ?>" value="<?= old('material_id'); ?>" id="rak_id0" name="rak_id[0]">
                                                                <option></option>
                                                                <?php if (@$rak) :
                                                                    foreach ($rak as $row) :
                                                                ?>
                                                                <option value="<?= $row->rak_id ?>"><?= $row->rak_name ?></option>
                                                                <?php endforeach; endif; ?>
                                                            </select>
                                                            <?php if($validation->getError('material_id')){ echo '<div class="invalid-feedback">'.$validation->getError('material_id').'</div>'; } ?>
                                                        </div>
                                                        <div class="col-5">
                                                            <label class="font-weight-bold">Shelf<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <select class="select form-control custom-select showproduct <?= ($validation->getError('material_id')) ? 'is-invalid' : ''; ?>" value="<?= old('material_id'); ?>" id="shelf_id0" name="shelf_id[0]">
                                                                    <option></option>
                                                                    <?php if (@$shelf) :
                                                                        foreach ($shelf as $row) :
                                                                    ?>
                                                                    <option value="<?= $row->shelf_id ?>"><?= $row->shelf_name ?></option>
                                                                    <?php endforeach; endif; ?>
                                                                </select>
                                                                <?php if($validation->getError('quantity')){ echo '<div class="invalid-feedback">'.$validation->getError('quantity').'</div>'; } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-11">
                                                            <label class="font-weight-bold">Qty<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control numbers <?= ($validation->getError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity0" name="quantity[0]" placeholder="Quantity">
                                                                <?php if($validation->getError('quantity')){ echo '<div class="invalid-feedback">'.$validation->getError('quantity').'</div>'; } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="separator separator-dashed"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                                <div class="col-12">
                                                    <button type="button" class="add_field_loc btn font-weight-bold btn-light-warning btn-sm">
                                                    <i class="la la-plus"></i>Add Location</button>
                                                </div>
                                            </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('realization'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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