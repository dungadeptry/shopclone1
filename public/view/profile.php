<main id="main-container">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="block block-rounded block-themed block-fx-pop">
                    <div class="block-header bg-gd-sea">
                        <h3 class="block-title">Cài đặt</h3>
                    </div>
                    <div class="block-content">
                        <h2 class="content-heading">Thông tin tài khoản</h2>
                        <div class="row">
                            <div class="offset-2 col-lg-8">
                                <div class="form-group row">
                                    <label class="col-sm-4">Tài khoản</label>
                                    <div class="col-sm-8">
                                        <span><?=$user->info('username');?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4">Số dư</label>
                                    <div class="col-sm-8">
                                        <span><?=number_format($user->info('money'));?> VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="content-heading">Đổi mật khẩu</h2>
                        <div class="row">
                            <div class="offset-2 col-lg-8">
                                <form class="mb-5" id="changePassword">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Mật khẩu hiện tại</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Mật khẩu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Mật khẩu mới</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Tạo mật khẩu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Xác nhận mật khẩu</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Xác nhận mật khẩu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $('#changePassword').on('submit', function() {
        var data = $(this).serialize();
        $.ajax({
            url: "/modun/change-password/post",
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