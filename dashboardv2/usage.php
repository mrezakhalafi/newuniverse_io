<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

unset($_SESSION['bill']);

$company_id = getSession('id_company');
echo "<script>base_url = '" . base_url() . "';</script>";

$query = $dbconn->prepare("SELECT a.* FROM USAGE_DETAIL a, USAGE_SUMMARY b WHERE a.USAGE_SUMMARY = b.ID AND b.COMPANY_ID = ?");
$query->bind_param("i", $company_id);
$query->execute();
$result = $query->get_result();

?>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-name"><strong id="usage-record-text">Usage Record</strong></h4><br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table_id" class="display" width="100%"></table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card usg-breakdown" id="usage_breakdown" style="display:none;">
                        <div class="card-header" style="border-bottom: 0;">
                            <h5><i class="fa fa-times" id="closeDeets" style="float:right;"></i></h5>
                        </div>
                        <div class="card-body">
                            <strong>
                                <h4><span id="details-id-text">Details for content ID</span> '<span id='selectContentId'></span>'</h4>
                            </strong>
                        </div>
                        <table id="table_id_detail" class="display table-detail" width="100%"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" charset="utf8" src="DataTables/datatables.min.js" defer></script>
<script type="text/javascript" src="js/usage_raw-min.js"></script>
<script type="text/javascript" src="js/usage_raw_id-min.js"></script>

