var app = angular.module('myApp', ['ngMaterial', 'chieffancypants.loadingBar', 'ngAnimate']).config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  });
app.controller('MyController', function ($scope, $http, $mdToast, $location, $timeout, cfpLoadingBar) {

  pageIndex = 1;
  $scope.pageLimit = 10;

  var absUrl = $location.absUrl();
  var host   = $location.host();
  var port   = $location.port();
  $scope.baseURL = 'http://' + host + ':' + port;
  // var url_string = absUrl; //window.location.href
  // var url = new URL(url_string);
  // var c = url.searchParams.get("limit");
  // console.log(c);
  
  // PAGINATION---------------------------------------------------------------------------------------------------------------------------------
  $scope.page = 1;
  $scope.orderStatus = '';
  $scope.pagination = function (page, limit) {
  
    if ($scope.orderStatus === '') {
      $scope.page = page;
      $http.get($scope.baseURL + '/admin/api-order-all?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; });
    }

    if ($scope.orderStatus === 8) {
      $scope.page = page;
      $http.get($scope.baseURL + '/admin/api-order-dhht?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; });
    }

    if ($scope.orderStatus === 13) {
      $scope.page = page;
      $http.get($scope.baseURL + '/admin/api-order-dhsc?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; });
    }
  }

  $http.get($scope.baseURL + '/admin/best-selling').then(function (res) { $scope.all = res.data; });


  //START AUTO GET ORDER RA DS DON HANG----------------------------------------------------------------------------------------------
  $http.get($scope.baseURL + '/sendo/add-new-order').then(function (res) { toastr.success('Có ' + res.data + ' order từ SENDO vừa mới đc thêm vào')});
  $http.get($scope.baseURL + '/shopee/add').then(function(res) { toastr.success('Có ' + res.data + ' order từ SHOPEE vừa mới đc thêm vào')})

  $http.get($scope.baseURL + '/admin/api-order-all?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data;});
  $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { $scope.count_all = res.data; arrayPage(res.data)});
  $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) { $scope.allv2 = res.data; });

  //COUNT SỐ LOẠI ĐƠN THEO orderStatus------------------------------------------------------------------------------------------------------------
  // arrayPage();
  function arrayPage($arrayLength) {
    console.log($arrayLength);
    $scope.arrayPageIndex = [];
      console.log($scope.count_all);
      if ($arrayLength < 10) {
        $arrayLength = 10;
      }
      let totalPage = Math.ceil($arrayLength/ $scope.pageLimit);
      for (var i = 1; i <= totalPage; i++) {
        arrayText = { id: i, }
        $scope.arrayPageIndex.push(arrayText);
      }
  }
  
  $http.get($scope.baseURL + '/admin/count-order-shipping-ready').then(function (res) { $scope.count_ship_and_received = res.data; });
  $http.get($scope.baseURL + '/admin/count-order-shipping').then(function (res) { $scope.count_shipping = res.data; });
  
  // $http.get($scope.baseURL + '/admin/count-order-done_and_returnok').then(function (res) { $scope.count_done_and_returnok = res.data; }, function (res) { });
  // $http.get($scope.baseURL + '/admin/count-order-done').then(function (res) { $scope.count_done = res.data; }, function (res) { });
  $http.get($scope.baseURL + '/admin/count-order-returnok').then(function (res) { $scope.count_returnok = res.data; }, function (res) { });
  $http.get($scope.baseURL + '/admin/count-order-returning-and-complain').then(function (res) { $scope.count_returning_and_complain = res.data; });
  $http.get($scope.baseURL + '/admin/count-order-returning').then(function (res) { $scope.count_returning = res.data; });
  $http.get($scope.baseURL + '/admin/count-order-complain').then(function (res) { $scope.count_complain = res.data; });
  

  $http.get($scope.baseURL + '/admin/count-order-completed').then(function (res) { $scope.count_done = res.data; });
  $http.get($scope.baseURL + '/admin/count-order-received').then(function (res) { 
    $scope.count_received = res.data; 
    $scope.count_completed_received = parseInt($scope.count_done) + parseInt(res.data) 
  });

  $http.get($scope.baseURL + '/admin/count-order-cancle-return').then(function (res) { $scope.count_cancle_return = res.data });
  

  //END AUTO GET ORDER RA DS DON HANG------------------------------------------------------------------------------------------------------------------


  // SEARCH ORDER IN DATABASE---------------------------------------------------------------------------------------------------------------------------
  $scope.searchFull = function ($event) {
    var keyCode = $event.which || $event.keyCode;
    if (keyCode === 13) {
      
      console.log($event.target.value);
      if ($event.target.value !== '') {
        $http.get($scope.baseURL + '/admin/search-order?orderNumber=' + $event.target.value ).then(function (res) { $scope.all = res.data; arrayPage(res.data.length);});
         
      } else {
        $http.get($scope.baseURL + '/admin/api-order-all?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; });
        $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { arrayPage(res.data)});
      }
    }
  }

  //UPDATE ORDER EXCEPT ORDER SENDO STATUS = 8-----------------------------------------------------------------------------------------------------------------
  $scope.updateExceptDone = function () {
    $http.get($scope.baseURL + '/sendo/update-order-except-done').then(
      function (res) { 
        toastr.success('Có ' + res.data + ' order của SENDO vừa cập nhật trạng thái mới'); 
    });

    $http.get($scope.baseURL + '/shopee/update-order-except-done').then(
      function (res) {
        toastr.success('Có ' + res.data + ' order của SHOPEE vừa cập nhật trạng thái mới'); 
      }
    )
  }

  $scope.confirmOrderSendo = function (orderID, orderShopID) {
    $http.get($scope.baseURL + '/sendo/confirm-order-sendo/' + orderID + '/' + orderShopID).then(
      function (res) { 
        toastr.success('Đơn hàng Sen Đỏ ' + orderID + ' đã được xác nhận'); 
    });
  }

  $scope.cancelOrder = function (orderID){
    console.log(orderID);
  }

  $scope.orderDetailSendo = function (orderLink) {
    window.open(orderLink);;
  }



  //SELECT CHANNEL---------------------------------------------------------------------------------------------------------------------------------------
  $scope.channel = function () {
    var data = $.param({
      xyz: $scope.xyz,
    });
    console.log(data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-selected-channel?page=' + $scope.page + '&limit=' + $scope.pageLimit, data, config)
      .then(function (res) {
        $scope.all = res.data;
      });

    if ($scope.xyz !== "Shopee") {
      $http.get($scope.baseURL + '/admin/count-order-sendo').then(function (res) { arrayPage(res.data) });  
    } else {
      $http.get($scope.baseURL + '/admin/count-order-shopee').then(function (res) { arrayPage(res.data) });
    }
  }

  //START SELECT ĐƠN VỊ GIAO HÀNG----------------------------------------------------------------------------------------------------
  $scope.shipping = function () {
    var data = $.param({
      xyz: $scope.xyz,
    });
    console.log(data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-selected-orderShip', data, config)
      .then(function (res) {
        $scope.all = res.data;
        console.log("update thcong " + $scope.nhieunguoi);
      },
        function (res) { if (res.data == "thatbai") { console.log("update thatbai ") } });
  }

  //START SELECT TRẠNG THÁI ĐƠN HÀNG----------------------------------------------------------------------------------------------------
  $scope.order_status = function () {
    var data = $.param({
      xyz: $scope.orderStatus,
    });
    console.log(data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-selected-orderStatus', data, config)
      .then(function (res) {
        $scope.all = res.data;
        console.log("update thcong " + $scope.nhieunguoi);
      },
        function (res) { if (res.data == "thatbai") { console.log("update thatbai ") } });
  }
  //END SELECT TRẠNG THÁI ĐƠN HÀNG----------------------------------------------------------------------------------------------------

  //START GET ORDER RA DS DON HANG-------------------------------------------------------------------------------------------------
  $scope.get_all = function () {
    $scope.orderStatus = '';
    $http.get($scope.baseURL + '/admin/api-order-all?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; });
    $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { arrayPage(res.data)});
  }

  //START GET ORDER VOI STATUS=SHIPPING,RECEIVED-------------------------------------------------------------------------------------------
  $scope.get_dhvc = function () {
    console.log($scope.display);
    if ($scope.display == true) {
      $scope.display = !$scope.display;
    }
    $http.get($scope.baseURL + '/admin/count-order-shipping-ready').then(function (res) { arrayPage(res.data)});
    $http.get($scope.baseURL + '/admin/api-order-dhvc?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; }, function (res) { });
  }

  //START GET ORDER VOI STATUS=SHIPPING,-------------------------------------------------------------------------------------------
  $scope.get_shipping = function () {
    $http.get($scope.baseURL + '/admin/api-order-shipping').then(function (res) { $scope.all = res.data; });
  }
  
  //START GET ORDER VOI STATUS=DONE----------------------------------------------------------------------------------------------
  $scope.get_dhht = function () {
    $scope.orderStatus = 8;
    console.log($scope.display);
    $scope.display = !$scope.display;
    $http.get($scope.baseURL + '/admin/api-order-dhht?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; });
    $http.get($scope.baseURL + '/admin/count-order-completed-received').then(function (res) { arrayPage(res.data) }, function (res) { });
  }

  //START GET ORDER VOI STATUS=RETURNING, COMPLAIN----------------------------------------------------------------------------------------------
  $scope.get_dhsc = function () {
    $scope.orderStatus = 13;
    $http.get($scope.baseURL + '/admin/api-order-dhsc?page=' + $scope.page + '&limit=' + $scope.pageLimit).then(function (res) { $scope.all = res.data; });
    $http.get($scope.baseURL + '/admin/count-order-cancle-return').then(function (res) { arrayPage(res.data) }, function (res) { });
  }




























  //START GET ORDER VOI STATUS=Received------------------------------------------------------------------------------------------
  $scope.get_dnh = function () {
    $http.get($scope.baseURL + '/admin/api-order-dnh').then(function (res) { $scope.all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-primary');
    }, function (res) { });
  }


  //START GET ORDER VOI STATUS=Done------------------------------------------------------------------------------------------
  $scope.get_dnt = function () {
    $http.get($scope.baseURL + '/admin/api-order-dnt').then(function (res) { $scope.all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-info');
    }, function (res) { });
  }


  //START GET ORDER VOI STATUS=ReturnOK------------------------------------------------------------------------------------------
  $scope.get_dnl = function () {
    $http.get($scope.baseURL + '/admin/api-order-dnl').then(function (res) { $scope.all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-info');
    }, function (res) { });
  }


  //START GET ORDER VOI STATUS=RETURNING,----------------------------------------------------------------------------------------------
  $scope.get_ch = function () {
    $http.get($scope.baseURL + '/admin/api-order-ch').then(function (res) { $scope.all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-danger');
    }, function (res) { });
  }


  //START GET ORDER VOI STATUS=RETURNING,----------------------------------------------------------------------------------------------
  $scope.get_kn = function () {
    $http.get($scope.baseURL + '/admin/api-order-kn').then(function (res) { $scope.all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-danger');
    }, function (res) { });
  }


  //START CLICK button DHVC de change status SHIPPING->Received và return số lượng sp-------------------------------------------------------------------
  $scope.changeOrderStatus = function (nguoi) {
    var data = $.param({
      dnh: nguoi.orderID,
    });
    console.log(data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-change-orderStatus', data, config).then(function (res) { $scope.all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-primary');
    }, function (res) { });

    $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { $scope.count_all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-ship-and-received').then(function (res) { $scope.count_ship_and_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-shipping').then(function (res) { $scope.count_shipping = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-received').then(function (res) { $scope.count_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done_and_returnok').then(function (res) { $scope.count_done_and_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done').then(function (res) { $scope.count_done = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returnok').then(function (res) { $scope.count_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning-and-complain').then(function (res) { $scope.count_returning_and_complain = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning').then(function (res) { $scope.count_returning = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-complain').then(function (res) { $scope.count_complain = res.data; }, function (res) { });
  }
  // END CLICK button DHVC de change status------------------------------------------------------------------------------

  //START CLICK button DHVC de change status SHIPPING->Done và return số lượng sp-------------------------------------------------------------------
  $scope.changeOrderStatusv2 = function (nguoi) {
    var data = $.param({
      dnh: nguoi.orderID,
    });
    console.log(data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-change-orderStatusv2', data, config).then(function (res) {
      $scope.all = res.data;
      console.log("update thcong " + $scope.all);
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-info');
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { $scope.count_all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-ship-and-received').then(function (res) { $scope.count_ship_and_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-shipping').then(function (res) { $scope.count_shipping = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-received').then(function (res) { $scope.count_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done_and_returnok').then(function (res) { $scope.count_done_and_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done').then(function (res) { $scope.count_done = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returnok').then(function (res) { $scope.count_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning-and-complain').then(function (res) { $scope.count_returning_and_complain = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning').then(function (res) { $scope.count_returning = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-complain').then(function (res) { $scope.count_complain = res.data; }, function (res) { });
  }
  // END CLICK button DHVC de change status------------------------------------------------------------------------------

  //START CLICK button DHSC de change status RETURNING và return số lượng sp-------------------------------------------------------------------
  $scope.changeOrderStatusv3 = function (nguoi) {
    console.log('Don hang su co');
    var data = $.param({
      dnh: nguoi.orderID,
    });
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-change-orderStatusv3', data, config).then(function (res) {
      $scope.all = res.data;
      console.log("update thcong " + $scope.all);
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-danger');
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { $scope.count_all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-ship-and-received').then(function (res) { $scope.count_ship_and_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-shipping').then(function (res) { $scope.count_shipping = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-received').then(function (res) { $scope.count_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done_and_returnok').then(function (res) { $scope.count_done_and_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done').then(function (res) { $scope.count_done = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returnok').then(function (res) { $scope.count_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning-and-complain').then(function (res) { $scope.count_returning_and_complain = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning').then(function (res) { $scope.count_returning = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-complain').then(function (res) { $scope.count_complain = res.data; }, function (res) { });
  }
  //END CLICK button DHSC de change status RETURNING và return số lượng sp-------------------------------------------------------------------

  //START CLICK button DHSC de change status COMPLAIN và return số lượng sp-------------------------------------------------------------------
  $scope.changeOrderStatusv4 = function (nguoi) {
    var data = $.param({
      dnh: nguoi.orderID,
    });
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-change-orderStatusv4', data, config).then(function (res) {
      $scope.all = res.data;
      console.log("update thcong " + $scope.all);
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-danger');
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { $scope.count_all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-ship-and-received').then(function (res) { $scope.count_ship_and_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-shipping').then(function (res) { $scope.count_shipping = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-received').then(function (res) { $scope.count_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done_and_returnok').then(function (res) { $scope.count_done_and_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done').then(function (res) { $scope.count_done = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returnok').then(function (res) { $scope.count_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning-and-complain').then(function (res) { $scope.count_returning_and_complain = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning').then(function (res) { $scope.count_returning = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-complain').then(function (res) { $scope.count_complain = res.data; }, function (res) { });
  }
  //END CLICK button DHSC de change status COMPLAIN và return số lượng sp-------------------------------------------------------------------

  //START CLICK button DHSC de change status RETURNOK và return số lượng sp-------------------------------------------------------------------
  $scope.changeOrderStatusv5 = function (nguoi) {
    var data = $.param({
      dnh: nguoi.orderID,
    });
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-change-orderStatusv5', data, config).then(function (res) {
      $scope.all = res.data;
      console.log("update thcong " + $scope.all);
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/api-order-allv2').then(function (res) {
      $scope.allv2 = res.data;
      $('.labels').addClass('label-info');
    }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-all').then(function (res) { $scope.count_all = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-ship-and-received').then(function (res) { $scope.count_ship_and_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-shipping').then(function (res) { $scope.count_shipping = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-received').then(function (res) { $scope.count_received = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done_and_returnok').then(function (res) { $scope.count_done_and_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-done').then(function (res) { $scope.count_done = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returnok').then(function (res) { $scope.count_returnok = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning-and-complain').then(function (res) { $scope.count_returning_and_complain = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-returning').then(function (res) { $scope.count_returning = res.data; }, function (res) { });
    $http.get($scope.baseURL + '/admin/count-order-complain').then(function (res) { $scope.count_complain = res.data; }, function (res) { });
  }
  //END CLICK button DHSC de change status RETURNOK và return số lượng sp-------------------------------------------------------------------
  $scope.editOrder = function (nguoi) {
    var data = $.param({
      orderID: nguoi.orderID,
      orderShipID: nguoi.orderShipID,
      orderShip: nguoi.orderShip,
      customerID: nguoi.customerID,
    });
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/api-edit-order', data, config).then(function (res) {

      console.log("update thcong ");
    }, function (res) { });
  }













  //START GET COST PHAN ADD PRODUCT
  $scope.changestatus = function (req) {
    var data = $.param({
      aaa: $scope.aaa,
    });
    console.log("status" + data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/product-get-cost', data, config).then(function (res) { $scope.nhieunguoi = res.data; }, function (res) { });
  }
  //GET COST PHAN ADD PRODUCT

  //START PHAN GET QUAN HUYEN-------------------------------------------------------------------------------------------------
  $scope.changeorder = function (req) {
    var data = $.param({
      bbb: $scope.bbb,
    });
    console.log(data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/order-api-quan', data, config)
      .then(function (res) {
        $scope.quanhuyen = res.data;
        console.log("update thcong " + $scope.quanhuyen);

      },
        function (res) { if (res.data == "thatbai") { console.log("update thatbai ") } });

  }
  //END GET QUAN HUYEN THEO THANH PHO PHAN ORDER ADD------------------------------------------------------------------------------
  $scope.selectproduct = function (req) {
    var data = $.param({
      ccc: $scope.ccc,
    });

    console.log(data);
    var config = {
      headers: {
        'content-type': 'application/x-www-form-urlencoded;charset=UTF-8'
      }
    }
    $http.post($scope.baseURL + '/admin/order-api-product', data, config)
      .then(function (res) {
        $scope.product = res.data;
        console.log("update thcong " + $scope.product);

      },
        function (res) { if (res.data == "thatbai") { console.log("update thatbai ") } });

  }













































































  $scope.sort = function (keyname) {
    $scope.sortKey = keyname;   //set the sortKey to the param passed
    $scope.reverse = !$scope.reverse; //if true make it false and vice versa
  }
  $scope.hienthi = "true";
  $scope.doigiatri = function () {
    $scope.hienthi = !$scope.hienthi;//check angular
  }
  $scope.hienra = function (motnguoi) {
    motnguoi.hienthi = !motnguoi.hienthi;
  }
})

