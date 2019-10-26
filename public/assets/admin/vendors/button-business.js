//click tất cả thì tắt các chức năng khác---------------------------------------------------------------------------------
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
    disableAll();
});

//click DHVC thì tắt các chức năng khác---------------------------------------------------------------------------------
$("#dhvc").on('click', function()
{
    $(this).css({
      background: '#007DBD',
      color: 'white'
    });
    // bat nut cho lay hang,dang van chuyen,
    button_cholayhang();
    button_dangvanchuyen();

    // tat cac chuc nang khac------------------------------------------------------------
    $('#dhht').css({
      background: '',
      color: 'black'
    });
    $('#dhsc').css({
      background:'',
      color: 'black'
    });
   
    disable_dnl();
    disable_kn();
    disable_dnt();
    disable_dnh();
    disable_ch();
});

//click DHHT thì tắt các chức năng khác---------------------------------------------------------------------------------
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
    // tat cac chuc nang khac------------------------------------------------------------
    disable_ch();
    disable_kn();

    $('#dhvc').css({
      background:'',
      color: 'black'
    });

    disable_clh();
    disable_dvc();
    disable_dnl();

    //bat nut DA NHAN LAI, DA NHAN TIEN-----------------------------------
    // button_danhanlai();
    button_danhantien();
    button_danhanhang();
});

//START click DHSC thì tắt các chức năng khác---------------------------------------------------------------------------------
$('#dhsc').on('click', function(event)
{
    // $('.labels').addClass('label-danger');
    $(this).css({
      background:'#585858',
      color: 'white'
    });
    // --------------START bat nut CHUYEN HOAN, KHIEU NAI-----------------------------------
    button_danhanlai();
    button_chuyenhoan();
    button_khieunai();
    // --------------END bat nut CHUYEN HOAN, KHIEU NAI-----------------------------------
    $('#dhvc').css({
      background:'',
      color: 'black'
    });
    // ---------------START tat cac chuc nang khac------------------------------------------------------------
    disable_clh();
    disable_dvc();
    $('#dhht').css({
      background: '',
      color: 'black'
    });
    disable_dnh();
    disable_dnt();

    // ---------------END tat cac chuc nang khac------------------------------------------------------------
});
//END click DHSC thì tắt các chức năng khác---------------------------------------------------------------------------------













function button_cholayhang() {
  $("#clh").addClass('btn-success');
  if($("#clh").prop("disabled") ==true)
  {
    $('#clh').prop("disabled",false);
  }else{
    $("#clh").prop("disabled",true);
    $("#clh").removeClass('btn-success');
  };
}

function button_dangvanchuyen() {
  $("#dvc").addClass('btn-success');
  if($("#dvc").prop("disabled") ==true)
  {
    $('#dvc').prop("disabled",false);
  }else{
    $("#dvc").prop("disabled",true);
    $("#dvc").removeClass('btn-success');
  };
}

function button_danhanhang() {
  $('#dnh').addClass('btn-success');
  if($("#dnh").prop("disabled") ==true)
  {
    $('#dnh').prop("disabled",false);
  }else{
    $("#dnh").prop("disabled",true);
    $("#dnh").removeClass('btn-success');
  };
}

function button_danhantien() {
  $('#dnt').addClass('btn-success');
  if($("#dnt").prop("disabled") ==true)
  {
    $('#dnt').prop("disabled",false);
  }else{
    $("#dnt").prop("disabled",true);
    $("#dnt").removeClass('btn-success');
  };
}

function button_danhanlai() {
  $('#dnl').addClass('btn-danger');
  if($("#dnl").prop("disabled") ==true)
  {
    $('#dnl').prop("disabled",false);
  }else{
    $("#dnl").prop("disabled",true);
    $("#dnl").removeClass('btn-danger');
  };
}

function button_chuyenhoan() {
  $('#ch').addClass('btn-danger');
  if($("#ch").prop("disabled") ==true)
  {
    $('#ch').prop("disabled",false);
  }else{
    $("#ch").prop("disabled",true);
    $("#ch").removeClass('btn-danger');
  };
}

function button_khieunai() {
  $('#kn').addClass('btn-danger');
    if($("#kn").prop("disabled") ==true)
    {
      $('#kn').prop("disabled",false);
    }else{
      $("#kn").prop("disabled",true);
      $("#kn").removeClass('btn-danger');
    };
}

function disable_clh() {
  $('#clh').removeClass('btn-success');
  $("#clh").prop("disabled",true);
}

function disable_dvc() {
  $('#dvc').removeClass('btn-success');
  $("#dvc").prop("disabled",true);     
}

function disable_dnh() {
  $('#dnh').removeClass('btn-success');
  $("#dnh").prop("disabled",true);
}

function disable_dnt() {
  $('#dnt').removeClass('btn-success');
  $("#dnt").prop("disabled",true);
}

function disable_dnl() {
  $('#dnl').removeClass('btn-danger');
  $("#dnl").prop("disabled",true);
}

function disable_kn() {
  $('#kn').removeClass('btn-danger');
  $("#kn").prop("disabled",true);
}

function disable_ch() {
  $('#ch').removeClass('btn-danger');
  $("#ch").prop("disabled",true);
}

function disableAll() {
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
  $('#dnt').removeClass('btn-success');
  $("#dnt").prop("disabled",true);
  $('#dnl').removeClass('btn-info');
  $("#dnl").prop("disabled",true);
}