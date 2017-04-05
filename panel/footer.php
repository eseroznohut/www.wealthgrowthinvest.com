
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/enquire.min.js"></script>
<script src="assets/plugins/velocityjs/velocity.min.js"></script>
<script src="assets/plugins/velocityjs/velocity.ui.min.js"></script>
<script src="assets/plugins/progress-skylo/skylo.js"></script>
<script src="assets/plugins/wijets/wijets.js"></script>
<script src="assets/plugins/sparklines/jquery.sparklines.min.js"></script>
<script src="assets/plugins/codeprettifier/prettify.js"></script>
<script src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>
<script src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script>
<script src="assets/plugins/dropdown.js/jquery.dropdown.js"></script>
<script src="assets/plugins/bootstrap-material-design/js/material.min.js"></script>
<script src="assets/plugins/bootstrap-material-design/js/ripples.min.js"></script>
<script src="assets/js/application.js"></script>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="assets/plugins/bootstrap-switch/bootstrap-switch.js"></script>
<script src="assets/plugins/charts-flot/jquery.flot.min.js"></script>
<script src="assets/plugins/charts-flot/jquery.flot.pie.min.js"></script>
<script src="assets/plugins/charts-flot/jquery.flot.stack.min.js"></script>
<script src="assets/plugins/charts-flot/jquery.flot.resize.min.js"></script>
<script src="assets/plugins/charts-flot/jquery.flot.tooltip.min.js"></script>
<script src="assets/plugins/charts-flot/jquery.flot.spline.js"></script>
<script src="assets/plugins/easypiechart/jquery.easypiechart.min.js"></script>
<script src="assets/plugins/curvedLines-master/curvedLines.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="assets/plugins/summernote/dist/summernote.js"></script>
<script src="assets/plugins/summernote/dist/summernote-tr-TR.js"></script>
<script src="assets/plugins/datatables/export/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/export/dataTables.bootstrap.js"></script>
<script src="assets/plugins/datatables/export/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/export/buttons.flash.min.js"></script>
<script src="assets/plugins/datatables/export/jszip.min.js"></script>
<script src="assets/plugins/datatables/export/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/export/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/export/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/export/buttons.print.min.js"></script>
<script src="assets/plugins/form-parsley/parsley.js"></script>
<script src="assets/plugins/pines-notify/pnotify.min.js"></script>
<script src="assets/plugins/snackbar/snackbar.min.js"></script>
<script src="assets/plugins/form-select2/select2.min.js"></script>
<script src="assets/plugins/chartist/dist/chartist.min.js"></script>
<script src="assets/js/datatables_initalize.js"></script>
<script src="assets/js/index.js"></script>
<script>
    $(function () {
        $('.summernote').summernote({
            lang: 'tr-TR',
            height: 200,
            toolbar: [
                 ['style', ['style']],
                 ['para', ['ul', 'ol', 'paragraph']],
                 ['height', ['height']],
                 ['table', ['table']],
                 ['insert', ['link', 'picture', 'hr']],
                 ['view', ['fullscreen', 'codeview']],
                 ['help', ['help']]
            ]
        });
    });
</script>
<link rel="stylesheet" href="assets/plugins/hightcharts/css/map.css" />
<script src="assets/plugins/hightcharts/js/highmaps.js"></script>
<script src="assets/plugins/hightcharts/js/index.js?1"></script>
<script src="assets/plugins/hightcharts/js/theme.js"></script>
<link href="assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<script src="assets/plugins/dropzone/dropzone.min.js"></script>
<script src="assets/js/script_functions.js"></script>

