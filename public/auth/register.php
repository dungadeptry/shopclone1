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
                                            <span class="text-dark"><?= (new Settings)->info('name'); ?></span><span
                                                class="text-primary"></span>
                                        </a>
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">Tạo tài khoản</p>
                                    </div>
                                    <form id="formReg">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-alt" id="login-username"
                                                name="username" placeholder="Tài khoản" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-alt"
                                                id="login-password" name="password" placeholder="Mật khẩu" value=""
                                                autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-alt"
                                                id="login-password" name="confpassword" placeholder="Xác nhạn mật khẩu"
                                                value="" autocomplete="off">
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-hero-primary">
                                                <i class="fa fa-fw fa-user mr-1"></i> Đăng ký </button>
                                        </div>
                                    </form>
                                    <div class="font-w600 font-size-sm py-1 text-center">
                                        Đã có tài khoản? <a href="/login">Đăng nhập</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
        </div>
    </main>
</div>


<script src="/public/assets/js/dashmix.core.min.js?v=<?=(new Settings)->info('version');?>"></script>
<script src="/public/assets/js/dashmix.app.min.js?v=<?=(new Settings)->info('version');?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11?v=<?=(new Settings)->info('version');?>"></script>
<script src="/public/assets/js/dunga.js?v=<?=(new Settings)->info('version');?>"></script>
<script>
$('#formReg').on('submit', function() {
    var data = $(this).serialize();
    $.ajax({
        url: "/modun/register/post",
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