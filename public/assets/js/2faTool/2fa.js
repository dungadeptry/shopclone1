! function(e) {
    var t = {};

    function n(r) {
        if (t[r]) return t[r].exports;
        var o = t[r] = {
            i: r,
            l: !1,
            exports: {}
        };
        return e[r].call(o.exports, o, o.exports, n), o.l = !0, o.exports
    }
    n.m = e, n.c = t, n.d = function(e, t, r) {
        n.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: r
        })
    }, n.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, n.t = function(e, t) {
        if (1 & t && (e = n(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var r = Object.create(null);
        if (n.r(r), Object.defineProperty(r, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var o in e) n.d(r, o, function(t) {
                return e[t]
            }.bind(null, o));
        return r
    }, n.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return n.d(t, "a", t), t
    }, n.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, n.p = "/", n(n.s = 715)
}({
    715: function(e, t, n) {
        e.exports = n(716)
    },
    716: function(e, t) {
        $(document).ready((function() {
            var e = function() {
                var e = $("#secret").val();
                if (e) try {
                    var t = window.otplib.authenticator.generate(e);
                    if (!t) throw "Invalid token";
                    $("#code").val(t)
                } catch (e) {
                    $("#code").val("Sai mật mã")
                }
            };
            setInterval((function() {
                var t = window.otplib.authenticator.timeRemaining();
                $("#time-remaining").text(t + "s"), t <= 5 ? $("#time-remaining").addClass("text-danger") : $("#time-remaining").removeClass("text-danger"), 0 === window.otplib.authenticator.timeUsed() && t === window.otplib.authenticator.allOptions().step && e()
            }), 1e3), $("#secret").change((function(t) {
                var n = $("#secret").val().replace(/ /g, ""),
                    r = /[A-Z0-9]{32}/.exec(n);
                n = r ? r[0] : "", $("#secret").val(n), e();
                var o = window.otplib.authenticator.keyuri("2FA TOOL", "NGTIENDUNGG.COM", $("#secret").val());
                $("#qr-code").attr("src", "https://chart.googleapis.com/chart?chs=166x166&chld=L|0&cht=qr&chl=" + encodeURI(o)).show()
            }))
        }))
    }
});