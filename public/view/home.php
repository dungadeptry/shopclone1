<main id="main-container">

  <div class="content">

    <div class="row">

      <div class="col-12">

        <div class="block block-rounded block-bordered">

          <div class="block-header block-header-defaul">

            <h4 class="block-title">Thông Báo</h4>

            <div class="block-options">

              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i>

              </button>

            </div>

          </div>

          <div class="block-content">

            <?= (new Settings)->info('notification'); ?>
          </div>

        </div>

      </div>

    </div>


    <!-- loop -->

    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` IS NOT NULL ORDER BY `arrange` ASC") as $row) { ?>
      <div class="row justify-content-center" id="mua-<?= strtolower($row['name']); ?>">

        <div class="col-12">

          <div class="block block-rounded block-themed block-fx-pop">

            <div class="block-header bg-gd-sea">

              <h3 class="block-title">Danh sách <?= $row['name']; ?></h3>

              <div class="block-options">

                <a class="btn btn-block-option" href="/index.php?act=orders&t=<?= strtolower($row['name']); ?>"> <i class="si si-settings"></i> <?= $row['name']; ?> của tôi</a>

              </div>

            </div>

            <div class="block-content">

              <div class="row">

                <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_product` WHERE `category` = '" . $row['token'] . "' ORDER BY `arrange` ASC") as $rows) { ?>
                  <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-1">

                    <div class="custom-control custom-block custom-control-primary">

                      <input type="checkbox" class="custom-control-input" id="<?= strtolower($row['name']); ?>_type_<?= $rows['id']; ?>" name="type" value="<?= $rows['id']; ?>">

                      <label class="custom-control-label p-2" for="<?= strtolower($row['name']); ?>_type_<?= $rows['id']; ?>">

                        <span class="d-flex align-items-center">

                          <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;">
                            <strong><?= number_format((new Controller)->num_rows(" SELECT * FROM `dga_account` WHERE `product` = '" . $rows['token'] . "' AND `code` IS NULL AND `status` = '1'")); ?></strong>
                          </div>

                          <span class="text-truncate ml-2">

                            <span class="font-w700" id="<?= strtolower($row['name']); ?>_name_<?= $rows['id']; ?>"><?= $rows['name']; ?></span>

                            <span class="d-block font-size-sm text-muted"><?= $rows['details']; ?></span>

                            <i style="position:absolute;right:5px;bottom:10px;" class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?= $rows['details']; ?>"></i>

                            <span class="d-block font-size-sm text-muted"><i class="font-w400" style="font-size: 0.77rem;"><del>0 VNĐ</del></i><strong class="text-danger"> » <span id="<?= strtolower($row['name']); ?>_price_<?= $rows['id']; ?>"><?= number_format($rows['price']); ?><span>
                                    VNĐ</strong></span>

                          </span>

                        </span>

                      </label>

                      <span class="custom-block-indicator">

                        <i class="fa fa-check"></i>

                      </span>

                    </div>

                  </div>
                <?php } ?>

              </div>

              <div style="border-bottom: 1px solid #e6ebf4;margin:1.1rem 0 1.75rem 0;"></div>

              <div class="row">

                <div class="col-md-12 mb-3">

                  <button class="d-inline-block btn btn-hero-sm btn-hero-info" onclick="buy('<?= strtolower($row['name']); ?>');">Mua <?= $row['name']; ?></button>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>
    <?php } ?>

    <div class="row">

      <div class="col-xl-6 col-xs-12">

        <div class="block block-rounded block-themed block-fx-pop">

          <div class="block-header bg-gd-sea">

            <h3 class="block-title">Lịch Sử Nạp Tiền</h3>

            <div class="block-options">

              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i>

              </button>

            </div>

          </div>

          <div class="block-content">


            <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_bank` ORDER BY `id` DESC LIMIT 10") as $row) { ?>
              <!-- loop -->

              <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
                <b>

                  <font color="green"><img src="/public/img/new.gif" height="18"> <?= substr($row['username'], 0, 4); ?>****</font> đã nạp số tiền +
                  <font color="red"><em><?= number_format($row['amount']); ?> VNĐ</em></font>

                </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="15:52:06 - 03/04/2022"><em>

                      <?= (new Func)->timeAgo(strtotime($row['created_at'])); ?></em></span></span>
              </div>

            <?php } ?>


          </div>

        </div>

      </div>

      <div class="col-xl-6 col-xs-12">

        <div class="block block-rounded block-themed block-fx-pop">

          <div class="block-header bg-gd-sea">

            <h3 class="block-title">Lịch Sử Thanh Toán</h3>

            <div class="block-options">

              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i>

              </button>

            </div>

          </div>

          <div class="block-content">


            <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_orders` ORDER BY `id` DESC LIMIT 10") as $row) { ?>

              <!-- loop -->

              <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
                <b>

                  <font color="green"><i class="fa fa-bell"></i> <?= substr($row['username'], 0, 4); ?>****</font>: <font color="red">Mua <?= number_format($row['amount']); ?>
                    <?= (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `token` = '" . $row['product'] . "' ")['name']; ?> - tổng <?= number_format($row['price']); ?> VNĐ</font>

                </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="17:15:00 - 03/04/2022"><em>

                      <?= (new Func)->timeAgo(strtotime($row['created_at'])); ?></em></span></span>
              </div>

              <!-- /loop -->

            <?php } ?>


          </div>

        </div>

      </div>

    </div>

  </div>

</main>