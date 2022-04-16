<main id="main-container">

    <div class="content">

        <div class="row justify-content-center">

            <div class="col-12">

                <div class="block block-rounded block-themed block-fx-pop">

                    <div class="block-header bg-info">

                        <h3 class="block-title">Check Live Clone/Via UID</h3>

                    </div>

                    <div class="block-content">

                        <div class="table-responsive">

                            <div class="form-group">

                                <label for="textarea" class="control-label">Nhập List ID</label>

                                <textarea class="form-control" id="listclone" rows="6" placeholder="Mỗi Dòng 1 ID" onkeyup="countTotal();"></textarea>

                            </div>

                            <div class="form-group">

                                <span class="nav-main-link-badge badge badge-pill badge-primary">Tổng: <b id="total">0</b></span>

                                <span class="nav-main-link-badge badge badge-pill badge-success">Live: <b id="live">0</b></span>

                                <span class="nav-main-link-badge badge badge-pill badge-danger">Die: <b id="die">0</b></span>

                            </div>

                            <div class="clearfix">

                                <div class="form-group text-center">

                                    <button class="d-inline-block btn btn-hero-sm btn-hero-info" onclick="check_live_uid();">CHECK LIVE UID</button>

                                </div>

                            </div>


                            <div class="form-group">
                                <label for="textarea" class="control-label">Clone/Via UID LIVE</label>
                                <textarea onclick="coppy('listclonelive')" class="form-control" id="listclonelive" rows="6" placeholder="Kết quả sẽ xuất hiện ở đây"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="textarea" class="control-label">Clone/Via UID DIE</label>
                                <textarea onclick="coppy('listclonedie')" class="form-control" id="listclonedie" rows="6" placeholder="Kết quả sẽ xuất hiện ở đây"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<script>
    var listclone, arrclone, n, c;
    var live, die;

    function check_live_uid() {
        $('#checkliveuid').prop('disabled', true);
        $('#listclonelive').val("");
        $('#listclonedie').val("");
        $('#live').html(0);
        $('#die').html(0);
        $('.progress').show();
        n = 0;
        live = 0;
        die = 0;
        listclone = $('#listclone').val().trim();
        arrclone = listclone.split('\n');
        c = arrclone.length;
        for (var i = 0; i < 20; i++) {
            check_live_uid_progress();
        }
    }

    function countTotal() {
        var list = $("#listclone").val().trim().split("\n");
        $("#total").text(list.length);
    }

    function check_live_uid_progress() {
        n = n + 1;
        var m = n - 1;
        var uid = get_uid(arrclone[m]);
        var url = 'https://graph.facebook.com/' + uid + '/picture?type=normal';
        fetch(url).then((response) => {
            if (/100x100/.test(response.url)) {
                $('.live').show();
                live++;
                $('#live').html(live);
                $('#listclonelive').val($('#listclonelive').val() + uid + '\n');
            } else {
                $('.die').show();
                die++;
                $('#die').html(die);
                $('#listclonedie').val($('#listclonedie').val() + uid + '\n');
            }
            var r = $(".progress-bar");
            var t = Math.floor(n * 100 / c);
            r.css("width", t + "%"), jQuery("span", r).html(t + "%");
            if (n < c) {
                check_live_uid_progress();
            } else {
                $('#checkliveuid').prop('disabled', false);
                return false;
            }
        });


    }

    function get_uid(data) {
        var clone = data.split("|");
        return clone[0];
    }
</script>