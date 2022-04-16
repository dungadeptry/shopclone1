<script src="/public/assets/js/dashmix.app.js?v=<?= (new Settings)->info('version'); ?>"></script>
<!-- <script src="/public/assets/js/dashmix.core.min.js?v=<?= (new Settings)->info('version'); ?>"></script> -->
<!-- <script src="/public/assets/js/dashmix.app.min.js?v=<?= (new Settings)->info('version'); ?>"></script> -->
<!-- <script src="/public/assets/js/plugins/sweetalert2/sweetalert2.min.js?v=<?= (new Settings)->info('version'); ?>"></script> -->
<script src="/public/assets/js/dunga.js?v=<?= (new Settings)->info('version'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    function buy(t) {

        var type = $('input[name=type]:checked').val();
        if (!type) {
            swal('Vui lòng chọn gói', 'error');
            return false;
        }

        var price = jQuery('[id^="' + t + '_price_' + type + '"]').text();
        var product = jQuery('[id^="' + t + '_name_' + type + '"]').text();


        Swal.fire({
            title: product,
            html: '<div id="swal2-content" class="swal2-html-container" style="display: block;">Nhập số lượng muốn mua:</div><input value="1" class="swal2-input" id="amount" placeholder="" type="number" oninput="updatePrice(\'' +
                price + '\');"></div>',
            showCancelButton: true,
            confirmButtonText: 'Mua',
            cancelButtonText: 'Bỏ qua',
            footer: '<span style="color: red;">Tổng tiền:&nbsp;&nbsp;&nbsp;<span class="font-weight-bold" id="totalPrice">' +
                formatNumber(price) + '</span></span>',
        }).then((result) => {
            if (result.value) {
                var amount = $('#amount').val();
                Swal.fire({
                    title: 'ĐANG XỬ LÝ',
                    text: 'Hệ thống đang thực hiện check live tài khoản',
                    imageUrl: 'https://img.pikbest.com/png-images/20190918/cartoon-snail-loading-loading-gif-animation_2734139.png!bw340',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $.ajax({
                    url: "/modun/buyv2/post",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        type: type,
                        amount: amount,
                    },
                    success: function(data) {
                        if (data.status === "error") {
                            swal(data.message, "error");
                        } else {
                            swal(data.message, "success");
                            setTimeout(function() {
                                location.href = 'download.php?id=' + data.code
                            }, 2000)
                        }
                    }
                });
            }
        });

    }

    toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>