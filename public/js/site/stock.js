angular.module('app',['ui.bootstrap','angular.http.request.loader'])
    .controller('stockAppController',function($scope,$http,$rootScope,$uibModal){
        $scope.locations;
        $scope.location;
        $scope.observations;
        $scope.filter = {};
        $scope.getLocation = function()
        {
            $http({
                method : 'get',
                url : URL + 'location/api/list',
                params : Object.assign($scope.filter, {'bencanaid' : BENCANAID})
            }).then(function (response){
                $scope.locations = response.data;
            });
        }

        $scope.init = function()
        {
            $scope.getLocation();
        }

        $scope.selectLocation = function(lokasiid)
        {
            $http({
                method : 'get',
                url : URL + 'location/api/view/' + lokasiid,
                params : {}
            }).then(function(response){
                console.log(response.data);
                $scope.location = response.data;
            });

            $http({
                method : 'get',
                url : URL + 'location/api/observasi/' + lokasiid,
                params : {}
            }).then(function(response){
                $scope.observations = response.data;
            });
        }
        $scope.showModal = function(observasi, location)
        {
            var data = {
                observasi : observasi,
                location : location
            };
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'myModalContent.html',
                controller: 'modalTransaksi',
                size: 'lg',
                backdrop : false,
                resolve: {
                  data: function () {
                    return data;
                  }
                }
              });
        }

        $scope.init();
    })
    .controller('modalTransaksi',function($scope,$http,$uibModalInstance,data){

        var origin_jumlah = parseInt(data.observasi.posisi_jumlah);
        if (!origin_jumlah) {
            origin_jumlah = 0;
            console.log('gitu');
        }
        console.log(origin_jumlah);
        $scope.observasi = data.observasi;
        $scope.location = data.location;
        $scope.mode = 'penjumlahan';
        $scope.form = {};
        $scope.exit = function()
        {
            $uibModalInstance.dismiss();
        }

        $scope.changeValue = function(mode)
        {
            $scope.mode = mode;
            $scope.hitung();
        }

        $scope.hitung = function()
        {
            if ($scope.mode == 'penjumlahan') $scope.observasi.posisi_jumlah = origin_jumlah + $scope.form.jumlah;
            if ($scope.mode == 'pengurangan') $scope.observasi.posisi_jumlah = origin_jumlah - $scope.form.jumlah;
        }

        $scope.kirim = function()
        {
            var obj = {
                jumlah : $scope.form.jumlah,
                type : $scope.mode,
                lokasiid : $scope.location.lokasiid,
                observasi_id : $scope.observasi.id,
                keterangan : $scope.form.keterangan,
                sumber_tujuan : $scope.form.sumber_tujuan
            }

            $http({
                url : URL + 'location/api/transaksi/',
                data : obj,
                method : 'post'
            }).then(function(response){
                console.log(response);
            });
        }
    });