<script>
    var comp_id = <?php echo $company_id ?>;

    // var _0x515c=['SERVICE_TYPE','CREATED\x20AT','hide','a.nav-link[href=\x22mailbox.php\x22]','#table_id_detail','click','ajax','GET','DataTable','78013GjNOBv','dataTables_populate.php?company_id=','a.nav-link[href=\x22support.php\x22]','#table_id','a.nav-link[href=\x22billpayment.php\x22]','clear','1117962JqCsAD','RATE','SERVICE\x20TYPE','1012354WRWhRM','#usage_breakdown','RECIPIENTS','row','addClass','HIDDEN_CONTENT_ID','&content_type=','52rghdpZ','&content_id=','DURATION','json','RATE_AMOUNT','CONTENT_ID','data','a.nav-link[href=\x22index.php\x22]','CREATED_AT','CONTENT\x20ID','990755TbbcRp','hasClass','297036amDXmp','dataTable','msg','show','ready','17fhZXfD','FROM','6KhNIzs','html','14253BUhARh','VOIP\x20CALL','removeClass','317777EFsqqK','active','destroy'];var _0x38eb=function(_0x1ee92d,_0x1f3db4){_0x1ee92d=_0x1ee92d-0xdd;var _0x515cdf=_0x515c[_0x1ee92d];return _0x515cdf;};var _0x232ff6=_0x38eb;(function(_0x5b59c9,_0x5d3e45){var _0x446db5=_0x38eb;while(!![]){try{var _0x521c80=-parseInt(_0x446db5(0xee))+parseInt(_0x446db5(0xf5))*parseInt(_0x446db5(0x10a))+-parseInt(_0x446db5(0x101))+-parseInt(_0x446db5(0xe5))*-parseInt(_0x446db5(0x106))+parseInt(_0x446db5(0xeb))+parseInt(_0x446db5(0x10d))*-parseInt(_0x446db5(0x108))+parseInt(_0x446db5(0xff));if(_0x521c80===_0x5d3e45)break;else _0x5b59c9['push'](_0x5b59c9['shift']());}catch(_0x1d188c){_0x5b59c9['push'](_0x5b59c9['shift']());}}}(_0x515c,0xea62a),$('a.nav-link[href=\x22usage.php\x22]')[_0x232ff6(0xf2)]('active'),$(_0x232ff6(0xfc))[_0x232ff6(0x10c)](_0x232ff6(0x10e)),$(_0x232ff6(0xe9))['removeClass'](_0x232ff6(0x10e)),$(_0x232ff6(0xe7))['removeClass'](_0x232ff6(0x10e)),$(_0x232ff6(0xdf))['removeClass'](_0x232ff6(0x10e)));var result=[],jsonarr;$(document)[_0x232ff6(0x105)](function(){var _0x34aa76=_0x232ff6;$['ajax']({'type':_0x34aa76(0xe3),'url':_0x34aa76(0xe6)+comp_id,'dataType':_0x34aa76(0xf8),'success':function(_0x5cb203,_0x26e4eb){var _0x1355da=_0x34aa76,_0xc372ab=$(_0x1355da(0xe8))['DataTable']({'responsive':!![],'data':_0x5cb203,'columns':[{'data':_0x1355da(0x110),'title':_0x1355da(0xed)},{'data':'FROM','title':_0x1355da(0x107)},{'data':'TO','title':'TO'},{'data':_0x1355da(0xf0),'title':_0x1355da(0xf0)},{'data':_0x1355da(0xfa),'title':_0x1355da(0xfe)},{'data':_0x1355da(0xf3),'title':'HIDDEN\x20CONTENT\x20ID'},{'data':_0x1355da(0xfd),'title':'CREATED\x20AT'},{'data':_0x1355da(0xf7),'title':'DURATION\x20(MINS)'},{'data':_0x1355da(0xf9),'title':_0x1355da(0xec)}],'columnDefs':[{'targets':[0x5],'visible':![]}]});$('#table_id\x20tbody')['on'](_0x1355da(0xe1),'tr',function(){var _0x362e57=_0x1355da,_0x22ba16=_0xc372ab[_0x362e57(0xf1)](this)[_0x362e57(0xfb)]();$(_0x362e57(0xe0))[_0x362e57(0x100)](_0x362e57(0x102))&&$(_0x362e57(0xe0))[_0x362e57(0xe4)]()[_0x362e57(0xea)]()[_0x362e57(0x10f)]();if(_0x22ba16[_0x362e57(0x110)]==='LIVE\x20STREAMING'||_0x22ba16[_0x362e57(0x110)]==='VIDEO\x20CALL'||_0x22ba16[_0x362e57(0x110)]===_0x362e57(0x10b)){var _0x91b17e=_0x22ba16[_0x362e57(0xf3)],_0x1dcd3b=btoa(_0x91b17e);_0x4cefc0('1',_0x22ba16['CONTENT_ID'],_0x1dcd3b);}else _0x4cefc0('0',_0x22ba16[_0x362e57(0xfa)],_0x22ba16[_0x362e57(0xfa)]);});},'error':function(_0x1404a9,_0x4449eb){var _0x3a3e4=_0x34aa76;alert(_0x1404a9[_0x3a3e4(0x103)]);}}),$('#closeDeets')[_0x34aa76(0xe1)](function(){var _0x2ebfbd=_0x34aa76;$('#table_id_detail')[_0x2ebfbd(0xe4)]()['clear']()['destroy'](),$(_0x2ebfbd(0xef))[_0x2ebfbd(0xde)]();});function _0x4cefc0(_0x1c102e,_0xc6fde3,_0x412f6d){var _0x927abf=_0x34aa76;$[_0x927abf(0xe2)]({'type':_0x927abf(0xe3),'url':'dataTables_populate_1.php?company_id='+comp_id+_0x927abf(0xf6)+_0x412f6d+_0x927abf(0xf4)+_0x1c102e,'dataType':_0x927abf(0xf8),'success':function(_0x265c2e,_0x169104){var _0x3c3fbc=_0x927abf;$(_0x3c3fbc(0xef))[_0x3c3fbc(0x104)](),$('#selectContentId')[_0x3c3fbc(0x109)](_0xc6fde3);var _0x451d90=$('#table_id_detail')[_0x3c3fbc(0xe4)]({'searching':![],'paging':![],'responsive':!![],'data':_0x265c2e,'columns':[{'data':_0x3c3fbc(0x110),'title':_0x3c3fbc(0xed)},{'data':_0x3c3fbc(0x107),'title':_0x3c3fbc(0x107)},{'data':'TO','title':'TO'},{'data':'CONTENT_ID','title':_0x3c3fbc(0xfe)},{'data':_0x3c3fbc(0xfd),'title':_0x3c3fbc(0xdd)},{'data':'DURATION','title':'DURATION\x20(MINS)'}]});}});}});
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

</body>

</html>
<script src="plugins/jquery/jquery.min.js"></script>
<script>
    $('#lang-nav').hover(function() {
        $('#lang-menu').dropdown("show");
    }, function() {
        $('#lang-menu').dropdown("hide");
    });

    $('#lang-menu').hover(function() {
        $('#lang-menu').dropdown("show");
    }, function() {
        $('#lang-menu').dropdown("hide");
    });

    $("#change-lang-EN").click(function() {
        localStorage.lang = 0;
        $("#lang-nav").text('EN');
        $('#details-id-text').text('Details for content ID ');
        $('#usage-record-text').text('Usage Record');
        change_lang();
        usageRawEN();
    });

    $("#change-lang-ID").click(function() {
        localStorage.lang = 1;
        $("#lang-nav").text('ID');
        $('#details-id-text').text('Detail dari ID konten ');
        $('#usage-record-text').text('Riwayat Pemakaian');
        change_lang();
        usageRawID();
    });

    if (localStorage.lang == 1) {
        $('#details-id-text').text('Detail dari ID konten ');
        $('#usage-record-text').text('Riwayat Pemakaian');
        usageRawID();
    } else {
        usageRawEN();
    }
</script>