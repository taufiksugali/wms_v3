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
                        <a href="" class="text-muted">Owner</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Edit Owner</a>
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
                            <h3 class="card-title">Edit Owner</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('owners/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Owner Name
                                    <span class="text-danger">*</span></label>
                                    <input type="hidden" name="owner_id" value="<?= $owner->owners_id ?>" />
                                    <input type="text" name="owner_name" value="<?= $owner->owners_name ?>" class="form-control <?= ($validation->getError('owner_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('owner_name')){ echo '<div class="invalid-feedback">'.$validation->getError('owner_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Owner Status
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('status')) ? 'is-invalid' : ''; ?>" value="<?= old('status'); ?>" id="status" name="status" >
                                            <option></option>
                                            <option value="1" <?php if($owner->owners_status == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($owner->owners_status == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('status')){ echo '<div class="invalid-feedback">'.$validation->getError('status').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('owners'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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