                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Users</h2>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
											<li class="breadcrumb-item text-muted">
												<a href="javascript:" class="text-muted">Master Data</a>
											</li>
											<li class="breadcrumb-item text-muted">
												<a href="javascript:" class="text-muted">Users</a>
											</li>
											<li class="breadcrumb-item text-muted">
												<a href="javascript:" class="text-muted">Add Users</a>
											</li>
										</ul>
										<!--end::Breadcrumb-->
									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->
							</div>
						</div>
						<!--end::Subheader-->
                        <!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
                                <!--begin::Card-->
                                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
									<div class="card-header">
										<div class="card-title">
											<h3 class="card-label">Add New User</h3>
										</div>
										<div class="card-toolbar">
											<a href="<?= base_url('users'); ?>" class="btn btn-light-primary font-weight-bolder mr-2">
											<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
											<div class="btn-group">
												<button type="submit" form="add_users" class="btn btn-primary font-weight-bolder">
												<i class="ki ki-check icon-xs"></i>Create User</button>
											</div>
										</div>
									</div>
									<div class="card-body">
										<!--begin::Form-->
										<form action="<?php echo base_url('users/create'); ?>" method="post" class="form" id="add_users">
										<?= csrf_field(); ?>
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="my-5">
														<h3 class="text-dark font-weight-bold mb-10">User Information:</h3>
														<div class="form-group row">
															<label class="col-3">User ID</label>
															<div class="col-9">
																<input class="form-control text-success" type="text" name="user_id" value="<?= $autogen; ?>" readonly />
																<span class="form-text text-muted">User ID is automatically generated.</span>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-3">Fullname</label>
															<div class="col-9">
																<input class="form-control <?= ($validation->getError('fullname')) ? 'is-invalid' : ''; ?>" type="text" name="fullname" value="<?= old('fullname'); ?>" placeholder="John Doe" />
																<?php if($validation->getError('fullname')){ echo '<div class="invalid-feedback">'.$validation->getError('fullname').'</div>'; } ?>
															</div>
														</div>
                                                        <div class="form-group row">
															<label class="col-3">Email Address</label>
															<div class="col-9">
																<div class="input-group">
																	<div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="la la-at"></i>
																		</span>
																	</div>
																	<input type="email" name="email" class="form-control <?= ($validation->getError('email')) ? 'is-invalid' : ''; ?>" value="<?= old('email'); ?>" placeholder="john.doe@example.com" />
																	<?php if($validation->getError('email')){ echo '<div class="invalid-feedback">'.$validation->getError('email').'</div>'; } ?>
																</div>
                                                                <span class="form-text text-muted">We'll never share your email with anyone else.</span>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-3">Password</label>
															<div class="col-9">
																<input class="form-control <?= ($validation->getError('password')) ? 'is-invalid' : ''; ?>" value="<?= old('password'); ?>" type="password" name="password" placeholder="Example"/>
																<?php if($validation->getError('password')){ echo '<div class="invalid-feedback">'.$validation->getError('password').'</div>'; } ?>
                                                                <span class="form-text text-muted">Immediately tell the user's to change the password as soon as possible.</span>
															</div>
														</div>
                                                        <div class="form-group row">
															<label class="col-3">Role</label>
															<div class="col-9">
                                                                <select class="form-control selectpicker <?= ($validation->getError('level_id')) ? 'is-invalid' : ''; ?>" name="level_id" data-width="300px">
                                                                    <option value="" selected disabled>Select an option</option>
                                                                    <option value="LVL-001">Superuser</option>
                                                                    <option value="LVL-002">Admin</option>
                                                                    <option value="LVL-003">User</option>
                                                                </select>
																<?php if($validation->getError('level_id')){ echo '<div class="invalid-feedback">'.$validation->getError('level_id').'</div>'; } ?>
                                                            </div>
                                                        </div>
														<div class="form-group row">
															<label class="col-3">Contact Phone</label>
															<div class="col-9">
																<div class="input-group">
																	<div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="la la-phone"></i>
																		</span>
																	</div>
																	<input type="text" class="form-control <?= ($validation->getError('phone')) ? 'is-invalid' : ''; ?>" value="<?= old('phone'); ?>" name="phone" placeholder="08123456789" />
																	<?php if($validation->getError('phone')){ echo '<div class="invalid-feedback">'.$validation->getError('phone').'</div>'; } ?>
																</div>
																<span class="form-text text-muted">We'll never share your number with anyone else.</span>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-3">Company</label>
															<div class="col-9">
																<input class="form-control <?= ($validation->getError('company')) ? 'is-invalid' : ''; ?>" type="text" name="company" value="<?= old('company'); ?>" placeholder="XYZ Company" />
																<?php if($validation->getError('company')){ echo '<div class="invalid-feedback">'.$validation->getError('company').'</div>'; } ?>
															</div>
														</div>
                                                        <div class="form-group row">
															<label class="col-3">User Status</label>
															<div class="col-9">
                                                                <label class="radio radio-accent radio-success">
                                                                    <input type="radio" name="status" value="1" default checked>
                                                                    <span></span>&nbsp;Active</label>
                                                                <label class="radio radio-accent radio-danger" >
                                                                    <input type="radio" name="status" value="0">
                                                                    <span></span>&nbsp;Inactive</label>
                                                            </div>
                                                        </div>
													</div>
                                                </div>
											</div>
										</form>
										<!--end::Form-->
									</div>
								</div>
								<!--end::Card-->
                            </div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->