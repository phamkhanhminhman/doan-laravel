 var app = angular.module('myApp',['ngMaterial']);
 app.controller('MyController',  function($scope,$http,$mdToast, $location)
 {
  $scope.tasks = [{id:1,'name':'test1'}, {id:2,'name':'test2'}, {id:3,'name':'test3'}];
    
  $scope.pagiIndex = [];

  for (var i = 0; i < $scope.count_all; i++) {
    $scope.pagiIndex.push()
  }


  var absUrl = $location.absUrl();

  var url_string = absUrl; //window.location.href
  var url = new URL(url_string);
  var c = url.searchParams.get("limit");
  console.log('123123123123123');
  console.log(c);



  $scope.page = 1;
  $scope.pagination = function (page, limit){
    console.log(page);
    $scope.page = page;
    console.log(limit);
    console.log(123123123123123);
  }






    $http.get('http://127.0.0.1:8000/admin/best-selling').       then(function(res){$scope.all  =res.data;},function(res){});
  //START AUTO GET ORDER RA DS DON HANG----------------------------------------------------------------------------------------------
    $http.get('http://127.0.0.1:8000/admin/api-order-all').       then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').     then(function(res){$scope.allv2=res.data;},function(res){});
    //COUNT SỐ LOẠI ĐƠN THEO orderStatus----------------------------------------
    $http.get('http://127.0.0.1:8000/admin/count-order-all').     then(function(res){$scope.count_all     =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-ship-and-received').then(function(res){$scope.count_ship_and_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-shipping').then(function(res){$scope.count_shipping=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-received').then(function(res){$scope.count_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done_and_returnok').then(function(res){$scope.count_done_and_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done').    then(function(res){$scope.count_done    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returnok').    then(function(res){$scope.count_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning-and-complain').    then(function(res){$scope.count_returning_and_complain    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning').    then(function(res){$scope.count_returning    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-complain').    then(function(res){$scope.count_complain    =res.data;},function(res){});
    //COUNT SỐ LOẠI ĐƠN THEO orderStatus----------------------------------------
  //END AUTO GET ORDER RA DS DON HANG----------------------------------------------------------------------------------------------


$scope.searchFull = function($event)
{
  var keyCode = $event.which || $event.keyCode;
  if (keyCode === 13) {

   console.log('search');
  }
}






  //START SELECT ĐƠN VỊ GIAO HÀNG----------------------------------------------------------------------------------------------------
  $scope.shipping=function()
  {
    var data=$.param({
    xyz:$scope.xyz, 
     }); 
    console.log(data);
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-selected-orderShip',data,config)
   .then(function(res)
    {
        $scope.all=res.data;
        console.log("update thcong "+$scope.nhieunguoi);
    }, 
    function(res){if(res.data=="thatbai"){console.log("update thatbai ")} });
  }
  //END SELECT ĐƠN VỊ GIAO HÀNG----------------------------------------------------------------------------------------------------

  //START SELECT TRẠNG THÁI ĐƠN HÀNG----------------------------------------------------------------------------------------------------
  $scope.order_status=function()
  {
    var data=$.param({
    xyz:$scope.orderStatus, 
     }); 
    console.log(data);
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-selected-orderStatus',data,config)
   .then(function(res)
    {
        $scope.all=res.data;
        console.log("update thcong "+$scope.nhieunguoi);
    }, 
    function(res){if(res.data=="thatbai"){console.log("update thatbai ")} });
  }
  //END SELECT TRẠNG THÁI ĐƠN HÀNG----------------------------------------------------------------------------------------------------

  //START GET ORDER RA DS DON HANG-------------------------------------------------------------------------------------------------
  $scope.get_all= function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-all').  then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res){$scope.allv2=res.data;},function(res){});  
  }
  //END GET ORDER RA DS DON HANG--------------------------------------------------------------------------------------------------

  //START GET ORDER VOI STATUS=SHIPPING,RECEIVED-------------------------------------------------------------------------------------------
  $scope.get_dhvc=function()
  {
    console.log($scope.display);
    if ($scope.display == true ) {
      $scope.display = !$scope.display;
    }
    $http.get('http://127.0.0.1:8000/admin/api-order-dhvc'). then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res){$scope.allv2=res.data;},function(res){});
  }
  //END GET ORDER VOI STATUS=SHIPPING,RECEIVED--------------------------------------------------------------------------------------------

  //START GET ORDER VOI STATUS=SHIPPING,-------------------------------------------------------------------------------------------
  $scope.get_shipping=function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-shipping'). then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res){$scope.allv2=res.data;},function(res){});
  }
  //END GET ORDER VOI STATUS=SHIPPING,--------------------------------------------------------------------------------------------

  //START GET ORDER VOI STATUS=Received------------------------------------------------------------------------------------------
  $scope.get_dnh=function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-dnh').  then(function(res){$scope.all  =res.data;}, function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
      {
        $scope.allv2=res.data;
        $('.labels').addClass('label-primary');
      },function(res){});
  }
  //END GET ORDER VOI STATUS=Received--------------------------------------------------------------------------------------------

  //START GET ORDER VOI STATUS=Done------------------------------------------------------------------------------------------
  $scope.get_dnt=function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-dnt').  then(function(res){$scope.all  =res.data;}, function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
      {
        $scope.allv2=res.data;
        $('.labels').addClass('label-info');
      },function(res){});
  }
  //END GET ORDER VOI STATUS=Done--------------------------------------------------------------------------------------------

  //START GET ORDER VOI STATUS=ReturnOK------------------------------------------------------------------------------------------
  $scope.get_dnl=function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-dnl').  then(function(res){$scope.all  =res.data;}, function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
      {
        $scope.allv2=res.data;
        $('.labels').addClass('label-info');
      },function(res){});
  }
  //END GET ORDER VOI STATUS=ReturnOK--------------------------------------------------------------------------------------------

  //START GET ORDER VOI STATUS=DONE----------------------------------------------------------------------------------------------
  $scope.get_dhht=function()
  {
    console.log($scope.display);
    $scope.display=!$scope.display;
    $http.get('http://127.0.0.1:8000/admin/api-order-dhht'). then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
      {
        $scope.allv2=res.data;
        $('.labels').addClass('label-success');
      },function(res){});
  }
  //END GET ORDER VOI STATUS=DONE-------------------------------------------------------------------------------------------
  
  //START GET ORDER VOI STATUS=RETURNING, COMPLAIN----------------------------------------------------------------------------------------------
  $scope.get_dhsc=function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-dhsc'). then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
      {
        $scope.allv2=res.data;
        $('.labels').addClass('label-danger');
      },function(res){});
  }
  //END GET ORDER VOI STATUS=RETURNING, COMPLAIN-------------------------------------------------------------------------------------------

  //START GET ORDER VOI STATUS=RETURNING,----------------------------------------------------------------------------------------------
  $scope.get_ch=function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-ch'). then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
      {
        $scope.allv2=res.data;
        $('.labels').addClass('label-danger');
      },function(res){});
  }
  //END GET ORDER VOI STATUS=RETURNING,------------------------------------------------------------------------------------------

   //START GET ORDER VOI STATUS=RETURNING,----------------------------------------------------------------------------------------------
  $scope.get_kn=function()
  {
    $http.get('http://127.0.0.1:8000/admin/api-order-kn'). then(function(res){$scope.all  =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
      {
        $scope.allv2=res.data;
        $('.labels').addClass('label-danger');
      },function(res){});
  }
  //END GET ORDER VOI STATUS=RETURNING,------------------------------------------------------------------------------------------  

  //START CLICK button DHVC de change status SHIPPING->Received và return số lượng sp-------------------------------------------------------------------
  $scope.changeOrderStatus= function(nguoi)
  {
       var data=$.param({
       dnh:nguoi.orderID,
  });
    console.log(data);  
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-change-orderStatus',data,config).then(function(res){$scope.all=res.data;},function(res){});
   $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
    {
      $scope.allv2=res.data;
      $('.labels').addClass('label-primary');   
    },function(res){});
   
   $http.get('http://127.0.0.1:8000/admin/count-order-all').     then(function(res){$scope.count_all     =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-ship-and-received').then(function(res){$scope.count_ship_and_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-shipping').then(function(res){$scope.count_shipping=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-received').then(function(res){$scope.count_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done_and_returnok').then(function(res){$scope.count_done_and_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done').    then(function(res){$scope.count_done    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returnok').    then(function(res){$scope.count_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning-and-complain').    then(function(res){$scope.count_returning_and_complain    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning').    then(function(res){$scope.count_returning    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-complain').    then(function(res){$scope.count_complain    =res.data;},function(res){}); 
  }
 // END CLICK button DHVC de change status------------------------------------------------------------------------------

 //START CLICK button DHVC de change status SHIPPING->Done và return số lượng sp-------------------------------------------------------------------
  $scope.changeOrderStatusv2= function(nguoi)
  {
       var data=$.param({
       dnh:nguoi.orderID,
  });
    console.log(data);  
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-change-orderStatusv2',data,config).then(function(res)
    {
        $scope.all=res.data;
        console.log("update thcong "+$scope.all);   
    },function(res){});
   $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
    {
      $scope.allv2=res.data;
      $('.labels').addClass('label-info');   
    },function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-all').     then(function(res){$scope.count_all     =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-ship-and-received').then(function(res){$scope.count_ship_and_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-shipping').then(function(res){$scope.count_shipping=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-received').then(function(res){$scope.count_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done_and_returnok').then(function(res){$scope.count_done_and_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done').    then(function(res){$scope.count_done    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returnok').    then(function(res){$scope.count_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning-and-complain').    then(function(res){$scope.count_returning_and_complain    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning').    then(function(res){$scope.count_returning    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-complain').    then(function(res){$scope.count_complain    =res.data;},function(res){});
  }
 // END CLICK button DHVC de change status------------------------------------------------------------------------------

 //START CLICK button DHSC de change status RETURNING và return số lượng sp-------------------------------------------------------------------
 $scope.changeOrderStatusv3= function(nguoi)
 {  
    console.log('Don hang su co');
    var data=$.param({
      dnh:nguoi.orderID,
    });
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-change-orderStatusv3',data,config).then(function(res)
    {
        $scope.all=res.data;
        console.log("update thcong "+$scope.all);   
    },function(res){});
   $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
    {
      $scope.allv2=res.data;
      $('.labels').addClass('label-danger');   
    },function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-all').     then(function(res){$scope.count_all     =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-ship-and-received').then(function(res){$scope.count_ship_and_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-shipping').then(function(res){$scope.count_shipping=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-received').then(function(res){$scope.count_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done_and_returnok').then(function(res){$scope.count_done_and_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done').    then(function(res){$scope.count_done    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returnok').    then(function(res){$scope.count_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning-and-complain').    then(function(res){$scope.count_returning_and_complain    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning').    then(function(res){$scope.count_returning    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-complain').    then(function(res){$scope.count_complain    =res.data;},function(res){});
 } 
  //END CLICK button DHSC de change status RETURNING và return số lượng sp-------------------------------------------------------------------
 
 //START CLICK button DHSC de change status COMPLAIN và return số lượng sp-------------------------------------------------------------------
 $scope.changeOrderStatusv4= function(nguoi)
 {  
    var data=$.param({
      dnh:nguoi.orderID,
    });
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-change-orderStatusv4',data,config).then(function(res)
    {
        $scope.all=res.data;
        console.log("update thcong "+$scope.all);   
    },function(res){});
   $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
    {
      $scope.allv2=res.data;
      $('.labels').addClass('label-danger');   
    },function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-all').     then(function(res){$scope.count_all     =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-ship-and-received').then(function(res){$scope.count_ship_and_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-shipping').then(function(res){$scope.count_shipping=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-received').then(function(res){$scope.count_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done_and_returnok').then(function(res){$scope.count_done_and_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done').    then(function(res){$scope.count_done    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returnok').    then(function(res){$scope.count_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning-and-complain').    then(function(res){$scope.count_returning_and_complain    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning').    then(function(res){$scope.count_returning    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-complain').    then(function(res){$scope.count_complain    =res.data;},function(res){});
 } 
  //END CLICK button DHSC de change status COMPLAIN và return số lượng sp-------------------------------------------------------------------

//START CLICK button DHSC de change status RETURNOK và return số lượng sp-------------------------------------------------------------------
 $scope.changeOrderStatusv5= function(nguoi)
 {  
    var data=$.param({
      dnh:nguoi.orderID,
    });
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-change-orderStatusv5',data,config).then(function(res)
    {
        $scope.all=res.data;
        console.log("update thcong "+$scope.all);   
    },function(res){});
   $http.get('http://127.0.0.1:8000/admin/api-order-allv2').then(function(res)
    {
      $scope.allv2=res.data;
      $('.labels').addClass('label-info');   
    },function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-all').     then(function(res){$scope.count_all     =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-ship-and-received').then(function(res){$scope.count_ship_and_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-shipping').then(function(res){$scope.count_shipping=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-received').then(function(res){$scope.count_received=res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done_and_returnok').then(function(res){$scope.count_done_and_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-done').    then(function(res){$scope.count_done    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returnok').    then(function(res){$scope.count_returnok    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning-and-complain').    then(function(res){$scope.count_returning_and_complain    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-returning').    then(function(res){$scope.count_returning    =res.data;},function(res){});
    $http.get('http://127.0.0.1:8000/admin/count-order-complain').    then(function(res){$scope.count_complain    =res.data;},function(res){});
  } 
  //END CLICK button DHSC de change status RETURNOK và return số lượng sp-------------------------------------------------------------------
  $scope.editOrder = function (nguoi)
  {
     var data=$.param({
      orderID:nguoi.orderID,
      orderShipID: nguoi.orderShipID,
      orderShip: nguoi.orderShip,
      customerID: nguoi.customerID,
    });
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/api-edit-order',data,config).then(function(res)
    {
        
        console.log("update thcong ");   
    },function(res){}); 
  }













 //START GET COST PHAN ADD PRODUCT
  $scope.changestatus= function(req)
  {
       var data=$.param({
       aaa:$scope.aaa,    
  });
    console.log("status"+data);  
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/product-get-cost',data,config).then(function(res){$scope.nhieunguoi=res.data;},function(res){});
  }
 //GET COST PHAN ADD PRODUCT

 //START PHAN GET QUAN HUYEN-------------------------------------------------------------------------------------------------
 $scope.changeorder= function(req)
 {
    var data=$.param({
        bbb:$scope.bbb, 
  });   
    console.log(data);  
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/order-api-quan',data,config)
   .then(function(res)
    {
        $scope.quanhuyen=res.data;
        console.log("update thcong "+$scope.quanhuyen);
      
    }, 
    function(res){if(res.data=="thatbai"){console.log("update thatbai ")} });

 }
 //END GET QUAN HUYEN THEO THANH PHO PHAN ORDER ADD------------------------------------------------------------------------------
 $scope.selectproduct= function(req)
 {
       var data=$.param({
           ccc:$scope.ccc, 
  });
    
    console.log(data);  
    var config={
      headers:{
       'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
     }
   }
   $http.post('http://127.0.0.1:8000/admin/order-api-product',data,config)
   .then(function(res)
    {
        $scope.product=res.data;
        console.log("update thcong "+$scope.product);
      
    }, 
    function(res){if(res.data=="thatbai"){console.log("update thatbai ")} });

 }

$scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
      }
      $scope.hienthi="true";
      $scope.doigiatri=function(){
    $scope.hienthi=!$scope.hienthi;//check angular
  }
  $scope.hienra=function(motnguoi){
   motnguoi.hienthi=!motnguoi.hienthi; 
 }
 console.log("script angular");
 // $http.get("http://127.0.0.1:8000/admin/get-data-api").then(function(res){ //get data json
 //   $scope.nhieunguoi=res.data;
 //   console.log("api data la "+res.data);

 // });
 $scope.luudulieu= function(req){
   var data=$.param({
    so:req.so,
    gia:req.gia,  
    loai:req.loai,
    
  });
   console.log(data);

   $scope.showSimpleToast(); 
   var config={
    headers:{
     'content-type':'application/x-www-form-urlencoded;charset=UTF-8'
   }
 }
 console.log("da lay dc data ->>");
 $http.post('http://127.0.0.1/post',data,config)
 .then(function(res)
  {if(res.data=="thanhcong"){
    console.log("update thcong ");
    $scope.showSimpleToast(); 
  }}, 
  function(res){if(res.data=="thatbai"){console.log("update thatbai ")} });

}
// var last = {
//   bottom: true,
//   top: false,
//   left: false,
//   right: true
// };

// $scope.toastPosition = angular.extend({},last);

// $scope.getToastPosition = function() {
//   sanitizePosition();

//   return Object.keys($scope.toastPosition)
//   .filter(function(pos) { return $scope.toastPosition[pos]; })
//   .join(' ');
// };

// function sanitizePosition() {
//   var current = $scope.toastPosition;

//   if ( current.bottom && last.top ) current.top = false;
//   if ( current.top && last.bottom ) current.bottom = false;
//   if ( current.right && last.left ) current.left = false;
//   if ( current.left && last.right ) current.right = false;

//   last = angular.extend({},current);
// }

// $scope.showSimpleToast = function() {
//   var pinTo = $scope.getToastPosition();

//   $mdToast.show(
//     $mdToast.simple()
//     .textContent('update thanh cong')
//     .position(pinTo )
//     .hideDelay(3000)
//     );
// };



})

 