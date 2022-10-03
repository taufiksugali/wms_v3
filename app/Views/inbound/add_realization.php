<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inbound</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Inbound Realization</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Inbound Realization</a>
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
                            <h3 class="card-title">Add Realization</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('realization/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Inbound ID
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" value="<?= $inbound_data->inbound_id ?>" name="inbound_id" id="inbound_id" placeholder="Enter code" />
                                            <input type="text" value="<?= $inbound_data->inbound_id ?>" name="inbound" disabled class="form-control <?= ($validation->getError('inbound_id')) ? 'is-invalid' : ''; ?>"  placeholder="Enter code" />
                                            <?php if($validation->getError('inbound_id')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                        <label class="font-weight-bold">Inbound Date
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $inbound_data->create_date ?>" name="inbound_date" disabled class="form-control <?= ($validation->getError('inbound_date')) ? 'is-invalid' : ''; ?>" id="inbound_date" placeholder="Enter code" />
                                            <input type="text" value="<?= $inbound_data->create_date ?>" name="inbound_date2" hidden class="form-control <?= ($validation->getError('inbound_date')) ? 'is-invalid' : ''; ?>" id="inbound_date" placeholder="Enter code" />
                                            <?php if($validation->getError('inbound_date')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Supplier Name
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $inbound_data->supplier_name ?>" name="supplier_id" disabled class="form-control <?= ($validation->getError('supplier_id')) ? 'is-invalid' : ''; ?>" id="supplier_id" placeholder="Enter code" />
                                            <?php if($validation->getError('supplier_id')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label class="font-weight-bold">Warehouse Destination
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $inbound_data->wh_name ?>" name="warehouse_id" disabled class="form-control <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" id="warehouse_id" placeholder="Enter code" />
                                            <input type="text" value="<?= $inbound_data->inbound_location ?>" name="warehouse_id2" hidden class="form-control <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" id="warehouse_id" placeholder="Enter code" />
                                            <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                        <label class="font-weight-bold">Document Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" hidden value="<?= date('m/d/Y', strtotime(@$inbound_data->inbound_doc_date)); ?>" name="doc_date2">
                                                    <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" value="<?= date('m/d/Y', strtotime(@$inbound_data->inbound_doc_date)); ?>" name="doc_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('doc_date')){ echo '<div class="invalid-feedback">'.$validation->getError('doc_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label class="font-weight-bold">Document Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="doc_number" value="<?= @$inbound_data->inbound_doc; ?>" class="form-control <?= ($validation->getError('doc_number')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                            <?php if($validation->getError('doc_number')){ echo '<div class="invalid-feedback">'.$validation->getError('doc_number').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                        <label class="font-weight-bold">Owner
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('owner_id')) ? 'is-invalid' : ''; ?>" value="<?= old('owner_id'); ?>" id="owner_id" name="owner_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$owner as $row) { ?>
                                                <option value="<?= @$row->owners_id; ?>"><?= @$row->owners_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('owner_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owner_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label class="font-weight-bold">Inbound Type
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="type_id" value="<?= $inbound_data->trans_type_name ?>" disabled class="form-control <?= ($validation->getError('type_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                            <?php if($validation->getError('type_id')){ echo '<div class="invalid-feedback">'.$validation->getError('type_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                        <label>Recieve Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker-input" date-format="Y-m-d H:i:s" readonly="readonly" value="<?= date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))) ; ?>" name="rec_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('rec_date')){ echo '<div class="invalid-feedback">'.$validation->getError('rec_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Recieve By
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="rec_by" class="form-control <?= ($validation->getError('rec_by')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                            <?php if($validation->getError('rec_by')){ echo '<div class="invalid-feedback">'.$validation->getError('rec_by').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description
                                        <span class="text-danger">*</span></label>
                                        <textarea name="description" disabled class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description" ><?= $inbound_data->description ?></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <label>Material Data</label>
                                    <div style="overflow-x:auto">
                                        <table class="table nowrap table-bordered table-checkable table-nopaging">
                                            <thead style="text-align: center; vertical-align: middle;"> 
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Material</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Batch No.</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Exp. Date</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Plan</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3" width="55px">Realization</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3" width="55px">Leftovers</th>
                                                    <th style="text-align: center; vertical-align: middle;" colspan="3" width="55px">Item Diterima</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3" width="55px">Check</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Kondisi</th>
                                                </tr>
                                                <tr>
                                                    <th width="55px">Good</th>
                                                    <th width="55px">Not Good</th>
                                                    <th width="55px">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(@$inbound_detail) :
                                                $i = 0;
                                                foreach ($inbound_detail as $row) :

                                                    if($row->qty > 1){
                                                        $po_uom = $row->uom_name.'(s)';
                                                    }else{
                                                        $po_uom = $row->uom_name;
                                                    }
                                                    ?>
                                                    <tr class="text-nowrap">
                                                        <td><input type="hidden" style="width: 55px;" name="material[]" value="<?= @$row->material_id ?>"/><?= @$row->material_name ?></td>
                                                        <td><input type="text" style="width: 100px;" name="batch[<?php echo $i ?>]"/></td>
                                                        <td><input type="text" id="kt_datepicker_2" readonly="readonly" style="width: 100px;" name="exp[<?php echo $i ?>]"/></td>
                                                        <td class="text-right"><input type="hidden" style="width: 55px;" name="det_inbound[<?php echo $i ?>]" value="<?= @$row->det_inbound_id ?>"/><?= number_format(@$row->qty).' '.@$po_uom ?></td>
                                                        <td><?= @$row->qty_realization ?></td>
                                                        <td><input type="text" style="width: 55px;" name="left[<?php echo $i ?>]"/></td>
                                                        <td><input type="text" value="<?= @$row->qty ?>" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="good[<?php echo $i ?>]"/></td>
                                                        <td><input type="text" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="not_good[<?php echo $i ?>]"/></td>
                                                        <td><input type="text" style="width: 55px;" name="total[<?php echo $i ?>]"/></td>
                                                        <td><input type="checkbox" class="listCheckbox purchaseCheck" name="check[<?php echo $i ?>]" value="1"/></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                            endforeach;
                                                        endif;
                                                    ?>
                                            </tbody>
                                        </table>
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
