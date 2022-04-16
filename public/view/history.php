<main id="main-container">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="block block-rounded block-themed block-fx-pop">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Lịch sử nạp tiền</h3>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-hover table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="d-sm-table-cell" style="width: 15%;">Thời gian</th>
                                        <th class="d-sm-table-cell text-center" style="width: 20%;">Mã giao dịch</th>
                                        <th class="d-sm-table-cell text-center" style="width: 20%;">Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ((new Controller())->get_list("SELECT * FROM `dga_bank` WHERE `username` = '" . $user->info('username') . "' ") as $row) { ?>
                                        <tr>
                                            <th><?= $row['created_at']; ?></th>
                                            <th class="d-sm-table-cell text-center"><?= $row['tranId']; ?></th>
                                            <th class="d-sm-table-cell text-center"><?= number_format($row['amount']); ?></th>
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