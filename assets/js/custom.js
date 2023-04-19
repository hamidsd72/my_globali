(() => {
    function e(t) {
        return (e = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
            return typeof e
        } : function (e) {
            return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        })(t)
    }

    $('.select_prefix').on('change', function () {
        var prefix = $(this).find(':selected').attr('data-prefix')
        $('.prefix_span').text(prefix + '_')
        var w_prefix = $('.prefix_span').outerWidth();
        $('.prefix_input').css('padding-left', w_prefix + 'px')
    })

    !function (t) {
        "use strict";
        t(window).on("load", (function (e) {
            t("#global-loader").fadeOut("slow")
        })), t(document).on("click", ".fullscreen-button", (function () {
            t("html").addClass("fullscreen-content"), void 0 !== document.fullScreenElement && null === document.fullScreenElement || void 0 !== document.msFullscreenElement && null === document.msFullscreenElement || void 0 !== document.mozFullScreen && !document.mozFullScreen || void 0 !== document.webkitIsFullScreen && !document.webkitIsFullScreen ? document.documentElement.requestFullScreen ? document.documentElement.requestFullScreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullScreen ? document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT) : document.documentElement.msRequestFullscreen && document.documentElement.msRequestFullscreen() : (t("html").removeClass("fullscreen-content"), document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen ? document.webkitCancelFullScreen() : document.msExitFullscreen && document.msExitFullscreen())
        })), t(".cover-image").each((function () {
            var o = t(this).attr("data-image-src");
            "undefined" !== e(o) && !1 !== o && t(this).css("background", "url(" + o + ") center center")
        })), t(document).ready((function () {
            t("a[data-theme]").on("click", (function () {
                t("head link#theme").attr("href", t(this).data("theme")), t(this).toggleClass("active").siblings().removeClass("active")
            })), t("a[data-effect]").on("click", (function () {
                t("head link#effect").attr("href", t(this).data("effect")), t(this).toggleClass("active").siblings().removeClass("active")
            }))
        })), t('[data-toggle="tooltip"]').tooltip(), t('[data-toggle="tooltip-primary"]').tooltip({template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}), t('[data-toggle="tooltip-secondary"]').tooltip({template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}), t('[data-toggle="popover"]').popover(), t('[data-popover-color="head-primary"]').popover({template: '<div class="popover popover-head-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}), t('[data-popover-color="head-secondary"]').popover({template: '<div class="popover popover-head-secondary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}), t('[data-popover-color="primary"]').popover({template: '<div class="popover popover-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}), t('[data-popover-color="secondary"]').popover({template: '<div class="popover popover-secondary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}), t(document).on("click", (function (e) {
            t('[data-toggle="popover"],[data-original-title]').each((function () {
                t(this).is(e.target) || 0 !== t(this).has(e.target).length || 0 !== t(".popover").has(e.target).length || (((t(this).popover("hide").data("bs.popover") || {}).inState || {}).click = !1)
            }))
        })), t(".modal-effect").on("click", (function (e) {
            e.preventDefault();
            var o = t(this).attr("data-effect");
            t("#modaldemo8").addClass(o)
        })), t("#modaldemo8").on("hidden.bs.modal", (function (e) {
            t(this).removeClass((function (e, t) {
                return (t.match(/(^|\s)effect-\S+/g) || []).join(" ")
            }))
        })), t(window).on("scroll", (function (e) {
            t(this).scrollTop() > 0 ? t("#back-to-top").fadeIn("slow") : t("#back-to-top").fadeOut("slow")
        })), t("#back-to-top").on("click", (function (e) {
            return t("html, body").animate({scrollTop: 0}, 600), !1
        })), t(".chart-circle").length && t(".chart-circle").each((function () {
            var e = t(this);
            e.circleProgress({
                fill: {color: e.attr("data-color")},
                size: e.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: "#e5e9f2",
                lineCap: "round"
            })
        })), t(".chart-circle-primary").length && t(".chart-circle-primary").each((function () {
            var e = t(this);
            e.circleProgress({
                fill: {color: e.attr("data-color")},
                size: e.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: "rgba(51, 102, 255, 0.4)",
                lineCap: "round"
            })
        })), t(".chart-circle-secondary").length && t(".chart-circle-secondary").each((function () {
            var e = t(this);
            e.circleProgress({
                fill: {color: e.attr("data-color")},
                size: e.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: "rgba(254, 127, 0, 0.4)",
                lineCap: "round"
            })
        })), t(".chart-circle-success").length && t(".chart-circle-success").each((function () {
            var e = t(this);
            e.circleProgress({
                fill: {color: e.attr("data-color")},
                size: e.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: "rgba(13, 205, 148, 0.5)",
                lineCap: "round"
            })
        })), t(".chart-circle-warning").length && t(".chart-circle-warning").each((function () {
            var e = t(this);
            e.circleProgress({
                fill: {color: e.attr("data-color")},
                size: e.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: "rgba(247, 40, 74, 0.4)",
                lineCap: "round"
            })
        })), t(".chart-circle-danger").length && t(".chart-circle-danger").each((function () {
            var e = t(this);
            e.circleProgress({
                fill: {color: e.attr("data-color")},
                size: e.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: "rgba(247, 40, 74, 0.4)",
                lineCap: "round"
            })
        })), t(document).on("click", "[data-toggle='search']", (function (e) {
            var o = t("body");
            o.hasClass("search-gone") ? (o.addClass("search-gone"), o.removeClass("search-show")) : (o.removeClass("search-gone"), o.addClass("search-show"))
        }));
        var o = function () {
            t(window).outerWidth() <= 1024 ? (t("body").addClass("sidebar-gone"), t(document).off("click", "body").on("click", "body", (function (e) {
                (t(e.target).hasClass("sidebar-show") || t(e.target).hasClass("search-show")) && (t("body").removeClass("sidebar-show"), t("body").addClass("sidebar-gone"), t("body").removeClass("search-show"))
            }))) : t("body").removeClass("sidebar-gone")
        };
        o(), t(window).resize(o);
        var l = "div.card";
        t('[data-toggle="card-remove"]').on("click", (function (e) {
            return t(this).closest(l).remove(), e.preventDefault(), !1
        })), t('[data-toggle="card-collapse"]').on("click", (function (e) {
            return t(this).closest(l).toggleClass("card-collapsed"), e.preventDefault(), !1
        })), t('[data-toggle="card-fullscreen"]').on("click", (function (e) {
            return t(this).closest(l).toggleClass("card-fullscreen").removeClass("card-collapsed"), e.preventDefault(), !1
        })), t(document).on("change", ".file-browserinput", (function () {
            var e = t(this), o = e.get(0).files ? e.get(0).files.length : 1,
                l = e.val().replace(/\\/g, "/").replace(/.*\//, "");
            e.trigger("fileselect", [o, l])
        })), t(".file-browserinput").on("fileselect", (function (e, o, l) {
            var c = t(this).parents(".input-group").find(":text"), r = o > 1 ? o + " مورد انتخاب شد" : l;
            c.length ? c.val(r) : r && alert(r)
        })), t(".select2").select2({
            minimumResultsForSearch: 1 / 0,
            width: "100%"
        }), t(".thumb").on("click", (function () {
            t(this).hasClass("active") || (t(".thumb.active").removeClass("active"), t(this).addClass("active"))
        }))
    }(jQuery)
})();
$((function () {
    $(".select2").select2({
        minimumResultsForSearch: 1 / 0,
        width: "100%"
    }), $(".select2-show-search").select2({minimumResultsForSearch: "", placeholder: "Search", width: "100%"})
}));
const base_url = $('meta[name=base_url]').attr("content");
if ($('#form_req')[0]) {
$(document).ready(function () {
    jQuery.extend(jQuery.validator.messages, {
        required: "این فیلد الزامی است.",
        remote: "لطفاً این قسمت را اصلاح کنید.",
        email: "لطفا یک آدرس ایمیل معتبر وارد کنید.",
        url: "لطفا یک نشانی وب معتبر وارد کنید.",
        date: "لطفا یک تاریخ معتبر وارد کنید.",
        dateISO: "لطفاً تاریخ معتبر (ISO) را وارد کنید.",
        number: "لطفا یک شماره معتبر وارد کنید.",
        digits: "لطفاً فقط ارقام را وارد کنید.",
        creditcard: "لطفا یک شماره کارت اعتباری معتبر وارد کنید.",
        equalTo: "لطفا مجددا همان مقدار را وارد کنید.",
        accept: "لطفاً یک مقدار با پسوند معتبر وارد کنید.",
        maxlength: jQuery.validator.format("لطفاً بیش از {0} نویسه وارد نکنید."),
        minlength: jQuery.validator.format("لطفاً حداقل {0} نویسه وارد کنید."),
        rangelength: jQuery.validator.format("لطفاً مقدار بین {0} و {1} نویسه را وارد کنید."),
        range: jQuery.validator.format("لطفاً مقداری بین {0} و {1} وارد کنید."),
        max: jQuery.validator.format("لطفاً مقداری کمتر یا مساوی {0} وارد کنید."),
        min: jQuery.validator.format("لطفاً مقدار بزرگتر یا مساوی {0} وارد کنید.")
    });

});
    }


