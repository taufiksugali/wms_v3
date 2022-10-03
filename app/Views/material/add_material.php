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
                        <a href="" class="text-muted">Material</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Material</a>
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
                            <h3 class="card-title">Add Material</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('material/create'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Material Code
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="material_code" class="form-control <?= ($validation->getError('material_code')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                    <?php if($validation->getError('material_code')){ echo '<div class="invalid-feedback">'.$validation->getError('material_code').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Material Name
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="material_name" class="form-control <?= ($validation->getError('material_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('material_name')){ echo '<div class="invalid-feedback">'.$validation->getError('material_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Description
                                    <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description"></textarea>
                                    <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Material Group<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('mat_group_id')) ? 'is-invalid' : ''; ?>" value="<?= old('mat_group_id'); ?>" id="service" name="mat_group_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$mat_group as $row) { ?>
                                        <option value="<?= @$row->mat_group_id; ?>"><?= @$row->mat_group_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('mat_group_id')){ echo '<div class="invalid-feedback">'.$validation->getError('mat_group_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Material Unit<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('material_uom')) ? 'is-invalid' : ''; ?>" value="<?= old('material_uom'); ?>" id="uom_id" name="material_uom">
                                        <option value="" selected></option>
                                        <?php foreach(@$mat_uom as $row) { ?>
                                        <option value="<?= @$row->uom_id; ?>"><?= @$row->uom_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('material_uom')){ echo '<div class="invalid-feedback">'.$validation->getError('material_uom').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Material Weight
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="material_weight" class="form-control <?= ($validation->getError('material_weight')) ? 'is-invalid' : ''; ?>" placeholder="Enter weight" />
                                    <?php if($validation->getError('material_weight')){ echo '<div class="invalid-feedback">'.$validation->getError('material_weight').'</div>'; } ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="font-weight-bold">Volume<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control numbers <?= ($validation->getError('material_length')) ? 'is-invalid' : ''; ?>" value="<?= old('material_length'); ?>" name="material_length" placeholder="Length"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                            <?php if($validation->getError('material_length')){ echo '<div class="invalid-feedback">'.$validation->getError('material_length').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="font-weight-bold">&nbsp;</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control numbers <?= ($validation->getError('material_width')) ? 'is-invalid' : ''; ?>" value="<?= old('material_width'); ?>" name="material_width" placeholder="Width"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                            <?php if($validation->getError('material_width')){ echo '<div class="invalid-feedback">'.$validation->getError('material_width').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="font-weight-bold">&nbsp;</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control numbers <?= ($validation->getError('material_height')) ? 'is-invalid' : ''; ?>" value="<?= old('material_height'); ?>" name="material_height" placeholder="Height"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                            <?php if($validation->getError('material_height')){ echo '<div class="invalid-feedback">'.$validation->getError('material_height').'</div>'; } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('material'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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