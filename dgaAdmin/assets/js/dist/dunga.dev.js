"use strict";

function wait(t, e, n) {
  return e ? $(t).prop("disabled", !1).html(n) : $(t).prop("disabled", !0).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>        Loading...');
}

function coppy(element) {
  window.getSelection().removeAllRanges();
  var range = document.createRange();
  range.selectNode(typeof element === "string" ? document.getElementById(element) : element);
  window.getSelection().addRange(range);
  document.execCommand("copy");
  window.getSelection().removeAllRanges();
  swal("Sao chép thành công", "success");
}

function formatNumber(nStr) {
  var decSeperate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : ".";
  var groupSeperate = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : ",";
  nStr += "";
  x = nStr.split(decSeperate);
  x1 = x[0];
  x2 = x.length > 1 ? "." + x[1] : "";
  var rgx = /(\d+)(\d{3})/;

  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, "$1" + groupSeperate + "$2");
  }

  return x1 + x2;
}

function swal(msg, icon) {
  Swal.fire({
    icon: icon,
    title: "Thông báo",
    text: msg,
    confirmButtonText: "Tôi đã hiểu!"
  });
}

function isURL(str) {
  var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
  var pattern = new RegExp(regex);
  return pattern.test(str);
}

function copyElementToClipboard(element) {
  window.getSelection().removeAllRanges();
  var range = document.createRange();
  range.selectNode(typeof element === "string" ? document.getElementById(element) : element);
  window.getSelection().addRange(range);
  document.execCommand("copy");
  window.getSelection().removeAllRanges();
  swal("Sao chép thành công", "success");
}

$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });
  var pathMenu = window.location.href;
  $("ul#sidebar a").each(function () {
    if (this.href === getPathFromUrl(pathMenu)) {
      $(this).addClass("active");
      $(this).parent().closest("li").addClass("active");
      var subMenu = $(this).parent().closest("ul");

      if (subMenu) {
        subMenu.show();
        $(this).parent().parent().closest("li").addClass("active");
      }
    }
  });
  var channel = pusher.subscribe("notification");

  if (typeof profile !== "undefined") {
    channel.bind("user-".concat(profile.id), function (payload) {
      // toastr[`${payload.status}`](`${payload.message}`,'Thông báo');
      swal("".concat(payload.message), "".concat(payload.status));
    });
  }

  $('[data-toggle="tooltip"]').tooltip();
  $("form[submit-ajax=dga]").submit(function (e) {
    e.preventDefault();

    var _this = this;

    var url = $(_this).attr("action");
    var method = $(_this).attr("method");
    var href = $(_this).attr("href");
    var data = $(_this).serialize();
    var button = $(_this).find("button[type=submit]");
    submitForm(url, method, href, data, button);
    swal('DUNGA');
  });
});

function getPathFromUrl(url) {
  return url.split("?")[0];
}

function submitForm(url, method, href, data, button) {
  var textButton = button.html().trim();
  var setting = {
    type: method,
    url: url,
    data: data,
    dataType: "JSON",
    beforeSend: function beforeSend() {
      button.prop("disabled", !0).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...');
    },
    complete: function complete() {
      button.prop("disabled", !1).html(textButton);
    },
    success: function success(response) {
      if (response.status === true && !button.attr("href")) {
        setTimeout(function () {
          if (!href) {
            window.location.reload();
            return;
          }

          window.location.href = href;
        }, 2000);
      }

      if (response.status === true) {
        toastr.success(response.message, "Thông báo");
      } else {
        toastr.error(response.message, "Thông báo");
      }
    },
    error: function error(_error) {
      console.log(_error);
    }
  };
  $.ajax(setting);
}