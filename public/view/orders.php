<?php if (isset($_GET['t'])) { ?>
    <?php
    $category = (new Controller)->get_row("SELECT * FROM `dga_category` WHERE `name` = '" . strtoupper($_GET['t']) . "' AND `category` IS NOT NULL  ");
    if (isset($_GET['type'])) {
        $product = (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `id` = '" . (new Func)->xss($_GET['type']) . "' ");
    }
    ?>
    <main id="main-container">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="block block-rounded block-themed block-fx-pop">
                        <div class="block-header bg-gd-dusk">
                            <h3 class="block-title">Lọc <?= $category['name']; ?> đã mua</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_product` WHERE `category` = '" . $category['token'] . "' ") as $row) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-1">
                                        <div class="custom-control custom-block custom-control-primary">
                                            <input onchange="load('<?= strtolower($category['name']); ?>', this);" type="checkbox" class="custom-control-input" id="<?= strtolower($category['name']); ?>_type_<?= $row['id']; ?>" name="type" value="<?= $row['id']; ?>">
                                            <label class="custom-control-label p-2" for="<?= strtolower($category['name']); ?>_type_<?= $row['id']; ?>">
                                                <span class="d-flex align-items-center">
                                                    <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;"><strong><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_orders` WHERE `product` = '" . $row['token'] . "' AND `status` = '2' OR `status` = '1' ")); ?> bộ</strong></div>
                                                    <span class="text-truncate ml-2">
                                                        <span class="font-w700"><?= $row['name']; ?></span>
                                                        <span class="d-block font-size-sm text-muted"><?= $row['details']; ?></span>
                                                        <i style="position:absolute;right:5px;bottom:10px;" class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?= $row['details']; ?>"></i>
                                                        <span class="d-block font-size-sm text-muted"><strong class="text-danger"><?= number_format($row['price']); ?> VNĐ</strong></span>
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
                            <div class="table-responsive">
                                <table id="bm-table" class="table table-hover table-bordered table-vcenter">
                                    <thead>
                                        <tr>
                                            <th style="width: 90px;">#</th>
                                            <th>Loại BM</th>
                                            <th class="d-sm-table-cell text-center">Số lượng</th>
                                            <th class="d-sm-table-cell text-center">Giá</th>
                                            <th class="d-sm-table-cell text-center">Ngày mua</th>
                                            <th class="d-sm-table-cell text-center">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ((new Controller())->get_list("SELECT * FROM `dga_orders` WHERE `username` = '" . $user->info('username') . "' AND `product` = '" . $product['token'] . "' AND `status` = '2' OR `status` = '1' ") as $row) { ?>
                                            <tr>
                                                <th style="width: 90px;"><?= $row['id']; ?></th>
                                                <th><?= $product['name']; ?></th>
                                                <th class="d-sm-table-cell text-center"><?= number_format($row['amount']); ?></th>
                                                <th class="d-sm-table-cell text-center"><?= number_format($row['price']); ?></th>
                                                <th class="d-sm-table-cell text-center"><?= $row['created_at']; ?></th>
                                                <th class="d-sm-table-cell text-center"><a href="javascript:viewOrder('<?= $row['id']; ?>');">Xem đơn hàng</a></th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div style="display: table; margin:0 auto;">
                                <nav>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function load(t, el) {
            location.href = 'index.php?act=orders&t=' + encodeURIComponent(t) + (el.checked ? '&type=' + encodeURIComponent(el.value) : '')
        }

        function viewOrder(id) {
            fetch('view-order.php?t=<?= strtolower($category['name']); ?>&id=' + id).then(r => r.text()).then(t => {
                jQuery('#xdownload').attr('href', 'dl.php?o=' + id)
                jQuery('#modal-pack-list').modal('show').find('[data-xcontent]').html(t)
            }).catch(e => console.error(e))
        }
    </script>

    <div class="modal fade" id="modal-pack-list" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Chi tiết đơn hàng</h3>
                        <div class="block-options"></div>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive" data-xcontent>

                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <a href="javascript:;" id="xdownload"><button type="button" class="btn btn-primary">Tải xuống</button></a>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>