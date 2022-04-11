<main id="main-container">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="block block-rounded block-themed block-fx-pop">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Hỗ Trợ</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row mb-5">
                            <?php if ((new Settings)->info('spZalo') != NULL) { ?>
                                <div class="col-md-6 col-xl-3 text-center">
                                    <a class="block block-rounded bg-gd-sublime text-center" href="<?= (new Settings)->info('spZalo'); ?>">
                                        <div class="block-content block-content-full">
                                            <img class="img-avatar img-avatar-thumb img-avatar-rounded" src="/public/img/zalo-icon.png" alt="">
                                        </div>
                                        <div class="block-content block-content-full bg-black-10">
                                            <p class="font-w600 text-white mb-0">Group support</p>
                                            <p class="font-size-sm font-italic text-white-75 mb-0">Bấm vào đây</p>
                                        </div>
                                        <p class="font-size-sm text-white-75 mb-0">Zalo</p>
                                        <a class="btn btn-sm btn-light" href="<?= (new Settings)->info('spZalo'); ?>" target="_blank"> <i class="fas fa-phone-alt"></i> Tham gia</a>
                                    </a>
                                </div>
                            <?php } if ((new Settings)->info('spFb') != NULL) { ?>
                                <div class="col-md-6 col-xl-3 text-center">
                                    <a class="block block-rounded bg-gd-sublime text-center" href="<?= (new Settings)->info('spFb'); ?>" target="_blank">
                                        <div class="block-content block-content-full">
                                            <img class="img-avatar img-avatar-thumb img-avatar-rounded" src="/public/img/fb.png" alt="">
                                        </div>
                                        <div class="block-content block-content-full bg-black-10">
                                            <p class="font-w600 text-white mb-0">Fanpage - Facebook</p>
                                            <p class="font-size-sm font-italic text-white-75 mb-0"><?= (new Settings)->info('spFb'); ?></p>
                                        </div>
                                        <p class="font-size-sm text-white-75 mb-0">Facebook</p>
                                        <a class="btn btn-sm btn-light" href="<?= (new Settings)->info('spFb'); ?>" target="_blank"> <i class="far fa-hand-point-right"></i> Liên hệ</a>
                                    </a>
                                </div>
                            <?php } if ((new Settings)->info('spTele') != NULL) { ?>
                                <div class="col-md-6 col-xl-3 text-center">
                                    <a class="block block-rounded bg-gd-sublime text-center" href="<?= (new Settings)->info('spTele'); ?>" target="_blank">
                                        <div class="block-content block-content-full">
                                            <img class="img-avatar img-avatar-thumb img-avatar-rounded" src="/public/img/telegram-logo-15.png" alt="">
                                        </div>
                                        <div class="block-content block-content-full bg-black-10">
                                            <p class="font-w600 text-white mb-0">Telgram - Thông báo</p>
                                            <p class="font-size-sm font-italic text-white-75 mb-0">Nhận thông báo khi web up Via/Clone/BM</p>
                                        </div>
                                        <p class="font-size-sm text-white-75 mb-0">Telegram</p>
                                        <a class="btn btn-sm btn-light" href="<?= (new Settings)->info('spTele'); ?>" target="_blank"> <i class="far fa-hand-point-right"></i> Tham gia</a>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="content-heading">Chính sách bảo hành</h2>
        <div class="row row-deck">
            <div class="col-md-6">
                <div class="block block-rounded text-center">
                    <div class="block-content bg-gd-primary">
                        <p class="text-white text-uppercase font-size-sm font-w700">Bảo hành 24h</p>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <table class="table table-borderless table-hover">
                                <tbody>
                                    <tr>
                                        <td> <strong>BM bị cấm quảng cáo doanh nghiệp (ko thể tạo tài khoản quảng cáo)</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Link BM cần sử dụng ngay trong tối đa 10 ngày</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Clone vừa mua về đăng nhập đã bị checkpoint</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Via sai pass sau khi mua được đổi 1 : 1</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Mua via các bạn vui lòng sử dụng ID PASS 2FA để đăng nhập, không sử dụng cookie, HD đăng nhập: https://youtu.be/QWbugt4bP-M</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Lúc mua via về vui lòng đăng nhập tất cả tài khoản để kiểm tra pass, checkpoint. Tất cả nick sau 24h giao dịch không kiểm tra bên mình không chịu trách nhiệm</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Chỉ Bảo hành HCQC nếu có thông báo hạn chế trước ngày giao dịch, nếu thời gian bị hạn chế trung với ngày giao dịch thì không được bảo hành. Via bị HCQC hoặc die ADS không được tự tiện kháng.</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded text-center">
                    <div class="block-content bg-gd-fruit">
                        <p class="text-white text-uppercase font-size-sm font-w700">Từ chối bảo hành</p>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <table class="table table-borderless table-hover">
                                <tbody>
                                    <tr>
                                        <td> <strong>BM đã tạo tài khoản quảng cáo</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>BM đã thêm thông tin thanh toán (add thẻ)</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>BM xác minh bằng dịch vụ mail tạm thời (mail10m,...)</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Tài khoản bị checkpoint mất BM</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Tự ý đổi info Via</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Clone vừa mua về đăng nhập đã bị checkpoint nhưng đợi hôm sau mới báo.</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Phát hiện hàng lỗi nhưng tự xử lý</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Tự kháng Ads trước khi bảo hành</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Tự ý mở checkpoint via</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>