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

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
              FILE ĐÃ MUA WEB SẼ CHỈ LƯU TỐI ĐA 2 THÁNG, TRÁNH HACKER CHIẾM ĐOẠT DỮ LIỆU, QUÝ KHÁCH VUI LÒNG TỰ LƯU DỮ LIỆU SAU KHI MUA
              </span>
              <br><span class="text-danger font-size-lg">THÔNG BÁO HỆ THỐNG: NẠP TIỀN AUTO ĐANG LỖI, VUI LÒNG LIÊN HỆ ADMIN SAU KHI CHUYỂN KHOẢN.</span>
            </div>

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
              Nếu cần yêu cầu check nạp tiền và bảo hành <a class="link-fx" href="support.php" target="_blank">--&gt; Tham gia nhóm Zalo hỗ trợ &lt;--</a>
              <br>Nhận thông báo mỗi khi Web có nguyên liệu bạn cần <a class="link-fx" href="support.php" target="_blank">--&gt; Tham gia nhóm Telegram &lt;--</a>
            </div>

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
              Chỉ Bảo hành HCQC nếu có thông báo hạn chế trước ngày giao dịch, quý khách không được tự ý kháng TK die, nếu không sẽ từ chối bảo hành.
              <br> <span class="text-danger font-size-lg">QUÝ KHÁCH VUI LÒNG ĐỔI LUÔN PASS EMAIL SAU KHI MUA VIA TRÁNH HACKER VIA LẠI BẰNG EMAIL DO WEB BÁN MAIL BỊ LỘ.</span>
              <br><span class="text-danger font-size-lg"> Đọc kỹ <a href="support.php" class="link-fx text-danger">CHÍNH SÁCH BẢO HÀNH</a> trước khi mua.</span>
            </div>

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
              <span class="text-danger font-size-lg">KHUYẾN MÃI 5% KHI NẠP MIN 2M, KHUYẾN MÃI 10% KHI NẠP MIN 5M </span>
              <br><span> CHỈ NẠP VỪA ĐỦ SỐ TIỀN CẦN MUA. CHÚNG TÔI SẼ KHÔNG HOÀN TIỀN TỪ USER CỦA BẠN VÌ BẤT KÌ LÝ DO GÌ! CẢM ƠN QUÝ KHÁCH ĐÃ CHỌN BMVIA </span>
            </div>
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

                          <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;"><strong><?= number_format((new Controller)->num_rows(" SELECT * FROM `dga_account` WHERE `product` = '" . $rows['token'] . "' AND `code` IS NULL AND `status` = '1'")); ?></strong></div>

                          <span class="text-truncate ml-2">

                            <span class="font-w700" id="<?= strtolower($row['name']); ?>_name_<?= $rows['id']; ?>"><?= $rows['name']; ?></span>

                            <span class="d-block font-size-sm text-muted"><?= $rows['details']; ?></span>

                            <i style="position:absolute;right:5px;bottom:10px;" class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?= $rows['details']; ?>"></i>

                            <span class="d-block font-size-sm text-muted"><i class="font-w400" style="font-size: 0.77rem;"><del>0 VNĐ</del></i><strong class="text-danger"> » <span id="<?= strtolower($row['name']); ?>_price_<?= $rows['id']; ?>"><?= number_format($rows['price']); ?><span> VNĐ</strong></span>

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


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***61</font> đã nạp số tiền + <font color="red"><em>1,100,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="15:52:06 - 03/04/2022"><em>

                    3 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***12</font> đã nạp số tiền + <font color="red"><em>100,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="15:08:06 - 03/04/2022"><em>

                    4 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***69</font> đã nạp số tiền + <font color="red"><em>50,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="14:48:05 - 03/04/2022"><em>

                    4 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***07</font> đã nạp số tiền + <font color="red"><em>200,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="14:16:05 - 03/04/2022"><em>

                    5 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***12</font> đã nạp số tiền + <font color="red"><em>50,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="14:16:04 - 03/04/2022"><em>

                    5 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***90</font> đã nạp số tiền + <font color="red"><em>50,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="13:20:04 - 03/04/2022"><em>

                    6 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***0</font> đã nạp số tiền + <font color="red"><em>100,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="11:22:04 - 03/04/2022"><em>

                    7 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***90</font> đã nạp số tiền + <font color="red"><em>50,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="11:04:04 - 03/04/2022"><em>

                    8 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***30</font> đã nạp số tiền + <font color="red"><em>280,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="07:36:05 - 03/04/2022"><em>

                    11 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><img src="img/new.gif" height="18"> id***12</font> đã nạp số tiền + <font color="red"><em>50,000 VNĐ</em></font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="06:36:07 - 03/04/2022"><em>

                    12 giờ trước</em></span></span></div>

            <!-- /loop -->


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


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> la***oy</font>: <font color="red">Mua 10 Via VN New 50-1K Friend 2FA - tổng 180,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="17:15:00 - 03/04/2022"><em>

                    2 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> Le***son</font>: <font color="red">Mua 2 Via VN New 50-1K Friend 2FA - tổng 36,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="15:56:31 - 03/04/2022"><em>

                    3 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> do***hu93</font>: <font color="red">Mua 60 Via VN New 50-1K Friend 2FA - tổng 1,080,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="15:52:13 - 03/04/2022"><em>

                    3 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> Le***son</font>: <font color="red">Mua 1 Via VN Cổ 50-1K Friend 2FA - tổng 28,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="15:12:59 - 03/04/2022"><em>

                    4 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> vi***nh123</font>: <font color="red">Mua 1 Via VN Cổ 50-1K Friend 2FA - tổng 28,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="14:18:48 - 03/04/2022"><em>

                    5 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> da***at260915</font>: <font color="red">Mua 4 Via VN Cổ 50-1K Friend 2FA - tổng 112,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="14:18:05 - 03/04/2022"><em>

                    5 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> py***nguyen</font>: <font color="red">Mua 25 Clone VN 2FA vr mail - tổng 50,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="13:30:47 - 03/04/2022"><em>

                    5 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> py***nguyen</font>: <font color="red">Mua 25 Clone VN 2FA vr mail - tổng 50,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="12:31:22 - 03/04/2022"><em>

                    6 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> vn***eytalk</font>: <font color="red">Mua 6 Via VN New 50-1K Friend 2FA - tổng 108,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="11:23:19 - 03/04/2022"><em>

                    7 giờ trước</em></span></span></div>

            <!-- /loop -->


            <!-- loop -->

            <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right"><b>

                <font color="green"><i class="fa fa-bell"></i> la***oy</font>: <font color="red">Mua 10 Via VN New 50-1K Friend 2FA - tổng 180,000 VNĐ</font>

              </b><span style="float: right;"><span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="10:49:06 - 03/04/2022"><em>

                    8 giờ trước</em></span></span></div>

            <!-- /loop -->


          </div>

        </div>

      </div>

    </div>

  </div>

</main>