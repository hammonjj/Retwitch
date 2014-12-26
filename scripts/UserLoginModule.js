var userLoginModule = angular.module('userLoginModule', []);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
userLoginModule.controller('vodController', function($scope, $http)
{
    var userIdDiv = document.getElementById("userid");
    $http.get("http://retwitch.pingdynamic.com/scripts/GetVodListByUserId.php?userid=" + userIdDiv.textContent)
        .success(function(response) {$scope.names = response;});

    $scope.removeVod = function(vod)
    {
        var index = $scope.names.indexOf(vod);
        if (index > -1)
        {
            console.log("Removing: " + vod.VodId);
            $.post("http://retwitch.pingdynamic.com/scripts/RemoveVodByUserId.php?userid=" +
                userIdDiv.textContent + "&vodid=" + vod.VodId);
            $scope.names.splice(index, 1);
        }
    }

    $scope.loadVod = function(vod)
    {
        console.log("Loading: " + vod);
        loadVod(vod.VodId);
        seekVod(vod.ReplayTime);
    }

    $scope.vodMouseOver = function(vod)
    {
        console.log(vod.VodId);
    }

    $scope.loadNewVod = function()
    {
        getVODUrl();
        setTimeout(function () {
            var userId = document.getElementById("userid");
            $http.get("http://retwitch.pingdynamic.com/scripts/GetVodListByUserId.php?userid=" + userId.textContent)
                .success(function(response) {$scope.names = response;});
        }, 2000);
    }
});