function usageRawID(){    

    if ($('#table_id').hasClass('dataTable')) {
        $('#table_id').DataTable().clear().destroy();
        $('#table_id').html("");
    }

    if ($('#table_id_detail').hasClass('dataTable')) {
        $('#table_id_detail').DataTable().clear().destroy();

        var rowdata = JSON.parse(localStorage.getItem('detail_usage'));

        if (rowdata.SERVICE_TYPE === 'LIVE STREAMING' || rowdata.SERVICE_TYPE === 'VIDEO CALL' || rowdata.SERVICE_TYPE === 'VOIP CALL') {
            var raw_ID = rowdata.HIDDEN_CONTENT_ID;
            var encode_plus = btoa(raw_ID);
            
            getUsageDetail('1', rowdata.CONTENT_ID, encode_plus);
        } else {
            getUsageDetail('0', rowdata.CONTENT_ID, rowdata.CONTENT_ID);
        }
    }

    $('a.nav-link[href="usage.php"]').addClass('active');
    $('a.nav-link[href="index.php"]').removeClass('active');
    $('a.nav-link[href="billpayment.php"]').removeClass('active');

    $('a.nav-link[href="support.php"]').removeClass('active');
    $('a.nav-link[href="mailbox.php"]').removeClass('active');

    
    // var comp_data;
    var result = [];
    var jsonarr;

    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: 'dataTables_populate.php?company_id=' + comp_id +'&lang=ID',
            dataType: 'json',
            success: function(obj, textstatus) {

                var bulanEN = ['January', 'February', 'March','April','May','June','July','August','September','October','November','December'];
                var bulanID = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                Object.keys(obj).forEach(function(key) {

                    console.log(obj[key].CREATED_AT.split(" ")[1]);
                  
                    if (bulanEN.includes(obj[key].CREATED_AT.split(" ")[1])){

                        let index = bulanEN.indexOf(obj[key].CREATED_AT.split(" ")[1]);

                        obj[key].CREATED_AT = obj[key].CREATED_AT.replace(obj[key].CREATED_AT.split(" ")[1],bulanID[index]);
                    }

                })

                var table = $('#table_id').DataTable({
                    scrollX: true,
                    data: obj,
                    language: {
                        "lengthMenu":     "Tampilkan _MENU_ entri",
                        "search":         "Pencarian:",
                        "zeroRecords":    "Tidak ada data ditemukan",
                        "infoFiltered":   "(difilter dari _MAX_ total entri)",
                        "paginate": {
                            "first":      "Awal",
                            "last":       "Akhir",
                            "next":       "Selanjutnya",
                            "previous":   "Sebelumnya"
                        },
                        "infoEmpty":      "Menampilkan 0 ke 0 dari 0 entri",
                        "info":           "Menampilkan _START_ ke _END_ dari _TOTAL_ entri",
                        "emptyTable":     "Tidak ada data tersedia pada tabel",
                    },
                    columns: [{
                            data: "SERVICE_TYPE",
                            title: "TIPE LAYANAN"
                        },
                        {
                            data: "FROM",
                            title: "DARI"
                        },
                        {
                            data: "TO",
                            title: "KE"
                        },
                        {
                            data: "RECIPIENTS",
                            title: "PENERIMA"
                        },
                        {
                            data: "CONTENT_ID",
                            title: "ID KONTEN"
                        },
                        {
                            data: "HIDDEN_CONTENT_ID",
                            title: "KONTEN ID TERSEMBUNYI"
                        },
                        {
                            data: "CREATED_AT",
                            title: "DIBUAT PADA"
                        },
                        {
                            data: "DURATION",
                            title: "DURASI (MENIT)"
                        },
                        {
                            data: "RATE_AMOUNT",
                            title: "RATA-RATA"
                        },
                    ],
                    columnDefs: [
                        {
                            "targets": [ 5 ],
                            "visible": false,
                        }
                    ]
                });
                $('#table_id tbody').on('click', 'tr', function() {

                    var rowdata = table.row(this).data();
                    localStorage.setItem('detail_usage', JSON.stringify(table.row(this).data()));
                    console.log(">>>" + rowdata);

                    if ($('#table_id_detail').hasClass('dataTable')) {
                        $('#table_id_detail').DataTable().clear().destroy();
                    }
                    // console.log('TYPE: ' + rowdata.SERVICE_TYPE);
                    if (rowdata.SERVICE_TYPE === 'LIVE STREAMING' || rowdata.SERVICE_TYPE === 'VIDEO CALL' || rowdata.SERVICE_TYPE === 'VOIP CALL') {
                        var raw_ID = rowdata.HIDDEN_CONTENT_ID;
                        var encode_plus = btoa(raw_ID);
                        // console.log('base64 content ID: ' + encode_plus);
                        getUsageDetail('1', rowdata.CONTENT_ID, encode_plus);
                    } else {
                        getUsageDetail('0', rowdata.CONTENT_ID, rowdata.CONTENT_ID);
                    }
                    
                });
            },
            error: function(obj, textstatus) {
                alert(obj.msg);
            }
        });

        $('#closeDeets').click(function() {
            $('#table_id_detail').DataTable().clear().destroy();
            $('#usage_breakdown').hide();
        });

    });

    function getUsageDetail(type, content_id, hidden_content_id) {
        $.ajax({
            type: "GET",
            url: 'dataTables_populate_1.php?company_id='+ comp_id +'&content_id=' + hidden_content_id + '&content_type=' + type +'&lang=ID',
            dataType: 'json',
            success: function(obj, textstatus) {

                var bulanEN = ['January', 'February', 'March','April','May','June','July','August','September','October','November','December'];
                var bulanID = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                Object.keys(obj).forEach(function(key) {

                    console.log(obj[key].CREATED_AT.split(" ")[1]);
                  
                    if (bulanEN.includes(obj[key].CREATED_AT.split(" ")[1])){

                        let index = bulanEN.indexOf(obj[key].CREATED_AT.split(" ")[1]);

                        obj[key].CREATED_AT = obj[key].CREATED_AT.replace(obj[key].CREATED_AT.split(" ")[1],bulanID[index]);
                    }

                })

                $('#usage_breakdown').show();
                $('#selectContentId').html(content_id);
                var table_detail = $('#table_id_detail').DataTable({
                    searching: false,
                    paging: false,
                    scrollX: true,
                    data: obj,
                    language: {
                        "lengthMenu":     "Tampilkan _MENU_ entri",
                        "search":         "Pencarian:",
                        "zeroRecords":    "Tidak ada data ditemukan",
                        "infoFiltered":   "(difilter dari _MAX_ total entri)",
                        "paginate": {
                            "first":      "Awal",
                            "last":       "Akhir",
                            "next":       "Selanjutnya",
                            "previous":   "Sebelumnya"
                        },
                        "infoEmpty":      "Menampilkan 0 ke 0 dari 0 entri",
                        "info":           "Menampilkan _START_ ke _END_ dari _TOTAL_ entri",
                        "emptyTable":     "Tidak ada data tersedia pada tabel",
                    },
                    columns: [{
                            data: "SERVICE_TYPE",
                            title: "TIPE LAYANAN"
                        },
                        {
                            data: "FROM",
                            title: "DARI"
                        },
                        {
                            data: "TO",
                            title: "KE"
                        },
                        {
                            data: "CONTENT_ID",
                            title: "ID KONTEN"
                        },
                        {
                            data: "CREATED_AT",
                            title: "DIBUAT PADA"
                        },
                        {
                            data: "DURATION",
                            title: "DURASI (MENIT)"
                        },
                    ]
                });
            },
        });
    }
}