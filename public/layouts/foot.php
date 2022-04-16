<footer id="page-footer" class="bg-body-light">
  <div class="content py-0">
    <div class="row font-size-sm">
      <div class="col-sm-6 order-sm-1 text-center text-sm-left"><a class="font-w600" href="#" target="_blank"><?=(new Settings)->info('name');?></a> &copy; <span data-toggle="year-copy">2022</span>

      </div>
    </div>
  </div>
</footer>
<div id="onlineDonate"></div>
</div>
<!-- modal -->
<div class="modal fade" id="modal-thongbao" tabindex="-1" role="dialog" aria-labelledby="modal-thongbao" aria-hidden="true" style="display: none">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông Báo Từ Hệ Thống</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-1 font-size-lg">
        <b>- Hệ thống <font color="red">Nạp Tiền Auto VCB</font>
          <br>
          <font color="red">- NEW - Tạo Mã 2FA</font>
        </b><br>
        <font color="red">- NEW - Chức Năng Đại Lý Quan Tâm Có Thể Liên hệ Admin</font>
        </b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="setCookie('modal_thongbao', '1', '1');">Không hiển thị lại</button>
        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<!-- /modal -->
<div class="modal fade" id="modal-pack-list" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark">
          <h3 class="block-title">Danh Sách Link</h3>
          <div class="block-options"></div>
        </div>
        <div class="block-content">
          <div class="table-responsive">
            <table id="bm-table-pack" class="table table-hover table-bordered table-vcenter">
              <thead>
                <tr>
                  <th class="d-sm-table-cell text-center" style="width: 5%;"></th>
                  <th>Link</th>
                  <th class="d-sm-table-cell text-center" style="width: 15%;">BMID</th>
                  <th class="d-sm-table-cell text-center" style="width: 5%;">Live</th>
                  <th class="d-sm-table-cell text-center" style="width: 180px;">Ngày mua</th>
                  <th class="d-sm-table-cell text-center" style="width: 20%;">Giá</th>
                  <th class="d-sm-table-cell text-center">Người bán</th>
                  <th class="d-sm-table-cell text-center pr-6 pl-5" style="width: 150px;"><i class="far fa-question-circle"></i>
                  </th>
                </tr>
              </thead>
              <tbody class="bm-list-data" id="bm-list-data">
              </tbody>
            </table>
          </div>
        </div>
        <div class="block-content block-content-full text-right bg-light">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Download
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item download-asTXT" href="javascript:;" onclick="bm_list_txt();">TXT (.txt)</a>
          </div>
          <button type="button" class="btn btn-primary download-inline" onclick="bm_list_copy();">Copy</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</div>