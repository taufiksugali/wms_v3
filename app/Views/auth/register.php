
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../../">
		<meta charset="utf-8" />
		<title><?= $title ?></title>
		<meta name="description" content="Singin page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="<?= base_url(); ?>/theme/dist/assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="<?= base_url(); ?>/logo/logo.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside d-flex flex-column flex-row-auto">
					<!--begin::Aside Top-->
					<div class="d-flex flex-column-auto flex-column pt-15 px-30">
						<!--begin::Aside header-->
						<!-- <a href="#" class="login-logo py-6">
							<img src="<?= base_url(); ?>/theme/dist/assets/media/logos/logo-1.png" class="max-h-70px" alt="" />
						</a> -->
						<!--end::Aside header-->
						<!--begin: Wizard Nav-->
						<div class="wizard-nav pt-5 pt-lg-15">
							<!--begin::Wizard Steps-->
							<div class="wizard-steps">
								<!--begin::Wizard Step 1 Nav-->
								<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">1</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title">Account Details</h3>
											<div class="wizard-desc">Setup Your Account Details</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 1 Nav-->
								<!--begin::Wizard Step 4 Nav-->
								<div class="wizard-step" data-wizard-type="step">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">2</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title">Completed!</h3>
											<div class="wizard-desc">Review and Submit</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 4 Nav-->
							</div>
							<!--end::Wizard Steps-->
						</div>
						<!--end: Wizard Nav-->
					</div>
					<!--end::Aside Top-->
					<!--begin::Aside Bottom-->
					<div class="aside-img-wizard d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center pt-1 pt-lg-3" style="background-position-y: calc(60%); background-image: url(<?= base_url(); ?>/theme/dist/assets/media/svg/illustrations/register.svg)"></div>
					<!--end::Aside Bottom-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="login-content flex-column-fluid d-flex flex-column p-10">
					<!--begin::Top-->
					<!-- <div class="text-right d-flex justify-content-center">
						<div class="top-signup text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
							<span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
							<a href="javascript:;" class="font-weight-bolder text-primary font-size-h4 ml-2" id="kt_login_signup">Get Help</a>
						</div>
					</div> -->
					<!--end::Top-->
					<!--begin::Wrapper-->
					<div class="d-flex flex-row-fluid flex-center">
						<!--begin::Signin-->
						<div class="login-form login-form-signup">
							<!--begin::Form-->
							<?= session()->getFlashdata('message'); ?>
							<form class="form" novalidate="novalidate" id="kt_login_signup_form" action="<?= base_url('auth/signup'); ?>" method="post">
								<!--begin: Wizard Step 1-->
								<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
									<!--begin::Title-->
									<div class="pb-10 pb-lg-15">
										<h3 class="font-weight-bolder text-dark display5">Create Account</h3>
										<div class="text-muted font-weight-bold font-size-h4">Already have an Account?
										<a href="<?= base_url('auth/'); ?>" class="text-primary font-weight-bolder">Sign In</a></div>
									</div>
                                    <!--begin::Row-->
									<div class="row">
										<div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Full Name</label>
                                                <input type="text" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= old('fullname'); ?>" placeholder="Full Name" />
												<?php if($validation->getError('fullname')){ echo '<div class="invalid-feedback">'.$validation->getError('fullname').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Email Address</label>
                                                <input type="text" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>" placeholder="Email Address" />
												<?php if($validation->getError('email')){ echo '<div class="invalid-feedback">'.$validation->getError('email').'</div>'; } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
										<div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Password</label>
                                                <input type="password" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('password')) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" />
												<?php if($validation->getError('password')){ echo '<div class="invalid-feedback">'.$validation->getError('password').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Confirm Password</label>
                                                <input type="password" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('repassword')) ? 'is-invalid' : ''; ?>" name="repassword" placeholder="Confirm Password" />
												<?php if($validation->getError('repassword')){ echo '<div class="invalid-feedback">'.$validation->getError('repassword').'</div>'; } ?>
                                            </div>
                                        </div>
                                    </div>
									<!--begin::Form Group-->
									<div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Phone</label>
                                            <input type="tel" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('phone')) ? 'is-invalid' : ''; ?>" id="signup_phone" name="phone" value="<?= old('phone'); ?>"placeholder="Phone" />
											<?php if($validation->getError('phone')){ echo '<div class="invalid-feedback">'.$validation->getError('phone').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Company</label>
                                            <input type="text" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" id="company" name="company" value="<?= old('company'); ?>" placeholder="Company" />
											<?php if($validation->getError('company')){ echo '<div class="invalid-feedback">'.$validation->getError('company').'</div>'; } ?>
                                            </div>
                                        </div>
									</div>
									<!--end::Form Group-->
								</div>
								<!--end: Wizard Step 1-->
								<!--begin: Wizard Step 4-->
								<div class="pb-5" data-wizard-type="step-content">
									<!--begin::Title-->
									<div class="pt-lg-0 pt-5 pb-15">
										<h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Complete Signing Up</h3>
										<div class="text-muted font-weight-bold font-size-h4">Complete Your Signup And Become a Member!</div>
									</div>
									<!--end::Title-->
									<!--begin::Section-->
									<h4 class="font-weight-bolder mb-3">Account Details:</h4>
									<div class="text-dark-50 font-weight-bold line-height-lg mb-8">
									User ID: <span><?= $autogen; ?></span></br>
                                    Fullname: <span id="get_fullname"></span></br>
                                    Email: <span id="get_email"></span></br>
									Phone: <span id="get_phone"></span></br>
									Company: <span id="get_company"></span></br>
									</div>
									<!--end::Section-->
								</div>
								<!--end: Wizard Step 4-->
								<!--begin: Wizard Actions-->
								<div class="d-flex justify-content-between pt-3">
									<div class="mr-2">
										<button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3" data-wizard-type="action-prev">
										<span class="svg-icon svg-icon-md mr-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)" x="14" y="7" width="2" height="10" rx="1" />
													<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>Previous</button>
									</div>
									<div>
										<button class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3" data-wizard-type="action-submit" type="submit" id="kt_login_signup_form_submit_button">Submit
										<span class="svg-icon svg-icon-md ml-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span></button>
										<button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3" data-wizard-type="action-next">Next
										<span class="svg-icon svg-icon-md ml-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span></button>
									</div>
								</div>
								<!--end: Wizard Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/js/pages/custom/login/login-3.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/js/pages/custom/login/sign-up.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>