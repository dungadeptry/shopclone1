<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">
        <nav id="sidebar" aria-label="Main Navigation">
            <div class="bg-header-dark">
                <div class="content-header bg-white-10">
                    <a class="link-fx font-w600 font-size-lg text-white" href="/">
                        <span class="smini-visible"><span class="text-white-75">F</span><span class="text-white">B</span></span>
                        <span class="smini-hidden"><span class="text-white-75"></span><img style="width: 100%;" src="img/logo.svg?q=2"></span>
                    </a>
                    <div>
                        <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)"> <i class="fa fa-times-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` IS NULL ORDER BY `arrange` ASC") as $row) { ?>
                        <li class="nav-main-heading"><?= $row['name']; ?></li>
                        <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` = '" . $row['token'] . "' ORDER BY `arrange` ASC") as $product) { ?>
                            <li class="nav-main-item">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon far fa-eye"></i>
                                    <span class="nav-main-link-name">Mua <?= $product['name']; ?></span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="/#mua-<?= strtolower($product['name']); ?>">
                                            <i class="nav-main-link-icon far fa-eye"></i>
                                            <span class="nav-main-link-name">Mua <?= $product['name']; ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="/index.php?act=orders&t=<?= strtolower($row['name']); ?>">
                                            <i class="nav-main-link-icon fa fa-history"></i>
                                            <span class="nav-main-link-name">Lịch sử mua <?= $product['name']; ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <li class="nav-main-heading">Thanh toán</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/recharge"><i class="nav-main-link-icon fa fa-dollar-sign"></i>
                            <span class="nav-main-link-name">Nạp tiền</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="history.php"><i class="nav-main-link-icon fa fa-history"></i>
                            <span class="nav-main-link-name">Lịch sử nạp tiền</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/support"> <i class="nav-main-link-icon fa fa-headset"></i>
                            <span class="nav-main-link-name">Hỗ trợ</span>
                        </a>
                    </li>
                    <!-- <li class="nav-main-heading">BM TOOLS</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="check-limit-bm.php"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Check Limit BM</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="check-live-bm.php"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Check Live BM</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="checkliveid.php"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Check Live UID</span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </nav>
        <header id="page-header">
            <div class="content-header">
                <div>
                    <button type="button" class="btn btn-dual mr-1" data-toggle="layout" data-action="sidebar_toggle"><i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
                <div>
                    <div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-hero-success d-none d-md-inline-block">Số dư: <?=number_format($user->info('money'));?>đ</button> <a href="charge.php" class="btn btn-hero-info">Nạp Tiền</a>
                            <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-fw fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block"><?=$user->info('username');?></span>
                                <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">Thông tin tài khoản</div>
                                <div class="p-2">
                                    <a class="dropdown-item" href="/profile"><i class="far fa-fw fa-user mr-1"></i> Tài khoản</a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php"> <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="page-header-loader" class="overlay-header bg-primary-darker">
                    <div class="content-header">
                        <div class="w-100 text-center"> <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
        </header>