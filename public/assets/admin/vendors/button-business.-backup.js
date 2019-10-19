//start click tất cả thì tắt các chức năng khác---------------------------------------------------------------------------------
$('#all').on('click', function(event)
{
    $('#dhht').css({
      background: '',
      color: 'black'
    });
    $('#dhsc').css({
      background:'',
      color: 'black'
    });
    $('#ch').removeClass('btn-danger');
    $("#ch").prop("disabled",true);
    $('#dnl').removeClass('btn-danger');
    $("#dnl").prop("disabled",true);
    $('#kn').removeClass('btn-danger');
    $("#kn").prop("disabled",true);
    $('#dhvc').css({
      background:'',
      color: 'black'
    });
    $('#clh').removeClass('btn-success');
    $("#clh").prop("disabled",true);
    $('#dvc').removeClass('btn-success');
    $("#dvc").prop("disabled",true);
    $('#dnh').removeClass('btn-success');
    $("#dnh").prop("disabled",true);
    $('#dnt').removeClass('btn-info');
    $("#dnt").prop("disabled",true);
    $('#dnl').removeClass('btn-info');
    $("#dnl").prop("disabled",true);
});
//end click tất cả thì tắt các chức năng khác---------------------------------------------------------------------------------

//start click DHVC thì tắt các chức năng khác---------------------------------------------------------------------------------
$("#dhvc").on('click', function()
{
    $(this).css({
      background: '#007DBD',
      color: 'white'
    });
    // --------------START bat nut cho lay hang,dang van chuyen, DA NHAN HANG---------------
    $("#clh").addClass('btn-success');
    if($("#clh").prop("disabled") ==true)
    {
      $('#clh').prop("disabled",false);
    }else{
      $("#clh").prop("disabled",true);
      $("#clh").removeClass('btn-success');
    };
    $("#dvc").addClass('btn-success');
    if($("#dvc").prop("disabled") ==true)
    {
      $('#dvc').prop("disabled",false);
    }else{
      $("#dvc").prop("disabled",true);
      $("#dvc").removeClass('btn-success');
    };
    $('#dnh').addClass('btn-success');
    if($("#dnh").prop("disabled") ==true)
    {
      $('#dnh').prop("disabled",false);
    }else{
      $("#dnh").prop("disabled",true);
      $("#dnh").removeClass('btn-success');
    };
    // --------------END bat nut cho lay hang,dang van chuyen, DA NHAN HANG-----------------------------------

    // ---------------START tat cac chuc nang khac------------------------------------------------------------
    $('#dhht').css({
      background: '',
      color: 'black'
    });
    $('#dhsc').css({
      background:'',
      color: 'black'
    });
    $('#ch').removeClass('btn-danger');
    $("#ch").prop("disabled",true);
    $('#dnl').removeClass('btn-info');
    $("#dnl").prop("disabled",true);
    $('#kn').removeClass('btn-danger');
    $("#kn").prop("disabled",true);
    $('#dnt').removeClass('btn-info');
    $("#dnt").prop("disabled",true);
// ---------------END tat cac chuc nang khac------------------------------------------------------------------------
});
//END click DHVC thì tắt các chức năng khác---------------------------------------------------------------------------------

//START click DHHT thì tắt các chức năng khác---------------------------------------------------------------------------------
$('#dhht').on('click',function()
{
    $(this).css({
      background: '#4CAF50',
      color: 'white'
    });
    $('#dhsc').css({
      background:'',
      color: 'black'
    });
    // ---------------START tat cac chuc nang khac------------------------------------------------------------
    $('#ch').removeClass('btn-danger');
    $("#ch").prop("disabled",true);
    $('#kn').removeClass('btn-danger');
    $("#kn").prop("disabled",true);

    $('#dhvc').css({
      background:'',
      color: 'black'
    });
    $('#clh').removeClass('btn-success');
    $("#clh").prop("disabled",true);
    $('#dvc').removeClass('btn-success');
    $("#dvc").prop("disabled",true);
    $('#dnh').removeClass('btn-success');
    $("#dnh").prop("disabled",true);
    // ---------------END tat cac chuc nang khac------------------------------------------------------------

    // --------------START bat nut DA NHAN LAI, DA NHAN TIEN-----------------------------------
    $('#dnl').addClass('btn-info');
    if($("#dnl").prop("disabled") ==true)
    {
      $('#dnl').prop("disabled",false);
    }else{
      $("#dnl").prop("disabled",true);
      $("#dnl").removeClass('btn-info');
    };
    $('#dnt').addClass('btn-info');
    if($("#dnt").prop("disabled") ==true)
    {
      $('#dnt').prop("disabled",false);
    }else{
      $("#dnt").prop("disabled",true);
      $("#dnt").removeClass('btn-info');
    };
    // --------------END bat nut DA NHAN LAI, DA NHAN TIEN-----------------------------------
});
//END click DHHT thì tắt các chức năng khác---------------------------------------------------------------------------------

//START click DHSC thì tắt các chức năng khác---------------------------------------------------------------------------------
$('#dhsc').on('click', function(event)
{
    $('.labels').addClass('label-danger');
    $(this).css({
      background:'#585858',
      color: 'white'
    });
    // --------------START bat nut CHUYEN HOAN, KHIEU NAI-----------------------------------
    $('#ch').addClass('btn-danger');
    if($("#ch").prop("disabled") ==true)
    {
      $('#ch').prop("disabled",false);
    }else{
      $("#ch").prop("disabled",true);
      $("#ch").removeClass('btn-danger');
    };

    $('#kn').addClass('btn-danger');
    if($("#kn").prop("disabled") ==true)
    {
      $('#kn').prop("disabled",false);
    }else{
      $("#kn").prop("disabled",true);
      $("#kn").removeClass('btn-danger');
    };
    // --------------END bat nut CHUYEN HOAN, KHIEU NAI-----------------------------------
    $('#dhvc').css({
      background:'',
      color: 'black'
    });
    // ---------------START tat cac chuc nang khac------------------------------------------------------------
    $('#clh').removeClass('btn-success');
    $("#clh").prop("disabled",true);
    $('#dvc').removeClass('btn-success');
    $("#dvc").prop("disabled",true);
    $('#dhht').css({
      background: '',
      color: 'black'
    });
    $('#dnh').removeClass('btn-success');
    $("#dnh").prop("disabled",true);
    $('#dnl').removeClass('btn-info');
    $("#dnl").prop("disabled",true);
    $('#dnt').removeClass('btn-info');
    $("#dnt").prop("disabled",true);
    // ---------------END tat cac chuc nang khac------------------------------------------------------------
});
//END click DHSC thì tắt các chức năng khác---------------------------------------------------------------------------------