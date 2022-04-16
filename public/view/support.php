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
                        <?=(new Settings)->info('insurance');?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded text-center">
                    <div class="block-content bg-gd-fruit">
                        <p class="text-white text-uppercase font-size-sm font-w700">Từ chối bảo hành</p>
                    </div>
                    <div class="block-content block-content-full">
                        <?=(new Settings)->info('no_insurance');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>