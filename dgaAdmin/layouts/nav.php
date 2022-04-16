<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <a href="#">
                        <img alt="Logo" src="{{ $getSetting->logo }}" class="h-25px logo" />
                    </a>
                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                                <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="aside-menu flex-column-fluid">
                    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                            <div class="menu-item">
                                <div class="menu-content pt-8 pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Home</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/home', 'active', '');?>" href="/dgaAdmin/home">
                                    <span class="menu-icon">
                                        <i class="las la-home fs-2"></i>
                                    </span>
                                    <span class="menu-title">Thống kê</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <div class="menu-content pt-8 pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Products</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/category', 'active', '');?>" href="/dgaAdmin/category">
                                    <span class="menu-icon">
                                        <i class="las la-tags fs-2"></i>
                                    </span>
                                    <span class="menu-title">Danh mục</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/product', 'active', '');?>" href="/dgaAdmin/product">
                                    <span class="menu-icon">
                                        <i class="las la-tags fs-2"></i>
                                    </span>
                                    <span class="menu-title">Sản phẩm</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/arrange', 'active', '');?>" href="/dgaAdmin/arrange">
                                    <span class="menu-icon">
                                        <i class="las la-list fs-2"></i>
                                    </span>
                                    <span class="menu-title">Sắp xếp</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/account', 'active', '');?>" href="/dgaAdmin/account">
                                    <span class="menu-icon">
                                        <i class="las la-list fs-2"></i>
                                    </span>
                                    <span class="menu-title">Thêm tài khoản</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/orders', 'active', '');?>" href="/dgaAdmin/orders">
                                    <span class="menu-icon">
                                        <i class="las la-cart-arrow-down fs-2"></i>
                                    </span>
                                    <span class="menu-title">Đơn hàng</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <div class="menu-content pt-8 pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">MEMBER</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/member', 'active', '');?>" href="/dgaAdmin/member">
                                    <span class="menu-icon">
                                        <i class="las la-users fs-2"></i>
                                    </span>
                                    <span class="menu-title">Danh sách</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/money', 'active', '');?>" href="/dgaAdmin/money">
                                    <span class="menu-icon">
                                        <i class="las la-money-bill-wave-alt fs-2"></i>
                                    </span>
                                    <span class="menu-title">Cộng - Trừ tiền</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <div class="menu-content pt-8 pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">SETTING</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/bank', 'active', '');?>" href="/dgaAdmin/bank">
                                    <span class="menu-icon">
                                        <i class="las la-university fs-2"></i>
                                    </span>
                                    <span class="menu-title">Ngân hàng</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(new Func)->active('/dgaAdmin/setting', 'active', '');?>" href="/dgaAdmin/setting">
                                    <span class="menu-icon">
                                        <i class="las la-cogs fs-2"></i>
                                    </span>
                                    <span class="menu-title">Thiết lập</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
                    <a href="https://zalo.me/0395562711"
                        class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-dismiss-="click" title="Hỗ trợ - tư vấn">
                        <span class="btn-label">DUNGA</span>
                        <span class="svg-icon btn-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                                    fill="black" />
                                <rect x="7" y="17" width="6" height="2" rx="1" fill="black" />
                                <rect x="7" y="12" width="10" height="2" rx="1" fill="black" />
                                <rect x="7" y="7" width="6" height="2" rx="1" fill="black" />
                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div id="kt_header" style="" class="header align-items-stretch">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="/dgaAdmin/home" class="d-lg-none">
                                <img alt="Logo" src="/dgaAdmin/assets/media/logos/logo-2.svg" class="h-30px" />
                            </a>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            <div class="d-flex align-items-stretch" id="kt_header_nav">
                                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                                        <div class="menu-item here show menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?=$title;?></span>
                                                <span class="menu-arrow d-lg-none"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch flex-shrink-0">
                                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <img src="https://img.icons8.com/fluency/48/000000/admin-settings-male.png" alt="user" />
                                    </div>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="https://img.icons8.com/fluency/48/000000/admin-settings-male.png" />
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">DUNGA
                                                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Admin</span>
                                                    </div>
                                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?=(new Settings)->info('token');?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item px-5">
                                            <a href="/logout.php" class="menu-link px-5">Sign Out</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black" />
                                                <path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>