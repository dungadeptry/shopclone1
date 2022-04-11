<div id="page-container">
    <main id="main-container">
        <div class="bg-image">
            <div class="row no-gutters justify-content-center bg-primary-dark-op">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                        <div class="row no-gutters">
                            <div class="col-md-12 order-md-1 bg-white">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    <div class="mb-2 text-center">
                                        <a class="link-fx font-w700 font-size-h1" href="">
                                            <span class="text-dark"><?= (new Settings)->info('name'); ?></span><span class="text-primary"></span>
                                        </a>
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">Đăng nhập</p>
                                    </div>
                                    <form id="formLogin">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-alt" id="login-username" name="username" placeholder="Tài khoản" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-alt" id="login-password" name="password" placeholder="Mật khẩu" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                                            <div class="custom-control custom-checkbox custom-control-primary">
                                                <input type="checkbox" class="custom-control-input" id="login-remember-me" name="remember">
                                                <label class="custom-control-label" for="login-remember-me">Ghi nhớ</label>
                                            </div>
                                            <div class="font-w600 font-size-sm py-1">
                                                <a href="https://vlclone.com/forgot-password">Quên mật khẩu?</a>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-hero-primary">
                                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Đăng nhập </button>
                                        </div>
                                    </form>
                                    <div class="font-w600 font-size-sm py-1 text-center">
                                        Chưa có tài khoản? <a href="https://vlclone.com/register">Đăng ký</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
        </div>
        <?php if ((new Settings)->info('show_buy') == 0) { ?>
            <button class="btn btn-hero-danger scroll-down">Click để xem hàng</button>
            <div class="content" id="selling-bm">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-center">
                            Danh sách BM đang bán tại VLclone.com
                        </h3>
                    </div>
                    <div class="block-content block-content-full border-bottom">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-1">
                                <div class="custom-control custom-block custom-control-primary">
                                    <label class="custom-control-label p-2" for="type-select-7">
                                        <span class="d-flex align-items-center">
                                            <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;">
                                                <strong class="text-primary">3</strong>
                                            </div>
                                            <span class="text-truncate ml-2">
                                                <span class="font-w700">BM1 Nolimit</span>
                                                <span class="d-block font-size-sm text-muted">Đã Tạo 1TKQC +7 USD|Bao đổi tiền, múi giờ|Bao Tụt Limit|Đã VeryMail</span>
                                                <i style="position: absolute; right: 5px; bottom: 10px;" class="fa fa-question-circle text-muted js-tooltip-enabled" data-toggle="tooltip" data-placement="top" title="" data-original-title="Đã Tạo 1TKQC +7 USD|Bao đổi tiền, múi giờ|Bao Tụt Limit|Đã VeryMail"></i>
                                                <span class="d-block font-size-sm text-muted">
                                                    <i class="font-w400" style="font-size: 0.77rem;"></i> <strong class="text-danger">»
                                                        99,000đ</strong>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                    <span class="custom-block-indicator">
                                        <i class="fa fa-check"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-1">
                                <div class="custom-control custom-block custom-control-primary">
                                    <label class="custom-control-label p-2" for="type-select-7">
                                        <span class="d-flex align-items-center">
                                            <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;">
                                                <span class="text-danger text-center font-weight-bolder" style="font-size: 9px;">SOLD OUT</span>
                                            </div>
                                            <span class="text-truncate ml-2">
                                                <span class="font-w700">BM 350$ +7 USD Ngâm 4 Tháng</span>
                                                <span class="d-block font-size-sm text-muted">Đã Tạo 1TKQC +7 USD | Limit 50-250$ | Đã VeryMail</span>
                                                <i style="position: absolute; right: 5px; bottom: 10px;" class="fa fa-question-circle text-muted js-tooltip-enabled" data-toggle="tooltip" data-placement="top" title="" data-original-title="Đã Tạo 1TKQC +7 USD | Limit 50-250$ | Đã VeryMail"></i>
                                                <span class="d-block font-size-sm text-muted">
                                                    <i class="font-w400" style="font-size: 0.77rem;"></i> <strong class="text-danger">»
                                                        99,000đ</strong>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                    <span class="custom-block-indicator">
                                        <i class="fa fa-check"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </main>
</div>


<script src="/public/assets/js/dashmix.core.min.js?v=<?= $DUNGA->version; ?>"></script>
<script src="/public/assets/js/dashmix.app.min.js?v=<?= $DUNGA->version; ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11?v=<?= $DUNGA->version; ?>"></script>
<script src="/public/assets/js/dunga.js?v=<?= $DUNGA->version; ?>"></script>
<script>
    $(function() {
        $('.scroll-down').click(function() {
            $('html, body').animate({
                scrollTop: $('#selling-bm').offset().top
            }, 'slow');
            return false;
        });
    });
    $('#formLogin').on('submit', function() {
        var data = $(this).serialize();
        $.ajax({
            url: "/modun/login/post",
            method: "POST",
            dataType: "JSON",
            data: data,
            success: function(data) {
                if (data.status === "error") {
                    swal(data.message, "error");
                } else {
                    swal(data.message, "success");
                    setTimeout(function() {
                        location.href = '/home';
                    }, 2000);
                }
            }
        });
        return false;
    });
</script>
</body>

</html>