$((function (e) {
    if ($('#tbl_1')[0]) {
        $("#tbl_1").DataTable({
            "order": [0, "asc"],
            "language": {
                "search": '<span>فیلتر :</span> _INPUT_',
                "lengthMenu": '<span class="tb-num">تعداد نمایش :</span> _MENU_',
                "emptyTable": "موردی یافت نشد",
                "zeroRecords": "درجستجو، موردی یافت نشد",
                "paginate": {
                    "next": "بعدی",
                    "previous": "قبلی"
                }
            },
            "info": false,
            "paging": true,
            "ordering": true,
            "responsive": false,
        });
    }
    if ($('.tbl_1')[0]) {
        $(".tbl_1").DataTable({
            "order": [0, "asc"],
            "language": {
                "search": '<span>فیلتر :</span> _INPUT_',
                "lengthMenu": '<span class="tb-num">تعداد نمایش :</span> _MENU_',
                "emptyTable": "موردی یافت نشد",
                "zeroRecords": "درجستجو، موردی یافت نشد",
                "paginate": {
                    "next": "بعدی",
                    "previous": "قبلی"
                }
            },
            "info": false,
            "paging": true,
            "ordering": true,
            "responsive": false,
        });
    }
    if ($('#tbl_2')[0]) {
        (s = $('#tbl_2').DataTable({
            "order": [0, "asc"],
            "buttons": [
                {
                    extend: 'excel',
                    text: 'خروجی اکسل'
                },
                {
                    extend: 'print',
                    text: 'پرینت'
                }
            ],
            "language": {
                "search": '<span>فیلتر :</span> _INPUT_',
                "lengthMenu": '<span class="tb-num">تعداد نمایش :</span> _MENU_',
                "emptyTable": "موردی یافت نشد",
                "zeroRecords": "درجستجو، موردی یافت نشد",
                "paginate": {
                    "next": "بعدی",
                    "previous": "قبلی"
                }
            },
            "info": false,
            "paging": true,
            "ordering": true,
            "responsive": false,
        })).buttons().container().appendTo("#tbl_2_wrapper .col-md-6:eq(0)");
    }
    if ($('#tbl_3')[0]) {
        $("#tbl_3").DataTable({
            "language": {
                "search": '<span>فیلتر :</span> _INPUT_',
                "lengthMenu": '<span class="tb-num">تعداد نمایش :</span> _MENU_',
                "emptyTable": "موردی یافت نشد",
                "zeroRecords": "درجستجو، موردی یافت نشد",
                "paginate": {
                    "next": "بعدی",
                    "previous": "قبلی"
                }
            },
            "info": false,
            "paging": true,
            "ordering": false,
            "responsive": false,
        });
    }
}));

