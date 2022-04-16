<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-12">
        <div class="block block-rounded block-themed block-fx-pop">
          <div class="block-header bg-gd-sea">
            <h3 class="block-title">Nạp tiền Qua Ví Điện Tử - Ngân Hàng</h3>
          </div>
          <div class="block-content">
            <div class="row">
              <div class="col-md-12 mb-3">
                <h5 class="text-primary">Tỷ giá: 1 VNĐ = 1 coin</h5>
              </div>
              <div class="col-md-12">
                <div class="alert text-white bg-danger  mb-3" role="alert"><?=(new Settings)->info('noteRecharge');?></div>
              </div>
              <div class="col-md-12">
                <div class="alert text-white bg-warning  mb-3" role="alert"><center>Nạp tối thiểu <?=number_format((new Settings)->info('min_recharge'));?> VNĐ</center></div>
              </div>
              <div class="mb-3 col-sm-6">
                <h5 class="text-info text-center"><img src="https://static.mservice.io/img/logo-momo.png" height="100px">
                </h5>
                <div class="alert alert-warning text-danger font-size-lg">
                  <div class="row mb-1">
                    <div class="col-6 text-right">Tên tài khoản:</div>
                    <div class="col-6 text-primary-dark"><?=(new Settings)->info('ctk_momo');?></div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-6 text-right">Số điện thoại:</div>
                    <div class="col-6 text-primary-dark"><?=(new Settings)->info('stk_momo');?> <a href="javascript:;" class="btn-copy" data-toggle="tooltip" data-placement="top" title="Copy" data-clipboard-text="<?=(new Settings)->info('stk_momo');?>"><i class="fa fa-copy"></i></i></a></div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-6 text-right">Ví điện tử:</div>
                    <div class="col-6 text-primary-dark">Momo</div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-6 text-right">Nội dung bắt buộc:</div>
                    <div class="col-6 text-primary-dark font-weight-bold"><span class="text-danger" style="border: 2px dashed #e04f1a30; padding: 3px; color: #e53e3e!important;"><?=(new Settings)->info('ndRecharge').$user->info('id');?></span> <a href="javascript:;" class="btn-copy" data-toggle="tooltip" data-placement="top" title="Copy" data-clipboard-text="<?=(new Settings)->info('ndRecharge').$user->info('id');?>"><i class="fa fa-copy"></i></i></a></div>
                  </div>
                </div>
              </div>
              <div class="mb-3 col-sm-6">
                <h5 class="text-info text-center"><img src="<?=(new Func)->imgBank((new Settings)->info('typeBank'));?>" height="100px">
                </h5>
                <div class="alert alert-warning text-danger font-size-lg">
                  <div class="row mb-1">
                    <div class="col-6 text-right">Tên tài khoản:</div>
                    <div class="col-6 text-primary-dark"><?=(new Settings)->info('ctk_atm');?></div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-6 text-right">Số tài khoản:</div>
                    <div class="col-6 text-primary-dark"><?=(new Settings)->info('stk_atm');?> <a href="javascript:;" class="btn-copy" data-toggle="tooltip" data-placement="top" title="Copy" data-clipboard-text="<?=(new Settings)->info('stk_atm');?>"><i class="fa fa-copy"></i></i></a></div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-6 text-right">Ngân hàng:</div>
                    <div class="col-6 text-primary-dark"><?=(new Settings)->info('typeBank');?></div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-6 text-right">Nội dung bắt buộc:</div>
                    <div class="col-6 text-primary-dark font-weight-bold"><span class="text-danger" style="border: 2px dashed #e04f1a30; padding: 3px; color: #e53e3e!important;"><?=(new Settings)->info('ndRecharge').$user->info('id');?></span> <a href="javascript:;" class="btn-copy" data-toggle="tooltip" data-placement="top" title="Copy" data-clipboard-text="<?=(new Settings)->info('ndRecharge').$user->info('id');?>"><i class="fa fa-copy"></i></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>