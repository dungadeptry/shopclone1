function swal(msg, icon) {
    Swal.fire({
        icon: icon,
        title: 'Thông báo',
        text: msg,
        confirmButtonText: 'OK, tôi đã hiểu!'
    })
}

function formatNumber(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function updatePrice(_price) {
    var amount = $('#amount').val();
    var price = _price.replaceAll(',', '');
    var price = price.replaceAll('VNĐ', '');
    var total = amount * price;
    $('#totalPrice').text(formatNumber(total) + ' VND');
}