if ($('.date_birth')[0]) {
    $('.date_birth').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        initialValueType: 'persian',
        altField: '.observer-example-alt',
        calendar: {
            persian: {
                locale: 'en'
            }
        }
    });
}
if ($('.date_birth_not')[0]) {
    $('.date_birth_not').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        initialValue: false,
        initialValueType: 'persian',
        altField: '.observer-example-alt',
        calendar: {
            persian: {
                locale: 'en'
            }
        }
    });
}

if ($('#slug')[0]) {
    $('#title').on('keyup',function (){
        var title=$(this).val();
        var slug=title.split(' ').join('-')
        var slug=slug.split('/').join('.');
        $('#slug').val(slug)
    })
    $('#title').on('change',function (){
        var title=$(this).val();
        var slug=title.split(' ').join('-')
        var slug=slug.split('/').join('.');
        $('#slug').val(slug)
    })
}
$('#status_archive').on('change',function (){
    var val=$(this).val();
    if(val=='active')
    {
        $('#archive_time_div').removeClass('d-none')
    }
    else
    {
        $('#archive_time_div').addClass('d-none')
    }
})
$('#type_news').on('change',function (){
    var this_val=$(this).val()
    if(this_val=='note')
    {
        $('.note_status_check').removeClass('d-none')
    }
    else
    {
        $('.note_status_check').addClass('d-none')
    }
})


$('.en_input').on('keyup', function (event) {
    var arregex = /^[a-zA-Z0-9_ ]*$/;
    if (!arregex.test(event.key)) {
        $('.en_input').val("");
    }
});
$('.en_input2').on('keyup', function (event) {
    var arregex = /^[a-zA-Z0-9]*$/;
    if (!arregex.test(event.key)) {
        $('.en_input').val("");
    }
});

$('.gearbox_select').on('change',function (){
        var url=$(this).find(':selected').attr('data-url');
        $.get(url, function (data, status) {
            $.each(data, function (key, value) {
                $('.'+value.class).val(value.value)
            })
        })
    })
    $('.fuel_select').on('change',function (){
        var url=$(this).find(':selected').attr('data-url');
        $.get(url, function (data, status) {
            $.each(data, function (key, value) {
                $('.'+value.class).val(value.value)
            })
        })
    })
    
    $('.brand-select').on('change',function (){
    var val=$(this).val()
     $('.model-select-input').val('')
    if(val=='other')
    {
        $('.model_select_other').removeClass('d-none')
        $('.brand_input').attr('required',true)
        $('.model_input').attr('required',true)
        $('.model-select-input').attr('required',false)
        $('.model_select').addClass('d-none')
        $('.all_brand').attr('disabled',true)
    }
    else
    {
        $('.model_select_other').addClass('d-none')
        $('.brand_input').attr('required',false)
        $('.model_input').attr('required',false)
        $('.model-select-input').attr('required',true)
        $('.all_brand').attr('disabled',true)
        $('.brand_'+val).attr('disabled',false)
        $('.model_select').removeClass('d-none')
    }
     $('.model-select-input').trigger('change')
    
})

  $('.status-select').on('change',function (){
        var val=$(this).val();

        $('.return_date').addClass('d-none')
        if(val=='در حال اجاره')
        {
            $('.return_date').removeClass('d-none')
        }
    })
