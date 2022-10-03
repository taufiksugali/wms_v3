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

<head>
    <base href="../../">
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="description" content="Aside light theme example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet"
    type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet"
    type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet"
    type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/menu/light.css" rel="stylesheet"
    type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/brand/light.css" rel="stylesheet"
    type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/aside/light.css" rel="stylesheet"
    type="text/css" />
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
    type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?= base_url(); ?>/logo/logo.ico" />

    <!--  -->
    <script src="<?= base_url(''); ?>/theme/src/jquery/jquery-3.6.0.js"></script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <style>
        /*scrool bar*/
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #c9c9c9; 
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #858585; 
    border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #4f4f4f; 
}

</style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="<?= base_url('dashboard'); ?>">
        <img alt="Logo" src="<?= base_url('/logo/logos.png');?>" class="logo-default max-h-50px" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->
        <!--begin::Header Menu Mobile Toggle-->
        <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>
        <!--end::Header Menu Mobile Toggle-->
        <!--begin::Topbar Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
            <span class="svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <path
                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                    <path
                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                    fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </button>
    <!--end::Topbar Mobile Toggle-->
</div>
<!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
            <!--begin::Brand-->
            <div class="brand flex-column-auto" id="kt_brand">
                <!--begin::Logo-->
                <a href="index.html" class="brand-logo">
                    <img alt="Logo" src="<?= base_url('/logo/logos.png');?>" class="logo-default max-h-50px" />
                </a>
                <!--end::Logo-->
                <!--begin::Toggle-->
                <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                    <span class="svg-icon svg-icon svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                            <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Toolbar-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside Menu-->
        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
            <!--begin::Menu Container-->
            <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item" aria-haspopup="true">
                    <a href="<?= base_url('dashboard'); ?>" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path
                                d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                fill="#000000" fill-rule="nonzero" />
                                <path
                                d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item <?= (@$title == 'Allocation Plan' ? 'menu-item-active' : '') ?>"
                aria-haspopup="true">
                <a href="<?= base_url('allocation'); ?>" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                        viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                            d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                            fill="#000000" fill-rule="nonzero" />
                            <path
                            d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                            fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <span class="menu-text">Allocation Plan</span>
            </a>
        </li>
        <li class="menu-section">
            <h4 class="menu-text">Master Data</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>
        <li class="menu-item menu-item-submenu <?= (@$title == 'Owner' || @$title == 'Supplier' || @$title == 'Customer' || @$title == 'Warehouse' || @$title == 'Material' || @$title == 'Warehouse Area' || @$title == 'Blok Area' || @$title == 'Rak' || @$title == 'Shelf' || @$title == 'Location design'  ? 'menu-item-open' : '') ?>"
            aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                    viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                        <path
                        d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                        fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-text">Master Data</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link">
                        <span class="menu-text">Pages</span>
                    </span>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Owner' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('owners'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Owner</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Supplier' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('supplier'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Supplier</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Customer' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('customer'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Customer</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Material' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('material'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Material</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Warehouse' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('warehouse'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Warehouse</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Location design' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('locationdesign'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Location Design</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Warehouse Area' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('wharea'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Warehouse Area</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Blok Area' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('blok'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Blok Area</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Rak' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('rak'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Rak</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu <?= (@$title == 'Shelf' ? 'menu-item-active' : '') ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="<?= base_url('shelf'); ?>" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Shelf</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="menu-section">
        <h4 class="menu-text">Order</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item menu-item-submenu <?= (@$title == 'Purchaseorder' ? 'menu-item-open' : '') ?>"
        aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                <svg xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <path
                    d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                    fill="#000000" fill-rule="nonzero"
                    transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                    <path
                    d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                    fill="#000000" opacity="0.3" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-text">Purchase Order</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item <?= (@$title == 'Purchaseorder' ? 'menu-item-active' : '') ?>"
                aria-haspopup="true">
                <a href="<?= base_url('purchaseorder'); ?>" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Purchase Order</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="menu-section">
    <h4 class="menu-text">Inbound</h4>
    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
</li>
<li class="menu-item menu-item-submenu <?= (@$title == 'Inbound' || 
@$title == 'Inboundrealization' || @$title == 'Inboundhistory' ? 'menu-item-open' : '') ?>"
aria-haspopup="true" data-menu-toggle="hover">
<a href="javascript:;" class="menu-link menu-toggle">
    <span class="svg-icon menu-icon">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
        <svg xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24" />
            <path
            d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
            fill="#000000" fill-rule="nonzero"
            transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
            <path
            d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
            fill="#000000" opacity="0.3" />
        </g>
    </svg>
    <!--end::Svg Icon-->
</span>
<span class="menu-text">Inbound</span>
<i class="menu-arrow"></i>
</a>
<div class="menu-submenu">
    <i class="menu-arrow"></i>
    <ul class="menu-subnav">
        <li class="menu-item menu-item <?= (@$title == 'Inbound' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('inbound'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Inbound Plan</span>
            </a>
        </li>
        <li class="menu-item menu-item <?= (@$title == 'Inboundrealization' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('realization'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Inbound Realization</span>
            </a>
        </li>
        <li class="menu-item menu-item <?= (@$title == 'Inboundhistory' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('inboundhistory'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Inbound History</span>
            </a>
        </li>
    </ul>
</div>
</li>
<li class="menu-section">
    <h4 class="menu-text">Putaway</h4>
    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
</li>
<li class="menu-item menu-item-submenu <?= (@$title == 'Materiallocation' || @$title == 'Location Plan'  ? 'menu-item-open' : '') ?>"
    aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
            <svg xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <path
                d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                fill="#000000" fill-rule="nonzero"
                transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                <path
                d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                fill="#000000" opacity="0.3" />
            </g>
        </svg>
        <!--end::Svg Icon-->
    </span>
    <span class="menu-text">Location</span>
    <i class="menu-arrow"></i>
</a>
<div class="menu-submenu">
    <i class="menu-arrow"></i>
    <ul class="menu-subnav">
        <li class="menu-item menu-item <?= (@$title == 'Materiallocation' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('location'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Material Location</span>
            </a>
        </li>
        <li class="menu-item menu-item <?= (@$title == 'Location Plan' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('locationplan'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Location Plan </span>
            </a>
        </li>
    </ul>
</div>
</li>
<li class="menu-section">
    <h4 class="menu-text">Outbound</h4>
    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
</li>
<li class="menu-item menu-item-submenu <?= (@$title == 'Outbound' || @$title == 'Outboundrealization' || @$title == 'Outboundhistory' ? 'menu-item-open' : '') ?>"
    aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
            <svg xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <path
                d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                fill="#000000" fill-rule="nonzero"
                transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                <path
                d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                fill="#000000" opacity="0.3" />
            </g>
        </svg>
        <!--end::Svg Icon-->
    </span>
    <span class="menu-text">Outbound</span>
    <i class="menu-arrow"></i>
</a>
<div class="menu-submenu">
    <i class="menu-arrow"></i>
    <ul class="menu-subnav">
        <li class="menu-item menu-item <?= (@$title == 'Outbound' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('outbound'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Outbound Plan</span>
            </a>
        </li>
        <li class="menu-item menu-item <?= (@$title == 'Outboundrealization' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('out_realization'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Outbound Realization</span>
            </a>
        </li>
        <li class="menu-item menu-item <?= (@$title == 'Outboundhistory' ? 'menu-item-active' : '') ?>"
            aria-haspopup="true">
            <a href="<?= base_url('outboundhistory'); ?>" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">Outbound History</span>
            </a>
        </li>
    </ul>
</div>
</li>
</ul>
<!--end::Menu Nav-->
</div>
<!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
</div>
<!--end::Aside-->
<!--begin::Wrapper-->
<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                    <!--begin::Header Nav-->
                    <ul class="menu-nav">

                    </ul>
                    <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
            <!--begin::Topbar-->
            <div class="topbar">
                <!--begin::User-->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                    id="kt_quick_user_toggle">
                    <span
                    class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span
                    class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= session()->get('fullname'); ?></span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold"><i
                            class="fa fa-user"></i></span>
                        </span>
                    </div>
                </div>
                <!--end::User-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
                <!--end::Header-->