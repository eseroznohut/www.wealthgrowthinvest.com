$(function () {
    //$("#btnSil").click(function () {
    //    var count = $('input[data-type="select"]:checkbox:checked').length;
    //    var cf = confirm("Seçili " + count + " adet modülü silmek istediğinizden eminmisiniz?");

    //    if (cf) {
    //        $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "modul_sil").appendTo('#sil-form');

    //        $("input[data-type='select']").each(function () {
    //            if (this.checked) {
    //                var id = $(this).attr("data-id");

    //                $('<input />').attr('type', 'hidden').attr('name', "d-" + id).attr('value', id).appendTo('#sil-form');

    //            }

    //        });

    //        $("#sil-form").submit();

    //    }

    //});



});


function dropzone(dosya, id) {
    $(".dropzone_container").find("#dropzone").remove();

    $(".dropzone_container")
        .append('<div id="dropzone" class="dropzone" style="background-color:#ACC6D7; width:auto;overflow: hidden;"></div>');


    $("#dropzone")
        .dropzone({
            paramName: 'resim_yolu',
            url: 'system/dropzone.php',
            params: { 'islem': 'yukle', 'dosya': dosya, 'id': id },

            clickable: true,
            maxFilesize: 10,
            uploadMultiple: false,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            init: function() {
                thisDropzone = this;
                $.get('system/dropzone.php',
                    { id: id, islem: 'getir', dosya: dosya },
                    function(data) {
                        $.each(data,
                            function(key, value) {
                                var mockFile = { name: value.name, size: value.size };

                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                                thisDropzone.options.thumbnail.call(thisDropzone,
                                    mockFile,
                                    "../uploads/images/" + dosya + "/" + value.name);

                            });

                    });

                this.on("addedfile",
                    function(file) {
                        $("#haberEditModal").find(".btn").prop("disabled", true);

                    });

                this.on("success",
                    function(file, response) {
                        $(file.previewTemplate)
                            .append('<div class="server_file" style="display:none;">' +
                                response
                                .replace(" ", "") +
                                '</div>');

                    });

                this.on("complete",
                    function(file) {
                        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                            $("#haberEditModal").find(".btn").prop("disabled", false);

                        }

                    });

                this.on("processing",
                    function(file) {
                        $("#haberEditModal").find(".btn").prop("disabled", true);

                    });

            },

            removedfile: function(file, response) {

                var server_file = $(file.previewTemplate).children('.server_file').html();

                var newname = "";
                if (server_file) {
                    newname = server_file.replace(/(\r\n|\n|\r)/gm, "");

                } else {
                    newname = file.name;
                }

                $.ajax({
                    type: 'POST',
                    url: 'system/dropzone.php',
                    data: { id: id, dosya: dosya, islem: 'sil', kucuk_resim_adi: newname },

                    dataType: 'text',
                    success: function(result) {

                        //alert(result);

                    },
                    error: function(requestObject, error, errorThrown) {
                        alert("hata");

                    }

                });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }

        });

}


