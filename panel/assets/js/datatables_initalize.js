$(document).ready(function () {
    $(".datatable_").dataTable({
        dom: "Blfrtip", buttons: ["excel", "pdf", "print"], language: {
            sDecimal: ",", sEmptyTable: "Tabloda herhangi bir veri mevcut değil", sInfo: "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor", sInfoEmpty: "Kayıt yok", sInfoFiltered: "(_MAX_ kayıt içerisinden bulunan)", sInfoPostFix: "", sInfoThousands: ".", sLengthMenu: "_MENU_", sLoadingRecords: "Yükleniyor...", sProcessing: "İşleniyor...", sZeroRecords: "Eşleşen kayıt bulunamadı", oPaginate: { sFirst: "İlk", sLast: "Son", sNext: "Sonraki", sPrevious: "Önceki" },
            oAria: { sSortAscending: ": artan sütun sıralamasını aktifleştir", sSortDescending: ": azalan sütun soralamasını aktifleştir" }
        }
    });

     var a = $(".checkbox_tables").DataTable({
         dom: "Blfrtip", columnDefs: [{ orderable: !1, targets: 0 }], aaSorting: [], buttons: ["excel", "pdf", "print"], language: {
             sDecimal: ",", sEmptyTable: "Tabloda herhangi bir veri mevcut değil", sInfo: "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor", sInfoEmpty: "Kayıt yok", sInfoFiltered: "(_MAX_ kayıt içerisinden bulunan)", sInfoPostFix: "", sInfoThousands: ".", sLengthMenu: "_MENU_", sLoadingRecords: "Yükleniyor...", sProcessing: "İşleniyor...", sZeroRecords: "Eşleşen kayıt bulunamadı", oPaginate: { sFirst: "İlk", sLast: "Son", sNext: "Sonraki", sPrevious: "Önceki" },
             oAria: { sSortAscending: ": artan sütun sıralamasını aktifleştir", sSortDescending: ": azalan sütun soralamasını aktifleştir" }
         }
     });

     $(".panel-ctrls").closest('table').each(function () {

         var filter = $(this).parent(".dataTables_wrapper").find(".dataTables_filter");
         $(filter).addClass("pull-right");
         $(filter).find("label").addClass("panel-ctrls-center");

         var sayfalama = $(this).parent(".dataTables_wrapper").find(".dataTables_length");
         $(sayfalama).addClass("pull-left");
         $(sayfalama).find("label").addClass("panel-ctrls-center");


         var dataTables_info = $(this).parent(".dataTables_wrapper").find(".dataTables_info");
         $(this).parent().parent().parent().find(".panel-footer").append(dataTables_info);

         var dataTables_paginate = $(this).parent(".dataTables_wrapper").find(".dataTables_paginate");
         $(dataTables_paginate).find(".pagination").addClass("pull-right m-n");
         $(this).parent().parent().parent().find(".panel-footer").append(dataTables_paginate);


         var ctrl_panel = $(this).find(".panel-ctrls");
         $(ctrl_panel).append("<i class='separator'></i>");
         $(ctrl_panel).append(filter);
         $(ctrl_panel).append(sayfalama);


     });





     $("#btnSil").prop("disabled", !0),
     $("#btnEpostaGonder").prop("disabled", !0),
     $("#btnSmsGonder").prop("disabled", !0),
     $("#btnTümünüSeç").on("click", function () {
         var b = a.rows({ search: "applied" }).nodes();
         $('input[data-type="select"]', b).prop("checked", this.checked),
         $("#btnTümünüSeç").prop("checked", $('input[data-type="select"]:checkbox:checked').length > 0),
         $("#btnSil").prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0)),
         $("#btnEpostaGonder").prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0)),
         $("#btnSmsGonder").prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0))
     }),
     $(".checkbox_tables tbody").on("change", 'input[data-type="select"]', function () {
         $("#btnTümünüSeç").prop("checked", $('input[data-type="select"]:checkbox:checked').length > 0),
         $("#btnSil").prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0)),
         $("#btnEpostaGonder").prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0)),
         $("#btnSmsGonder").prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0))
     }),
     $(".dt-buttons").insertAfter(".basliklar"),
     $(".ui-sortable").find(".dt-buttons").addClass("col-md-3"),
     $("#DataTables_Table_0_wrapper").find(".dt-buttons").remove(),
     $(".buttons-excel, .buttons-pdf, .buttons-print").addClass("btn").addClass("btn-sm").addClass("btn-raised").addClass("btn-default"),
     $(".buttons-print").find("span").html("YAZDIR"),
     $(".dataTables_info").addClass("col-md-6").css({ float: "left" }),
     $(".dataTables_paginate").addClass("col-md-6").css({ float: "right" }),
     window.exportButtons === !1 && $(".dt-buttons").remove(),
     $("#btnSmsGonder").click(function () { alert("Sms gönderimini aktif etmek için lütfen bize ulaşın.") }),
     0 === $(".secenekler_column").find("button").length && $(".secenekler").hide()
 });
