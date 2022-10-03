<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Purchase Order</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Purchase Order</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Purchase Order</a>
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
                            <h3 class="card-title">Add Purchase Order</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('purchaseorder/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>PO Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="po_number" class="form-control <?= ($validation->getError('po_number')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                            <?php if($validation->getError('po_number')){ echo '<div class="invalid-feedback">'.$validation->getError('po_number').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>PO Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" value="<?php echo date_format(date_create(date('Y-m-d')), 'd-m-Y'); ?>" readonly="readonly" name="po_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('po_date')){ echo '<div class="invalid-feedback">'.$validation->getError('po_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Supplier Name
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('supplier_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="supplier_id" name="supplier_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$supplier as $row) { ?>
                                                <option value="<?= @$row->supplier_id; ?>"><?= @$row->supplier_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('supplier_id')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Due Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" name="due_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('due_date')){ echo '<div class="invalid-feedback">'.$validation->getError('due_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description
                                        <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description" ></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div id="po" class="add_product">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <button type="button" class="add_field_button btn font-weight-bold btn-light-warning btn-sm">
                                                        <i class="la la-plus"></i>Add Material</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label class="font-weight-bold">Material<span class="text-danger">*</span></label>
                                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('material_id')) ? 'is-invalid' : ''; ?>" value="<?= old('material_id'); ?>" id="material_id0" name="material_id[]">
                                                                <option></option>
                                                                <?php if (@$material) :
                                                                    foreach ($material as $row) :
                                                                ?>
                                                                <option value="<?= $row->material_id ?>"><?= $row->material_name ?></option>
                                                                <?php endforeach; endif; ?>
                                                            </select>
                                                            <?php if($validation->getError('material_id')){ echo '<div class="invalid-feedback">'.$validation->getError('material_id').'</div>'; } ?>
                                                        </div>
                                                        <div class="col-5">
                                                            <label class="font-weight-bold">Quantity<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control numbers <?= ($validation->getError('quantity')) ? 'is-invalid' : ''; ?>" value="<?= old('quantity'); ?>" id="quantity" name="quantity[0]" placeholder="Quantity">
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
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('allocation'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