<script type="text/javascript">

    $(function () {
        harita();

        $("input[type='text']:not([data-charakter='normal'])").keyup(function () {
            var str = $(this).val();
            $(this).val(str.toLowerCase());
        });

        $('input[type="file"]').bind('change', function(e) {

            if(this.files[0].size > 4096){
                //alert("Dosya çok büyük");
                //$(this).attr();
            }

        });
    });
    function form_kontrol() {
        return $('form').parsley().validate();
    }
    function harita(){
        var baseMapPath = "http://code.highcharts.com/mapdata/",
                showDataLabels = false,
                mapCount = 0,
                searchText,
                mapOptions = '';
        $.each(Highcharts.mapDataIndex, function (mapGroup, maps) {
            if (mapGroup !== "version") {
                mapOptions += '<option class="option-header">' + mapGroup + '</option>';
                $.each(maps, function (desc, path) {
                    mapOptions += '<option value="' + path + '">' + desc + '</option>';
                    mapCount += 1;
                });
            }
        });
        searchText = 'Search ' + mapCount + ' maps';
        mapOptions = '<option value="custom/world.js">' + searchText + '</option>' + mapOptions;
        $("#mapDropdown").append(mapOptions);
        $("#mapDropdown").change(function () {
            var $selectedItem = $("option:selected", this),
                mapDesc = $selectedItem.text(),
                mapKey = this.value.slice(0, -3),
                svgPath = baseMapPath + mapKey + '.svg',
                geojsonPath = baseMapPath + mapKey + '.geo.json',
                javascriptPath = baseMapPath + this.value,
                isHeader = $selectedItem.hasClass('option-header');

            if (mapDesc === searchText || isHeader) {
                $('.custom-combobox-input').removeClass('valid');
                location.hash = '';
            } else {
                $('.custom-combobox-input').addClass('valid');
                location.hash = mapKey;
            }
            if (isHeader) { return false; }
            if ($("#container").highcharts()) {
                $("#container").highcharts().showLoading('<i class="fa fa-spinner fa-spin fa-2x"></i>');
            }
            function mapReady() {
                var mapGeoJSON = Highcharts.maps[mapKey], data = [], parent, match;
                $.each(mapGeoJSON.features, function (index, feature) {
                    data.push({
                        key: feature.properties['hc-key'],
                        value: 0,
                        name:feature.properties['name'],
                        grup:feature.properties['hc-group']
                    });
                });

			<?php foreach($sehirler as $result): ?>
                bolgeVeriAta("<?php echo strtolower($result) ?>",<?php echo $result->getVisits() ?>);
			<?php endforeach ?>

			<?php foreach($ulkeler as $result): ?>
                bolgeVeriAta("<?php echo strtolower($result) ?>",<?php echo $result->getVisits() ?>);
			<?php endforeach ?>

                function bolgeVeriAta(bolge_kodu, deger){
                    var s_result = $.grep(data, function (e)  {
                        if(e.name!=null){ return e.name.toLowerCase() == bolge_kodu  }
                    });
                    if(s_result[0]!=null) s_result[0].value=deger;

                    var h_result = $.grep(data, function (e) { if(e.key!=null){ return e.key == bolge_kodu}});
                    if(h_result[0]!=null) h_result[0].value=deger;
                }

                match = mapKey.match(/^(countries\/[a-z]{2}\/[a-z]{2})-[a-z0-9]+-all$/);
                if (/^countries\/[a-z]{2}\/[a-z]{2}-all$/.test(mapKey)) {
                    parent = { desc: 'Yukarý', key: 'custom/world' };
                } else if (match) {
                    parent = {
                        desc: "Yukarý", key: match[1] + '-all'
                    };
                }

                $('#up').html('');
                if (parent) {
                    $('#up').append(
                        $('<a><i class="fa fa-angle-up btn btn-inverse bold"><span class="glyphicons glyphicons-message-forward"></span></i></a>').click(function () {
                            $('#mapDropdown').val(parent.key + '.js').change();
                        }));
                }

                $("#container").highcharts('Map', {
                    title: { text: null },
                    mapNavigation: { enabled: true },
                    colorAxis: { min: 0, stops: [[0, '#EFEFFF'],[0.5, Highcharts.getOptions().colors[0]],[1, Highcharts.Color(Highcharts.getOptions().colors[0]).brighten(-0.5).get()]]},
                    legend: {layout: 'vertical', align: 'left', verticalAlign: 'bottom'},
                    series: [{ data: data, mapData: mapGeoJSON, joinBy: ['hc-key', 'key'], name: 'Bolge',
                        states: { hover: { color: Highcharts.getOptions().colors[2] }},
                        dataLabels: { enabled: showDataLabels, formatter: function () {
                            return mapKey === 'custom/world' || mapKey === 'countries/us/us-all' ? (this.point.properties && this.point.properties['hc-a2']) : this.point.name; }
                        },
                        point: {
                            events: {
                                click: function () {
                                    var key = this.key;
                                    var name = this.name;
                                    var grup = this.grup;
                                    $('#mapDropdown option').each(function () {
                                        if (this.value === 'countries/' + key.substr(0, 2) + '/' + key + '-all.js') {
                                            $('#mapDropdown').val(this.value).change();
                                        }
                                    });	}}}
                    }, {
                        type: 'mapline',
                        name: "Separators",
                        data: Highcharts.geojson(mapGeoJSON, 'mapline'),
                        nullColor: 'gray',
                        showInLegend: false,
                        enableMouseTracking: false
                    }]
                });
                showDataLabels = $("#chkDataLabels").attr('checked');
            }
            if (Highcharts.maps[mapKey]) {
                mapReady();
            } else {
                $.getScript(javascriptPath, mapReady);
            }
        });
        $("#chkDataLabels").change(function () {
            showDataLabels = $("#chkDataLabels").attr('checked');
            $("#mapDropdown").change();
        });
        $("#btn-prev-map").click(function () {
            $("#mapDropdown option:selected").prev("option").prop("selected", true).change();
        });
        $("#btn-next-map").click(function () {
            $("#mapDropdown option:selected").next("option").prop("selected", true).change();
        });
        if (location.hash) {
            $('#mapDropdown').val(location.hash.substr(1) + '.js');
        } else {
            $($('#mapDropdown option')[0]).attr('selected', 'selected');
        }
        showDataLabels = $("#chkDataLabels").attr('checked');
        $('#mapDropdown').change();
    }

</script>
</body>
</html>