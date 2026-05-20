var commlink = "https://enam.gov.in/NamWebSrv/rest/";
 //var commlink = "http://192.168.1.232:8080/NamWebSrv/rest/";
 //var commlink = "http://192.168.0.115:8181/NamWebSrv/rest/"


 var myapp = angular.module('myApp', []);
 myapp.controller('customersCtrl', function ($scope, $http) {
     $http({
         url: commlink + 'PortalMain',
         method: 'POST',
         crossDomain: 'true',
         data: "language=en",
         headers: {
             "Content-Type": "application/x-www-form-urlencoded"
         }
     }).success(function (response) {
         $scope.names = response.mainDashList;
     });
 });

 var app = angular.module('maxApp', []);
 app.controller('filterCtrls', function ($scope, $http) {
     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth() + 1; //January is 0!

     var yyyy = today.getFullYear();
     if (dd < 10) {
         dd = '0' + dd;
     }
     if (mm < 10) {
         mm = '0' + mm;
     }
     var today = (dd-1) + '/' + mm + '/' + yyyy;
     //var today = mm+'/'+dd+'/'+yyyy;
	 $("#toDateShow").show();
	 $("#karnatakaGrid").show();
	 $("#commonGrid").hide();
     $scope.fromDate = today;
     $scope.toDate = today;
	 $scope.states=[];
	$scope.state=null;
     $http({
         url: commlink + 'MastersUpdate/getStates?language=en',
         method: 'GET',
         crossDomain: 'true',
         headers: {
             "Content-Type": "application/x-www-form-urlencoded"
         }
     }).success(function (response) {
		 if(response.statusMsg=="S"){
			 for (i = 0; i < response.listStates.length; i++) {                 
				// $scope.states.push({"stateId":response.listStates[i].stateId,"stateDesc":response.listStates[i].stateDesc});
             };
			 $scope.states.push({"stateId":"KARNATAKA","stateDesc":"KARNATAKA  - ReMS"});
			 $scope.state="KARNATAKA";
			 $scope.listChangeApmc();
		 }
     });


     //http request for get Apmc list
     $scope.listChangeApmc = function () {
		  var fromD = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
     var toDate = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
		 $scope.apmc = null;
		 $scope.commodity = null;
         $scope.commodityList1 = [];
		 $scope.apmsList=[];
		  $scope.commodityGrid = [];
		if($scope.state==="KARNATAKA"){
			$("#toDateShow").hide();
			$("#karnatakaGrid").show();
			$("#commonGrid").hide();
			$scope.isTableShow = true;
		 $http.get("https://mis.remsl.in/UMPInterOpService/MastersUpdate/getMarkets")
		.then(function(response) {
        for (i = 0; i < response.data.marketList.length; i++) {     
if(response.data.marketList[i].marketShortName==undefined){		
				 $scope.apmsList.push({"apmcId":response.data.marketList[i].marketCode,"apmcDesc":response.data.marketList[i].marketDescription});
}
else
{
	$scope.apmsList.push({"apmcId":response.data.marketList[i].marketCode,"apmcDesc":response.data.marketList[i].marketShortName});
}
             };
		});
		$scope.isTableShow = false;
		}else{	
		$("#karnatakaGrid").hide();
	    $("#commonGrid").show();
		$("#toDateShow").show();
         $http({
             url: commlink + 'MastersUpdate/getApmc?language=en&stateId=' + $scope.state,
             method: 'GET',
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.apmsList = response.listStateApmc;
         });
//  request for all Commodity change for sohan

		 var stateName="";
		 var apmcName="";		
         if ($scope.state == null) {
             $scope.state = null;
			 
         }else{
			 var s=document.getElementById("stateId");
			  stateName = s.options[s.selectedIndex].text;
		 }
		
         if ($scope.apmc == null) {
             $scope.apmc = null;
         }else{
			 var a=document.getElementById("apmcNameId");
			apmcName=a.options[a.selectedIndex].text;
		 }
		 
		 
			$http({           
			url: commlink + 'CommodityPrice/getMinMaxModelProducts',
             method: 'POST',
             data: "language=en&stateName=" + stateName + "&apmcName=" + apmcName+ "&fromDate=" + fromD + "&toDate=" + toDate ,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.commodityList1 = response.listCommodity;
             $scope.isTableShow = false;
         });		 
		 
		 
		 
         /**$scope.urls = commlink + 'MastersUpdate/getProducts?language=en&stateName=' + $scope.stateName;
         $http({
             url: $scope.urls,
             method: 'POST',
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/json;"
             }
         }).success(function (response) {
             $scope.commodityList1 = response.listCommodity;

         });*/
		 
		}
     };
// change for sohan

		var fromD = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
     var toDate = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";	

     //http request for get all commodity List
	 $http({           
			url: commlink + 'CommodityPrice/getMinMaxModelProducts',
             method: 'POST',
             data: "language=en&fromDate=" + fromD + "&toDate=" + toDate,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.commodityList1 = response.listCommodity;
             $scope.isTableShow = false;
         });
    /** $http({commidityName
             url: commlink + 'MastersUpdate/getProducts?language=en',
             method: 'GET',
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/json;"
             }
         }).success(function (response) {
             $scope.commodityList = response.listCommodity;

         })
         .error(function (error) {});*/

     //http request for get all commodity grid first time
     

     $http({
        // url: commlink + 'mobile/getCommodity',
		 url: commlink + 'CommodityPrice/getMinMaxModelPrice',
         method: 'POST',
         data: "language=en",
         crossDomain: 'true',
         headers: {
             "Content-Type": "application/x-www-form-urlencoded"
         }
     }).success(function (response) {
      //   $scope.commodityGrid = response.listCommodity;

     });


     $scope.commodityValue = function (commodityId) {
         if (commodityId == null) {
             $scope.commodity = null;
         } else {
             $scope.commodity = commodityId;
         }

     };


     //listChange method for get commodityList basedon stateId & apmcId
     $scope.listChange = function (apmc12) {
		  var fromD = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
     var toDate = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
	     $scope.apmc = apmc12;
         $scope.commodity = null;
         $scope.commodityList1 = [];
	  if($scope.state==="KARNATAKA"){
		  $("#toDateShow").hide();
		 $http.get("https://mis.remsl.in/UMPInterOpService/MastersUpdate/getCommodities/"+$scope.apmc)
		.then(function(response) {
        for (i = 0; i < response.data.commodityList.length; i++) {                 
				 $scope.commodityList1.push({"commidityId":response.data.commodityList[i].commodityGroupCode,"commidityName":response.data.commodityList[i].commodityCode});
             };
		});
	  }  // change for sohan
        else{ 
		
		 var stateName="";
		 var apmcName="";		
         if ($scope.state == null) {
             $scope.state = null;
			 
         }else{
			 var s=document.getElementById("stateId");
			  stateName = s.options[s.selectedIndex].text;
		 }
		
         if ($scope.apmc == null) {
             $scope.apmc = null;
         }else{
			 var a=document.getElementById("apmcNameId");
			apmcName=a.options[a.selectedIndex].text;
		 }
		 
		 
			$http({           
			url: commlink + 'CommodityPrice/getMinMaxModelProducts',
             method: 'POST',
             data: "language=en&stateName=" + stateName + "&apmcName=" + apmcName+ "&fromDate=" + fromD + "&toDate=" + toDate,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.commodityList1 = response.listCommodity;
             $scope.isTableShow = false;
         });
		
		
		
		/**$("#toDateShow").show();
         $scope.urls = commlink + 'MastersUpdate/getProducts?language=en&stateId=' + $scope.state + '&apmcId=' + $scope.apmc;
         $http({
             url: $scope.urls,
             method: 'GET',
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/json;"
             }
         }).success(function (response) {
             $scope.commodityList1 = response.listCommodity;

         });*/
		}
     };


     //http request for get all commodity grid based on search
     $scope.searchCommodity = function () {
        var stateName="";
		 var apmcName="";
		 var commodityName="";
         
         if ($scope.state == null) {
             $scope.state = null;
			 
         }else{
			 var s=document.getElementById("stateId");
			  stateName = s.options[s.selectedIndex].text;
		 }
		
         if ($scope.apmc == null) {
             $scope.apmc = null;
         }else{
			 var a=document.getElementById("apmcNameId");
			apmcName=a.options[a.selectedIndex].text;
		 }
		 
         if ($scope.commodity == null) {
             $scope.commodity = null;
         }
		 else{
			var c=document.getElementById("commodityId");
			commodityName=c.options[c.selectedIndex].text; 
		 }

		  $scope.commodityGrid = [];
		 if($scope.state==="KARNATAKA"){
			  $scope.isTableShow = true;
			   var date = $scope.fromDate.split("/");
		       var dd = parseInt(date[0]);
		       var mmm =parseInt(date[1])-1;
		       var yyyy = parseInt(date[2]);
			   var FullMonth= ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL","AUG", "SEP", "OCT","NOV", "DEC"];
			   var FinalOut = dd + "-" + FullMonth[mmm] + "-" + yyyy;
			   var urllink="https://mis.remsl.in/UMPInterOpService/TxnUpdate/getArrivals/"+$scope.apmc+"/"+FinalOut;
		     $http.get(urllink)
		     .then(function(response) {
				  $scope.commodityGrid=response.data.arrivals;
		    });
			 $scope.isTableShow = false;  
		 }
		 else{
			  $scope.isTableShow = true;
         var fromD = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
		
         $http({
            // url: commlink + 'mobile/getCommodity',
			url: commlink + 'CommodityPrice/getMinMaxModelPrice',
             method: 'POST',
             data: "language=en&stateName=" + stateName + "&apmcName=" + apmcName + "&commodityName=" + $scope.commodity + "&fromDate=" + fromD + "&toDate=" + toDate,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.commodityGrid = response.listCommodity;
             $scope.isTableShow = false;
         });
		}

     };



 });

 /*===================================dashboard3============================================*/

 var app1 = angular.module('dashboard3', []);

 app1.controller('dashboard3Ctrls', function ($scope, $http, $timeout) {

     $scope.stateIds = null;
     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth() + 1; //January is 0!

     var yyyy = today.getFullYear();
     if (dd < 10) {
         dd = '0' + dd;
     }
     if (mm < 10) {
         mm = '0' + mm;
     }
     var today = dd + '/' + mm + '/' + yyyy;
     //var today = mm+'/'+dd+'/'+yyyy;
     $scope.fromDate = today;
     $scope.toDate = today;
     $scope.totalValueAPMC = 0;
     $scope.totalOnlineAPMC = 0;


     var totalVAPMC = 0;
     var totalOnlAPMC = 0;

     $scope.getData = function () {
         $scope.isTableShow = true;
         $scope.activeStateGrid = {};
         var fromD = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";


         $http({
             url: commlink + 'getActiveState',
             method: 'POST',
             data: "language=en&fromDate=" + fromD + "&toDate=" + toDate + "&orgId=1",
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.activeStateGrid = response.listActiveState;
             for (i = 0; i < $scope.activeStateGrid.length; i++) {
                 totalVAPMC = totalVAPMC + $scope.activeStateGrid[i].oprCount * 1;
                 $scope.totalValueAPMC = totalVAPMC;
                 totalOnlAPMC = totalOnlAPMC + $scope.activeStateGrid[i].activeCount * 1;
                 $scope.totalOnlineAPMC = totalOnlAPMC;
                 $scope.isTableShow = false;
             };

         });
     };


     // Function to replicate setInterval using $timeout service.
     $scope.intervalFunction = function () {
         $timeout(function () {

             $scope.intervalFunction();
         }, 100000)
     };

     // Kick off the interval
     $scope.intervalFunction();
     $scope.getData();

     $scope.filterMandi = function () {
         $scope.isTableShow = true;
         $scope.activeStateGrid = {};
         var totalVAPMC = 0;
         var totalOnlAPMC = 0;
         $scope.totalValueAPMC = 0;
         $scope.totalOnlineAPMC = 0;

         var fromD1 = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate1 = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";

         $http({
             url: commlink + 'getActiveState',
             method: 'POST',
             data: "language=en&fromDate=" + fromD1 + "&toDate=" + toDate1 + "&orgId=1",
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.activeStateGrid = response.listActiveState;
             for (i = 0; i < $scope.activeStateGrid.length; i++) {
                 totalVAPMC = totalVAPMC + $scope.activeStateGrid[i].oprCount * 1;
                 $scope.totalValueAPMC = totalVAPMC;
                 totalOnlAPMC = totalOnlAPMC + $scope.activeStateGrid[i].activeCount * 1;
                 $scope.totalOnlineAPMC = totalOnlAPMC;
             };
             $scope.isTableShow = false;
         });
     };


     $scope.getAPMCState = function (stateId, stateName) {
         $scope.isTableShow = true;
         $scope.getActiveApmc = {};
         $scope.stateNameSelected = stateName;
         $scope.stateIds = stateId;

         var fromD1 = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate1 = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";

         $http({
             url: commlink + 'getActiveApmc',
             method: 'POST',
             data: "language=en&fromDate=" + fromD1 + "&toDate=" + toDate1 + "&orgId=1&oprId=" + stateId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.getActiveApmc = response.listActiveApmc;
             $scope.isTableShow = false;
         });

     };




 });

 /*===================================dashboard5============================================*/

 var dashb5 = angular.module('dashboard5', []);
 dashb5.factory('Excel', function ($window) {
     var uri = 'data:application/vnd.ms-excel;base64,',
         template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
         base64 = function (s) {
             return $window.btoa(unescape(encodeURIComponent(s)));
         },
         format = function (s, c) {
             return s.replace(/{(\w+)}/g, function (m, p) {
                 return c[p];
             })
         };
     return {
         tableToExcel: function (tableId, worksheetName) {
             var table = $(tableId),
                 ctx = {
                     worksheet: worksheetName,
                     table: table.html()
                 },
                 href = uri + base64(format(template, ctx));
             return href;
         }
     };
 });

 dashb5.controller('dashboard5Ctrls', function ($scope, $http, $timeout, Excel) {

     $scope.stateIds = null;


     $scope.getData = function () {
         $scope.isTableShow = true;
         $scope.totalBuyers = 0;
         $scope.totalCAgents = 0;
         $scope.totalServiceProviders = 0;
         $scope.totalSellers = 0;
         var totalBuyer = 0;
         var totalCAgent = 0;
         var totalServiceProvider = 0;
         var totalSeller = 0;


         $http({
             url: commlink + 'getPortalUserRegisteredState',
             method: 'POST',
             data: "language=en",
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.activeUserStateGrid = response.portalUserStateList;
             for (i = 0; i < $scope.activeUserStateGrid.length; i++) {
                 totalBuyer = totalBuyer + $scope.activeUserStateGrid[i].trader * 1;
                 $scope.totalBuyers = totalBuyer;

                 totalCAgent = totalCAgent + $scope.activeUserStateGrid[i].commsionAgent * 1;
                 $scope.totalCAgents = totalCAgent;

                 totalServiceProvider = totalServiceProvider + $scope.activeUserStateGrid[i].serviceProvider * 1;
                 $scope.totalServiceProviders = totalServiceProvider;

                 totalSeller = totalSeller + $scope.activeUserStateGrid[i].farmer * 1;
                 $scope.totalSellers = totalSeller;
             };
             $scope.isTableShow = false;
         });
     };

     $scope.exportToExcel = function () {
         $http({
             url: commlink + 'TrdData/getTraderData',
             method: 'POST',
             data: "language=en&stateId=" + $scope.stateIds,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.traderList = response.traderDataList;
             var test = "<div id='testid'><table >  <thead>" +
                 "<tr><th>Sr.No.</th>" +
                 "<th>State</th>" +
                 "<th>APMC</th>" +
                 "<th>Trader Name</th>" +
                 "<th>Firm Name</th>" +
                 "<th>License Number</th>" +
                 "<th >Contact Number</th></tr></thead><tbody>";
             var sn = 0;
             for (var i = 0; i < $scope.traderList.length; i++) {
                 //console.log(sn);
                 sn++;
                 test += "<tr><td>" + sn + "</td>";
                 test += "<td>" + $scope.traderList[i].stateName + "</td>";
                 test += "<td>" + $scope.traderList[i].apmcName + "</td>";
                 test += "<td>" + $scope.traderList[i].traderName + "</td>";
                 test += "<td>" + $scope.traderList[i].companyName + "</td>";
                 test += "<td>" + $scope.traderList[i].liecenceNumber + "</td>";
                 test += "<td>" + $scope.traderList[i].mobileNumber + "</td></tr>";
             }
             test += "</tbody></table></div>";

             var exportHref = Excel.tableToExcel(test, 'WireWorkbenchDataExport');
             $timeout(function () {
                 location.href = exportHref;
             }, 1000); // trigger download
         });

     };


     // Function to replicate setInterval using $timeout service.
     $scope.intervalFunction = function () {
         $timeout(function () {
             $scope.intervalFunction();
         }, 1000000)
     };

     // Kick off the interval
     $scope.intervalFunction();
     $scope.getData();




     $scope.getRegisterAPMCState = function (stateId, stateName) {
         $scope.isTableShow = true;
         $scope.stateNameSelected = stateName;
         $scope.stateIds = stateId;
         $scope.totalBuyer = null;
         $scope.totalCAgent = null;
         $scope.totalServiceProvider = null;
         $scope.totalSeller = null;
         var totalBuyer = 0;
         var totalCAgent = 0;
         var totalServiceProvider = 0;
         var totalSeller = 0;

         $http({
             url: commlink + 'getPortalUserRegisteredApmc',
             method: 'POST',
             data: "language=en&stateId=" + stateId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.getPortalUserRegisteredApmc = response.portalUserApmcList;

             for (i = 0; i < $scope.getPortalUserRegisteredApmc.length; i++) {
                 totalBuyer = totalBuyer + $scope.getPortalUserRegisteredApmc[i].trader * 1;
                 $scope.totalBuyer = totalBuyer;

                 totalCAgent = totalCAgent + $scope.getPortalUserRegisteredApmc[i].commsionAgent * 1;
                 $scope.totalCAgent = totalCAgent;

                 totalServiceProvider = totalServiceProvider + $scope.getPortalUserRegisteredApmc[i].serviceProvider * 1;
                 $scope.totalServiceProvider = totalServiceProvider;

                 totalSeller = totalSeller + $scope.getPortalUserRegisteredApmc[i].farmer * 1;
                 $scope.totalSeller = totalSeller;
             };
             $scope.isTableShow = false;
         });

     };

 });

 /*===================================dashboard1============================================*/

 var dashb1 = angular.module('dashboard1', []);

 dashb1.controller('dashboard1Ctrls', function ($scope, $http) {

     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth() + 1; //January is 0!

     var yyyy = today.getFullYear();
     if (dd < 10) {
         dd = '0' + dd;
     }
     if (mm < 10) {
         mm = '0' + mm;
     }
     var today = dd + '/' + mm + '/' + yyyy;
     $scope.fromDate = today;
     $scope.toDate = today;
     $scope.activeCommodityGrid = {};
     //var today = mm+'/'+dd+'/'+yyyy;



     $scope.getGraphs = function () {
         $scope.activeCommodityGrid = {};
         $scope.hdr = false;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";

         var dataPoints = [];

         var chart = new CanvasJS.Chart("chartContainer", {
             axisY: {
                 title: "Arrivals",
             },
             axisX: {
                 title: "Commodity",
             },
             title: {
                 text: "Commodity Arrivals",
                 fontWeight: "bolder",
                 fontColor: "#008B8B",
                 fontfamily: "tahoma",
                 fontSize: 25,
                 padding: 10
             },
             data: [
                 {
                     type: "column",
                     click: onClick,
                     dataPoints: dataPoints
		 }
		  ]
         });


         $.post(commlink + "GraphDtl/getArrivalGraph", {
                 language: "en",
                 orgId: "1",
                 fromDate: fDate,
                 toDate: toD
             },
             function (data, status) {
                 for (var i = 0; i < data.arrivalList.length; i++) {
                     dataPoints.push({
                         label: data.arrivalList[i].prodName,
                         y: +data.arrivalList[i].grossQty
                     });

                 }

                 chart.options.data.dataPoints = dataPoints;
                 chart.render();

             });
     };

     function onClick(e) {
         //alert(  e.dataSeries.type + ", dataPoint { x:" + e.dataPoint.label + ", y: "+ e.dataPoint.y + " }" );
         $scope.commodityTable(e.dataPoint.label)
     }



     $scope.commodityTable = function (selectedCom) {
         $scope.isTableShow = true;
         $scope.hdr = false;
         $scope.activeCommodityGrid = {};
         $scope.selectedCommodity = selectedCom;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
         $http({
             url: commlink + 'GraphDtl/getCommodityArrival',
             method: 'POST',
             data: "language=en&fromDate=" + fDate + "&toDate=" + toD + "&orgId=1&commodity=" + selectedCom,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.activeCommodityGrid = response.commodityArrivalList;
             $scope.hdr = true;
             $scope.isTableShow = false;

         });

     };

 });


 /*===================================dashboard2============================================*/

 var dashb1 = angular.module('dashboard2', []);

 dashb1.controller('dashboard2Ctrls', function ($scope, $http) {

     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth() + 1; //January is 0!

     var yyyy = today.getFullYear();
     if (dd < 10) {
         dd = '0' + dd;
     }
     if (mm < 10) {
         mm = '0' + mm;
     }
     var today = dd + '/' + mm + '/' + yyyy;
     $scope.fromDate = today;
     $scope.toDate = today;

     //var today = mm+'/'+dd+'/'+yyyy;
     $scope.spinnerShow = false;


     //http request for get all commodity List
     $http({
         url: commlink + 'MastersUpdate/getProducts?language=en',
         method: 'GET',
         crossDomain: 'true',
         headers: {
             "Content-Type": "application/json;"
         }
     }).success(function (response) {
         $scope.commodityList = response.listCommodity;

     });

     $scope.getGraphs = function () {
         $scope.selectedCommodity = null;
         $scope.selectedCommodityPriceGrid = {};
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";

         var dataPoints = [];

         var chart = new CanvasJS.Chart("chartContainer", {
             axisY: {
                 title: "Price",
             },
             axisX: {
                 title: "Commodity",
             },
             title: {
                 text: "Commodity Price",
                 fontWeight: "bolder",
                 fontColor: "#008B8B",
                 fontfamily: "tahoma",
                 fontSize: 25,
                 padding: 10
             },
             data: [
                 {
                     type: "column",
                     click: onClick,
                     dataPoints: dataPoints
		 }
		  ]
         });


         $.post(commlink + "GraphDtl/getArrivalGraph", {
                 language: "en",
                 orgId: "1",
                 fromDate: fDate,
                 toDate: toD
             },
             function (data, status) {
                 for (var i = 0; i < data.arrivalList.length; i++) {
                     dataPoints.push({
                         label: data.arrivalList[i].prodName,
                         y: +data.arrivalList[i].grossQty
                     });
                 }
                 $scope.spinnerShow = false;
                 chart.options.data.dataPoints = dataPoints;
                 chart.render();

             });
     };

     function onClick(e) {
         //alert(  e.dataSeries.type + ", dataPoint { x:" + e.dataPoint.label + ", y: "+ e.dataPoint.y + " }" );
         $scope.commodityTable(e.dataPoint.label)
     }



     $scope.commodityTable = function (selectedCom) {
         $scope.isTableShow = true;
         $scope.selectedCommodityPriceGrid = {};
         $scope.selectedCommodity = selectedCom;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
         $http({
             url: commlink + 'GraphDtl/getCommArrivalPrice',
             method: 'POST',
             data: "language=en&fromDate=" + fDate + "&toDate=" + toD + "&orgId=1&commodity=" + selectedCom,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.selectedCommodityPriceGrid = response.priceList;
             $scope.isTableShow = false;
         });

     };

 });

 /*===================================DAC dashboard============================================*/

 var dashb1 = angular.module('dacdashboard', []);

 dashb1.controller('dacdashboardCtrls', function ($scope, $rootScope, $http) {

     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth() + 1; //January is 0!

     var yyyy = today.getFullYear();
     if (dd < 10) {
         dd = '0' + dd;
     }
     if (mm < 10) {
         mm = '0' + mm;
     }
     var today = dd + '/' + mm + '/' + yyyy;
     $scope.fromDate = today;
     $scope.toDate = today;
     $scope.isTableShow = false;
     $scope.getDasGraphs = function () {
         $scope.ttlArrivalQty = 0;
         $scope.totalTradeQty = 0;
         $scope.totalTradeValue = 0;
         $scope.getGraphs();
         $scope.showPieChartDetails();
     }
     $scope.getGraphs = function () {
         $scope.dacStateWiseTradeDataList = "";
         $scope.selectedCommodity = null;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";

         var dataPoints = [];
         var dataPoints1 = [];
         var dataPoints2 = [];

         var chart = new CanvasJS.Chart("chartContainer", {
             theme: "theme3",
             animationEnabled: true,
             axisY: {
                 title: "",
             },
             axisX: {
                 title: "Month",
             },
             title: {
                 text: "Lot Analysis",
                 fontWeight: "bolder",
                 fontColor: "#008B8B",
                 fontfamily: "tahoma",
                 fontSize: 25,
                 padding: 10
             },
             data: [
                 {
                     name: "Trade Value",
                     legendText: "Trade Value",
                     type: "column",
                     showInLegend: true,
                     click: onClick,
                     dataPoints: dataPoints
		 }, {
                     name: "Online Payment",
                     legendText: "Online Payment",
                     type: "column",
                     showInLegend: true,
                     click: onClick,
                     dataPoints: dataPoints1
		 }, {
                     name: "Lot Assayed",
                     legendText: "Lot Assayed",
                     type: "column",
                     showInLegend: true,
                     click: onClick,
                     dataPoints: dataPoints2
		 }
		  ]
         });


         $.post(commlink + "DacDashboard/getTradedCommodityDetailDac", {
                 language: "en",
                 fromDate: fDate,
                 toDate: toD
             },
             function (data, status) {
                 for (var i = 0; i < data.tradedCommodityList.length; i++) {
                     dataPoints.push({
                         label: data.tradedCommodityList[i].tradeMonth,
                         y: +data.tradedCommodityList[i].lotAssayed
                     });
                     dataPoints1.push({
                         label: data.tradedCommodityList[i].tradeMonth,
                         y: +data.tradedCommodityList[i].onlinePayment
                     });
                     dataPoints2.push({
                         label: data.tradedCommodityList[i].tradeMonth,
                         y: +data.tradedCommodityList[i].lotAssayed
                     });
                 }
                 chart.options.data.dataPoints = dataPoints;
                 chart.options.data.dataPoints = dataPoints1;
                 chart.options.data.dataPoints = dataPoints2;
                 chart.render();
             });
     };

     function onClick() {
         //alert(  e.dataSeries.type + ", dataPoint { x:" + e.dataPoint.label + ", y: "+ e.dataPoint.y + " }" );
         $scope.lotAnalysisTable()

     }

     $scope.showPieChartDetails = function () {
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";


         var dataPoints = [];
         var chart = new CanvasJS.Chart("pieChartTeadeContainer", {
             title: {
                 /*text: "Gaming Consoles Sold in 2012"*/
             },
             legend: {
                 maxWidth: 350,
                 itemWidth: 100
             },
             data: [
                 {
                     type: "pie",
                     showInLegend: true,
                     toolTipContent: "{y} - #percent %",
                     legendText: "{label}",

                     /*click: onClick,*/
                     dataPoints: dataPoints

					}]
         });

         $.post(commlink + "DacDashboard/getTopTenTradedCommodity", {
                 language: "en",
                 fromDate: fDate,
                 toDate: toD
             },
             function (data, status) {
                 //alert("data "+JSON.stringify(data.tradedCommodityList));
                 for (var i = 0; i < data.topTenTradedCommodityList.length; i++) {

                     dataPoints.push({
                         label: data.topTenTradedCommodityList[i].commodityName,
                         y: +data.topTenTradedCommodityList[i].tradedQty
                     });
                 }
                 chart.options.data.dataPoints = dataPoints;
                 chart.render();

             });
     };


     $scope.lotAnalysisTable = function () {
         $scope.isTableShow = true;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
         var totalArrivalQty = 0;
         var totalTradeQty = 0;
         var totalTradeValue = 0;
         $http({
             url: commlink + 'DacDashboard/getDacStateWiseTradeData',
             method: 'POST',
             data: "language=en&fromDate=" + fDate + "&toDate=" + toD,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.dacStateWiseTradeDataList = response.dacStateWiseTradeDataList;
             for (i = 0; i < $scope.dacStateWiseTradeDataList.length; i++) {
                 totalArrivalQty = totalArrivalQty + $scope.dacStateWiseTradeDataList[i].arrivalQuantity * 1;
                 totalTradeQty = totalTradeQty + $scope.dacStateWiseTradeDataList[i].soldQuantity * 1;
                 totalTradeValue = totalTradeValue + $scope.dacStateWiseTradeDataList[i].soldAmount * 1;

             };
             $scope.ttlArrivalQty = parseFloat(totalArrivalQty).toFixed(6);
             $scope.totalTradeQty = parseFloat(totalTradeQty).toFixed(6);
             $scope.totalTradeValue = parseFloat(totalTradeValue).toFixed(6);
             $scope.isTableShow = false;
         });

     };

 });

 /*=============================dashboard==========================*/

 var dashb = angular.module('dashboard', []);

 dashb.controller('dashboardCtrls', function ($scope, $http, $rootScope) {
     $scope.main = true;
     $scope.lblview = false;
     $scope.lblview2 = false;
     $scope.lblview3 = false;
     $scope.lblview4 = false;
     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth() + 1; //January is 0!
     var yyyy = today.getFullYear();
     if (dd < 10) {
         dd = '0' + dd;
     }
     if (mm < 10) {
         mm = '0' + mm;
     }
     var today = dd + '/' + mm + '/' + yyyy;
     $scope.fromDate = today;
     $scope.toDate = today;
     var xyz;
     var grpid;
     var commid;
     var stateid;
     var apmcId;
     var parentComm;
     var parentstate;
     $scope.mainList;
     var level1DataList;
     $scope.activeCommodityGrid = {};
     //var today = mm+'/'+dd+'/'+yyyy;

     $("#selectedback").hide();
     $("#level2").hide();
     $("#level3").hide();
     $("#level4").hide();
     $("#parentComm").hide();
     $("#parentComm").hide();
     $("#parentstate").hide();
     $("#apmcDesc").hide();
     $("#multiChartTypeId").hide();
     $scope.getarivalGraph = function () {
         $scope.groupId = "";
         $scope.main = true;
         $scope.lblview = false;
         $scope.lblview2 = false;
         $scope.lblview3 = false;
         $scope.lblview4 = false;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
         var arrivalQty = [];

         $.post(commlink + "getArrivalTrade/main", {
                 fromDate: fDate,
                 toDate: toD
             },
             function (data) {
                 if (data.statusMsg === "S") {
                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                     $scope.mainList = data;
                     for (var i = 0; i < data.arrGrpCnt.length; i++) {
                         arrivalQty.push({
                             "label": data.arrGrpCnt[i].groupDesc,
                             "value": data.arrGrpCnt[i].grpCommCnt
                         });
                     }

                     $scope.id = "total-arrival";
                     $scope.caption = "Arrivals Group Wise Commodity Reported Between from" + ' ' + $scope.fromDate + ' ' + "To" + ' ' + $scope.toDate;
                     $scope.yAxisName = "No Of Group Reported";
                     $scope.xAxisName = "Group Name";
                     $scope.dataSet = arrivalQty;
                     $scope.changeChartType();
                 } else {
                     var demographicsChart = "";
                     $("#total-arrival").insertFusionCharts({
                         swfUrl: "FusionCharts/Column3D.swf"
                     });
                 }


             });
     };

     //click event
     /*level 1*/
     $('#total-arrival').bind('fusionchartsdataplotclick', function (event, args) {
         $("#selected-total-arrival").show();
         $("#total-arrival").hide();
         $("#main").hide();
         $("#selectedback").show();
         //console.log("ddddddddddddddd"+JSON.stringify(args));
         $scope.gindex = args.index;
         $scope.categoryLabel = args.categoryLabel;
         $scope.lavel1View();
     });
     $scope.lavel1View = function () {
         $("#parentComm").hide();
         $("#parentstate").hide();
         $("#apmcDesc").hide();
         $scope.main = false;
         $scope.lblview = true;
         $scope.lblview2 = false;
         $scope.lblview3 = false;
         $scope.lblview4 = false;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";

         //var indexvalue = args.index;
         // alert(xyz.arrGrpCnt[indexvalue].groupId);
         $scope.groupId = $scope.mainList.arrGrpCnt[$scope.gindex].groupId;
         //alert($scope.groupId)

         var grpArrivalQty = [];
         $.post(commlink + "getArrivalTrade/level1", {
                 fromDate: fDate,
                 toDate: toD,
                 groupId: $scope.groupId
             },
             function (datalbl1) {
                 $scope.lbl1List = datalbl1;

                 //console.log("level1"+JSON.stringify(datalbl1));
                 if (datalbl1.statusMsg === "S") {
                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                     for (var i = 0; i < datalbl1.arrCommQty.length; i++) {
                         grpArrivalQty.push({
                             "label": datalbl1.arrCommQty[i].parentCommDesc,
                             "value": datalbl1.arrCommQty[i].arrivalQty
                         });
                     }
                     $scope.id = "selected-total-arrival";
                     $scope.caption = "Arrivals Of " + $rootScope.categoryLabel + " (Quintals) Reported Between from" + ' ' + $scope.fromDate + ' ' + "To" + ' ' + $scope.toDate;
                     $scope.yAxisName = "Arrivals in Quintals";
                     $scope.xAxisName = "Commodity";
                     $scope.dataSet = grpArrivalQty;
                     $scope.changeChartType();
                 } else {

                     $("#selected-total-arrival").insertFusionCharts({
                         swfUrl: "FusionCharts/Column3D.swf"
                     });
                 }

             });

     };
     /*end level 1*/
     /* Level 2*/
     $('#selected-total-arrival').bind('fusionchartsdataplotclick', function (event, args) {
         $("#selected-total-arrival").hide();
         $("#state-wise-arrival").show();
         $("#main").hide();
         $("#level2").show();
         $("#selectedback").hide();

         $scope.comIndexId = args.index;

         $scope.lavel2View();
     });

     $scope.lavel2View = function () {
         $("#parentComm").show();
         $("#parentstate").hide();
         $("#apmcDesc").hide();
         $scope.main = false;
         $scope.lblview = false;
         $scope.lblview2 = true;
         $scope.lblview3 = false;
         $scope.lblview4 = false;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";

         $scope.comIndex = $scope.lbl1List.arrCommQty[$scope.comIndexId].parentCommId;
         $rootScope.parentComm = $scope.lbl1List.arrCommQty[$scope.comIndexId].parentCommDesc;
         //alert($scope.comIndex);
         document.getElementById("parentComm1").innerHTML = $rootScope.parentComm;
         var arrStateCnt = [];

         $.post(commlink + "getArrivalTrade/level2", {
                 fromDate: fDate,
                 toDate: toD,
                 groupId: $scope.groupId,
                 parentCommId: $scope.comIndex
             },
             function (datalbl2) {

                 if (datalbl2.statusMsg === "S") {
                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                     $scope.lbl2List = datalbl2;
                     for (var i = 0; i < datalbl2.arrStateCnt.length; i++) {
                         arrStateCnt.push({
                             "label": datalbl2.arrStateCnt[i].stateDesc,
                             "value": datalbl2.arrStateCnt[i].apmcCount
                         });
                     }
                     $scope.id = "state-wise-arrival";
                     $scope.caption = "State Wise Market Reported Between from" + ' ' + $scope.fromDate + ' ' + "To" + ' ' + $scope.toDate;
                     $scope.yAxisName = "No Of Markets Reported";
                     $scope.xAxisName = "";
                     $scope.dataSet = arrStateCnt;
                     $scope.changeChartType();

                 } else {
                     $("#state-wise-arrival").insertFusionCharts({
                         swfUrl: "FusionCharts/Column3D.swf"
                     });
                 }

             });

     };
     /*end level 2*/
     /*level 3*/


     $('#state-wise-arrival').bind('fusionchartsdataplotclick', function (event, args) {
         $("#state-wise-arrival").hide();
         $("#mandis-wise-arrival").show();
         $("#main").hide();
         $("#selectedback").hide();
         $("#level2").hide();
         $("#level3").show();
         $("#chartTypeId").hide();
         $("#multiChartTypeId").show();

         $scope.stateIndex = args.index;

         $scope.lavel3View();
     });

     $scope.lavel3View = function () {
         $("#parentComm").show();
         $("#parentstate").show();
         $("#apmcDesc").hide();

         $scope.main = false;
         $scope.lblview = false;
         $scope.lblview2 = false;
         $scope.lblview3 = true;
         $scope.lblview4 = false;

         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";


         // alert(xyz.arrGrpCnt[indexvalue].groupId);
         $scope.stateIndexId = $scope.lbl2List.arrStateCnt[$scope.stateIndex].stateId;
         var stateName = $scope.lbl2List.arrStateCnt[$scope.stateIndex].stateDesc;
         //alert($scope.stateIndexId);	
         //alert($scope.stateName);

         document.getElementById("parentstate1").innerHTML = stateName;
         var apmcDesc = [];
         var arrQty = [];
         var trdQty = [];
         $.post(commlink + "getArrivalTrade/level3", {
                 fromDate: fDate,
                 toDate: toD,
                 groupId: $scope.groupId,
                 parentCommId: $scope.comIndex,
                 stateId: $scope.stateIndexId
             },
             function (datalbl3) {
                 //console.log("mandis-wise-arrival"+JSON.stringify(datalbl3));
                 $scope.lbl3List = datalbl3;
                 if (datalbl3.statusMsg == "S") {
                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                     for (var i = 0; i < datalbl3.arrApmcArrTrd.length; i++) {
                         apmcDesc.push({
                             "label": datalbl3.arrApmcArrTrd[i].apmcDesc
                         });
                         arrQty.push({
                             "value": datalbl3.arrApmcArrTrd[i].arrQty
                         });
                         trdQty.push({
                             "value": datalbl3.arrApmcArrTrd[i].trdQty,
                             "tooltext": datalbl3.arrApmcArrTrd[i].apmcDesc + "{br} Traded Value " + datalbl3.arrApmcArrTrd[i].trdVal + "{br} Traded Quantity " + datalbl3.arrApmcArrTrd[i].trdQty
                         });

                     }

                     $scope.id = "mandis-wise-arrival";
                     $scope.caption = "";
                     $scope.yAxisName = "Quantity (in Quintal)";
                     $scope.xAxisName = "";
                     $scope.dataSet.category = apmcDesc;
                     $scope.dataSet.data1 = arrQty;
                     $scope.dataSet.data2 = trdQty;
                     $scope.dataSet.lavel1 = "Quantity Arrived";
                     $scope.dataSet.lavel2 = "Traded Quantity";
                     $scope.changeChartType2();
                 } else {
                     var lbl3 = new FusionCharts({
                         type: 'mscolumn3d',
                         renderAt: 'mandis-wise-arrival'
                     });
                     lbl3.render();
                 }

             });


     };
     /* end level 3*/
     /* level 4*/
     $('#mandis-wise-arrival').bind('fusionchartsdataplotclick', function (event, args) {
         $("#mandis-wise-arrival").hide();
         $("#daily-wise-commodity").show();
         $("#level3").hide();
         $("#level4").show();

         $scope.apmcIndex = args.index;
         $scope.lavel4View();
     });

     $scope.lavel4View = function () {
         $("#apmcDesc").show();
         $scope.main = false;
         $scope.lblview = false;
         $scope.lblview2 = false;
         $scope.lblview3 = false;
         $scope.lblview4 = true;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";


         // alert(xyz.arrGrpCnt[indexvalue].groupId);
         apmcId = $scope.lbl3List.arrApmcArrTrd[$scope.apmcIndex].apmcId;
         var apmcDesc = $scope.lbl3List.arrApmcArrTrd[$scope.apmcIndex].apmcDesc;
         document.getElementById("apmcDesc1").innerHTML = apmcDesc;
         var commDesc = [];
         var arrQty = [];
         var trdVal = [];
         $.post(commlink + "getArrivalTrade/level4", {
                 fromDate: fDate,
                 toDate: toD,
                 groupId: $scope.groupId,
                 parentCommId: $scope.comIndex,
                 stateId: $scope.stateIndexId,
                 apmcId: apmcId
             },
             function (datalbl4) {
                 //console.log("daily-wise-arrival"+JSON.stringify(datalbl4));
                 if (datalbl4.statusMsg == "S") {
                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                     for (var i = 0; i < datalbl4.arrVarietyArrTrd.length; i++) {
                         commDesc.push({
                             "label": datalbl4.arrVarietyArrTrd[i].commDesc
                         });
                         arrQty.push({
                             "value": datalbl4.arrVarietyArrTrd[i].arrQty
                         });
                         trdVal.push({
                             "value": datalbl4.arrVarietyArrTrd[i].trdQty,
                             "tooltext": datalbl4.arrVarietyArrTrd[i].commDesc + "{br} Traded Value " + datalbl4.arrVarietyArrTrd[i].trdVal + "{br} Traded Quantity " + datalbl4.arrVarietyArrTrd[i].trdQty
                         });
                     }

                     $scope.id = "daily-wise-commodity";
                     $scope.caption = "";
                     $scope.yAxisName = "Quantity (in Quintal)";
                     $scope.xAxisName = "";
                     $scope.dataSet.category = commDesc;
                     $scope.dataSet.data1 = arrQty;
                     $scope.dataSet.data2 = trdVal;
                     $scope.dataSet.lavel1 = "Quantity Arrived";
                     $scope.dataSet.lavel2 = "Traded Value";
                     $scope.changeChartType2();
                 } else {
                     var demographicsChart = new FusionCharts({
                         type: 'mscolumn3d',
                         renderAt: 'daily-wise-commodity'
                     });
                     demographicsChart.render();
                 }
             });


     };
     /* end level 4*/

     $scope.backPage = function () {
         // $("#selected-total-trade-value").hide();		
         $("#total-trade-value").show();
         $("#selected-total-arrival").hide();
         $("#total-arrival").show();
         $("#main").show();
         $("#selectedback").hide();
         $scope.getarivalGraph();
     };
     $scope.level2 = function () {
         $("#selected-total-arrival").show();
         $("#total-arrival").hide();
         $("#state-wise-arrival").hide();
         $("#level2").hide();
         $("#selectedback").show();
         $scope.lavel1View();
     };
     $scope.level3 = function () {
         $("#mandis-wise-arrival").hide();
         $("#state-wise-arrival").show();
         $("#level2").show();
         $("#level3").hide();
         $("#multiChartTypeId").hide();
         $("#chartTypeId").show();
         $scope.lavel2View();
     };
     $scope.level4 = function () {
         $("#mandis-wise-arrival").show();
         $("#daily-wise-commodity").hide();
         $("#level3").show();
         $("#level4").hide();
         $("#chartTypeId").hide();
         $("#multiChartTypeId").show();
         $scope.lavel3View();
     };
     /*Chart Type Start*/
     $scope.chartTypeList = [
         {
             "ctId": "1",
             "ctName": "Column 3D Chart"
        }, {
             "ctId": "2",
             "ctName": "Column 2D Chart"
        }, {
             "ctId": "3",
             "ctName": "3D Pie Chart"
        }, {
             "ctId": "4",
             "ctName": "2D Pie Chart"
        }, {
             "ctId": "5",
             "ctName": "Bar 3D Chart"
        }, {
             "ctId": "6",
             "ctName": "Bar 2D Chart"
        }, {
             "ctId": "7",
             "ctName": "Line Chart"
        }
    ];

     $scope.chartTypeList2 = [
         {
             "ctId": "9",
             "ctName": "Column 3D Chart"
        }, {
             "ctId": "10",
             "ctName": "Column 2D Chart"
        }, {
             "ctId": "11",
             "ctName": "Bar 3D Chart"
        }, {
             "ctId": "12",
             "ctName": "Bar 2D Chart"
        }, {
             "ctId": "13",
             "ctName": "Line Chart"
        }
    ];


     $scope.chartType = $scope.chartTypeList[0].ctId;

     $scope.changeChartType = function () {
         if ($scope.chartType == "1") {
             $scope.chartType2 = "9";
             $scope.get3DPieChart('column3d');
         } else if ($scope.chartType == "2") {
             $scope.chartType2 = "10";
             $scope.get3DPieChart('column2d');
         } else if ($scope.chartType == "3") {
             $scope.chartType2 = "9";
             $scope.get3DPieChart('pie3d');
         } else if ($scope.chartType == "4") {
             $scope.chartType2 = "9";
             $scope.get3DPieChart('pie2d');
         } else if ($scope.chartType == "5") {
             $scope.chartType2 = "11";
             $scope.get3DPieChart('bar3d');
         } else if ($scope.chartType == "6") {
             $scope.chartType2 = "12";
             $scope.get3DPieChart('bar2d');
         } else if ($scope.chartType == "7") {
             $scope.chartType2 = "13";
             $scope.getLineChart();
         }
     };


     $scope.changeChartType2 = function () {
         if ($scope.chartType2 == "9") {
             $scope.chartType = "1";
             $scope.get3DMultiColumnBarChart('mscolumn3d');
         } else if ($scope.chartType2 == "10") {
             $scope.chartType = "2";
             $scope.get3DMultiColumnBarChart('mscolumn2d');
         } else if ($scope.chartType2 == "11") {
             $scope.chartType = "5";
             $scope.get3DMultiColumnBarChart('msbar3d');
         } else if ($scope.chartType2 == "12") {
             $scope.chartType = "6";
             $scope.get3DMultiColumnBarChart('msbar2d');
         } else if ($scope.chartType2 == "13") {
             $scope.chartType = "7";
             $scope.get3DMultiColumnBarChart('zoomline');
         }
     };
     $scope.changeChartTypePT = function () {
         if ($scope.chartType2 == "9") {
             if ($scope.previous.id != undefined || $scope.previous.id != null) {
                 $scope.get3DMultiColumnBarChart2('mscolumn3d');
             }
             $scope.get3DMultiColumnBarChart('mscolumn3d');
         } else if ($scope.chartType2 == "10") {
             if ($scope.previous.id != undefined || $scope.previous.id != null) {
                 $scope.get3DMultiColumnBarChart2('mscolumn2d');
             }
             $scope.get3DMultiColumnBarChart('mscolumn2d');
         } else if ($scope.chartType2 == "11") {
             if ($scope.previous.id != undefined || $scope.previous.id != null) {
                 $scope.get3DMultiColumnBarChart2('msbar3d');
             }
             $scope.get3DMultiColumnBarChart('msbar3d');
         } else if ($scope.chartType2 == "12") {
             if ($scope.previous.id != undefined || $scope.previous.id != null) {
                 $scope.get3DMultiColumnBarChart2('msbar2d');
             }
             $scope.get3DMultiColumnBarChart('msbar2d');
         } else if ($scope.chartType2 == "13") {
             if ($scope.previous.id != undefined || $scope.previous.id != null) {
                 $scope.get3DMultiColumnBarChart2('zoomline');
             }
             $scope.get3DMultiColumnBarChart('zoomline');
         }
     };


     $scope.chartTypePM = $scope.chartTypeList2[0].ctId;
     $scope.priceMktChartType = function () {
         if ($scope.chartTypePM == "9") {
             $scope.get3DMultiColumnBarChart('mscolumn3d');
         } else if ($scope.chartTypePM == "10") {
             $scope.get3DMultiColumnBarChart('mscolumn2d');
         } else if ($scope.chartTypePM == "11") {
             $scope.get3DMultiColumnBarChart('msbar3d');
         } else if ($scope.chartTypePM == "12") {
             $scope.get3DMultiColumnBarChart('msbar2d');
         } else if ($scope.chartTypePM == "13") {
             $scope.get3DMultiColumnBarChart('zoomline');
         }
     };

     $scope.chartTypeT = $scope.chartTypeList[2].ctId;
     $scope.topTenChangeChartType = function () {
         if ($scope.chartTypeT == "1") {
             $scope.get3DColumnBarChart();
         } else if ($scope.chartTypeT == "2") {
             $scope.get2DColumnBarChart();
         } else if ($scope.chartTypeT == "3") {
             $scope.get3DPieChart('pie3d');
         } else if ($scope.chartTypeT == "4") {
             $scope.get3DPieChart('pie2d');
         } else if ($scope.chartTypeT == "5") {
             $scope.get3DPieChart('bar3d');
         } else if ($scope.chartTypeT == "6") {
             $scope.get3DPieChart('bar2d');
         } else if ($scope.chartTypeT == "7") {
             $scope.getLineChart();
         }
     };

     $scope.get3DColumnBarChart = function () {
         FusionCharts.ready(function () {
             $("#" + $scope.id).insertFusionCharts({
                 swfUrl: "FusionCharts/Column3D.swf",
                 width: "100%",
                 height: "550",
                 id: "myChartId",
                 dataFormat: "json",
                 dataSource: {
                     "chart": {
                         "caption": $scope.caption,
                         "yAxisName": $scope.yAxisName,
                         "xAxisName": $scope.xAxisName,
                         "showValues": "0",
                         "labelDisplay": "rotate",
                         "thousandSeparatorPosition": "2,3",
                         "formatNumberScale": "0",
                         "bgAlpha": "50",
                         "slantLabels": "1",
                         "canvasBgAlpha": '0',
                         "theme": "fint"
                     },
                     "data": $scope.dataSet
                 }
             });

         });
     };


     $scope.get3DPieChart = function (chartT) {
         FusionCharts.ready(function () {
             var piechart = new FusionCharts({
                 type: chartT,
                 renderAt: $scope.id,
                 width: '100%',
                 height: '400',
                 dataFormat: 'json',
                 dataSource: {
                     "chart": {
                         "caption": $scope.caption,
                         "xAxisName": $scope.xAxisName,
                         "yAxisName": $scope.yAxisName,
                         "startingAngle": "100",
                         "showLabels": "0",
                         "showLegend": "1",
                         "enableMultiSlicing": "0",
                         "slicingDistance": "15",
                         "canvasBgAlpha": '0',
                         "bgColor": "#ffffff",
                         //To show the values in percentage
                         "showPercentValues": "1",
                         "showPercentInTooltip": "0",
                         "showValues": "0",
                         "labelDisplay": "rotate",
                         "thousandSeparatorPosition": "2,3",
                         "formatNumberScale": "0",
                         "theme": "fint"
                     },
                     "data": $scope.dataSet
                 }
             });
             piechart.render();
         });
     };

     $scope.getLineChart = function () {
         var lineChart = new FusionCharts({
             type: 'line',
             renderAt: $scope.id,
             width: '100%',
             height: '300',
             dataFormat: 'json',
             dataSource: {
                 "chart": {
                     "caption": $scope.caption,
                     "xAxisName": $scope.xAxisName,
                     "yAxisName": $scope.yAxisName,
                     "paletteColors": "#008ee4,#6baa01,#e44a00",
                     "bgAlpha": "0",
                     "borderAlpha": "20",
                     "canvasBorderAlpha": "0",
                     "legendBorderAlpha": "0",
                     "showXAxisLine": "1",
                     "showBorder": "0",
                     "showAlternateHgridColor": "0",
                     "toolTipColor": "#ffffff",
                     "toolTipBorderThickness": "0",
                     "toolTipBgColor": "#000000",
                     "toolTipBgAlpha": "80",
                     "toolTipBorderRadius": "2",
                     "toolTipPadding": "5",
                     "showValues": "0",
                     "labelDisplay": "rotate",
                     "thousandSeparatorPosition": "2,3",
                     "formatNumberScale": "0",
                     "slantLabels": "1"
                 },
                 "data": $scope.dataSet
             }
         });
         lineChart.render();
     };


     $scope.get3DMultiColumnBarChart = function (type) {
         var multiColumnBar = "";
         FusionCharts.ready(function () {
             multiColumnBar = new FusionCharts({
                 type: type,
                 renderAt: $scope.id,
                 width: '100%',
                 height: '500',
                 dataFormat: 'json',
                 dataSource: {
                     "chart": {
                         "caption": $scope.caption,
                         "xAxisName": $scope.xAxisName,
                         "yAxisName": $scope.yAxisName,
                         // "paletteColors": "#e44a00,#008ee4,#6baa01",
                         "bgAlpha": "0",
                         "borderAlpha": "20",
                         "canvasBorderAlpha": "0",
                         "legendBorderAlpha": "0",
                         "showXAxisLine": "1",
                         "showBorder": "0",
                         "showAlternateHgridColor": "0",
                         "toolTipColor": "#ffffff",
                         "toolTipBorderThickness": "0",
                         "toolTipBgColor": "#000000",
                         "toolTipBgAlpha": "80",
                         "toolTipBorderRadius": "2",
                         "toolTipPadding": "5",
                         "showValues": "0",
                         "labelDisplay": "rotate",
                         "thousandSeparatorPosition": "2,3",
                         "formatNumberScale": "0",
                         "canvasBgAlpha": '0',
                         "slantLabels": "1"
                     },
                     "categories": [{
                         "category": $scope.dataSet.category
                        }],
                     "dataset": [{
                         "seriesname": $scope.dataSet.lavel1,
                         "data": $scope.dataSet.data1
                        }, {
                         "seriesname": $scope.dataSet.lavel2,
                         "data": $scope.dataSet.data2
                        }]
                 }
             });
             multiColumnBar.render();
         });
     };
     $scope.get3DMultiColumnBarChart2 = function (type) {
         var multiColumnBar = "";
         FusionCharts.ready(function () {
             multiColumnBar = new FusionCharts({
                 type: type,
                 renderAt: $scope.previous.id,
                 width: '100%',
                 height: '500',
                 dataFormat: 'json',
                 dataSource: {
                     "chart": {
                         "caption": $scope.previous.caption,
                         "xAxisName": $scope.previous.xAxisName,
                         "yAxisName": $scope.previous.yAxisName,
                         // "paletteColors": "#e44a00,#008ee4,#6baa01",
                         "bgAlpha": "0",
                         "borderAlpha": "20",
                         "canvasBorderAlpha": "0",
                         "legendBorderAlpha": "0",
                         "showXAxisLine": "1",
                         "showBorder": "0",
                         "showAlternateHgridColor": "0",
                         "toolTipColor": "#ffffff",
                         "toolTipBorderThickness": "0",
                         "toolTipBgColor": "#000000",
                         "toolTipBgAlpha": "80",
                         "toolTipBorderRadius": "2",
                         "toolTipPadding": "5",
                         "showValues": "0",
                         "labelDisplay": "rotate",
                         "thousandSeparatorPosition": "2,3",
                         "formatNumberScale": "0",
                         "canvasBgAlpha": '0',
                         "slantLabels": "1"
                     },
                     "categories": [{
                         "category": $scope.previous.dataSet.category
                        }],
                     "dataset": [{
                         "seriesname": $scope.previous.dataSet.lavel1,
                         "data": $scope.previous.dataSet.data1
                        }, {
                         "seriesname": $scope.previous.dataSet.lavel2,
                         "data": $scope.previous.dataSet.data2
                        }]
                 }
             });
             multiColumnBar.render();
         });
     };

     /*Chart Type End*/

     /*==================  Top Ten Trade Commodity Graph ========================================*/
     $("#top-ten-traded-commodity").show();
     $("#top-ten-traded-commodity-lavel1").hide();
     $("#mainTopTen").show();
     $("#mainTopTenLabel1").hide();


     $scope.topTenDash = true;
     $scope.tTopLavel1 = false;
     $scope.tentradeGraphs = function () {
         $scope.ttindex = 0;
         $scope.topTenDash = true;
         $scope.tTopLavel1 = false;
         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
         var topTraded = [];


         $.post(commlink + "getTopTradedGroup/main", {
                 fromDate: fDate,
                 toDate: toD
             },
             function (data) {
                 if (data.statusMsg == "S") {
                     $scope.dataSet = [];
                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                     for (var i = 0; i < data.topTraded.length; i++) {
                         topTraded.push({
                             "label": data.topTraded[i].groupDesc,
                             "value": data.topTraded[i].trdVal,
                             "tooltext": "Commodity Name:" + data.topTraded[i].groupDesc + "{br}Trade Value:" + data.topTraded[i].trdVal + "{br}Trade Qty:" + data.topTraded[i].trdQty
                         });
                     }

                     $scope.id = "top-ten-traded-commodity";
                     $scope.caption = "";
                     $scope.yAxisName = "";
                     $scope.xAxisName = "";
                     $scope.dataSet = topTraded;
                     $scope.topTenChangeChartType();
                 } else {
                     var topTenTradedCommoditylbl = new FusionCharts({
                         type: 'pie3d',
                         renderAt: 'top-ten-traded-commodity'
                     });
                     topTenTradedCommoditylbl.render();
                 }

             });
     };

     $('#top-ten-traded-commodity').bind('fusionchartsdataplotclick', function (event, args) {
         $scope.topTenDash = false;
         $scope.tTopLavel1 = true;
         $("#top-ten-traded-commodity").hide();
         $("#top-ten-traded-commodity-lavel1").show();
         $("#mainTopTen").hide();
         $("#mainTopTenLabel1").show();
         $scope.ttindex = args.index;
         $scope.tentradeGraphsLavel1();
     });
     $scope.tentradeGraphsLavel1 = function () {

         var fDate = $scope.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toD = $scope.toDate.split("/").reverse().join("-") + " 23:59:59";
         var topTraded = [];


         $.post(commlink + "getTopTradedGroup/level1", {
                 fromDate: fDate,
                 toDate: toD,
                 groupId: $scope.ttindex
             },
             function (data) {
                 if (data.statusMsg == "S") {
                     $scope.dataSet = [];
                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                     for (var i = 0; i < data.topTraded.length; i++) {
                         topTraded.push({
                             "label": data.topTraded[i].groupDesc,
                             "value": data.topTraded[i].trdVal,
                             "tooltext": "Commodity Name:" + data.topTraded[i].groupDesc + "{br}Trade Value:" + data.topTraded[i].trdVal + "{br}Trade Qty:" + data.topTraded[i].trdQty
                         });
                     }

                     $scope.id = "top-ten-traded-commodity-lavel1";
                     $scope.caption = "";
                     $scope.yAxisName = "";
                     $scope.xAxisName = "";
                     $scope.dataSet = topTraded;
                     $scope.topTenChangeChartType();
                 } else {
                     var topTenTradedCommoditylbl = new FusionCharts({
                         type: 'pie3d',
                         renderAt: 'top-ten-traded-commodity-lavel1'
                     });
                     topTenTradedCommoditylbl.render();
                 }

             });
     };

     $scope.backPageDashboard = function () {
         $("#top-ten-traded-commodity").show();
         $("#top-ten-traded-commodity-lavel1").hide();
         $("#mainTopTen").show();
         $("#mainTopTenLabel1").hide();
         $scope.tentradeGraphs();
     };
     /*====================End Top Ten Trade Commodity Graph ========*/

     /*price Trend start*/
     $scope.priceT = {};
     $scope.priceT.fromDate = today;
     $scope.priceT.toDate = today;
     $scope.previous = {};
     $scope.oninit = function () {
         $scope.getCommodityList();
         $scope.chartType2 = "13";
     };



     $scope.getCommodityList = function () {
         $http({
             url: commlink + 'priceTrend/parentCommodityDetails',
             method: 'POST',
             data: "language=en",
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             if (response.statusMsg === "S") {
                 $scope.commodityList = response.parentCommodityList;
             } else {
                 $scope.commodityList = [];
             }
         });
     };

     $scope.getVarietyList = function () {

         $http({
             url: commlink + 'priceTrend/commodityDetails',
             method: 'POST',
             data: "parentCommodityId=" + $scope.priceT.parentCommodityId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (responses) {
             if (responses.statusMsg === "S") {
                 $scope.varietyList = responses.listCommodity;
             } else {
                 $scope.varietyList = [];
             }
         });
     };


     $scope.getStateList = function () {
         //console.log($scope.priceT.commidityId +"  "+$scope.priceT.parentCommodityId);
         $http({
             url: commlink + 'priceTrend/stateDetails',
             method: 'POST',
             data: "parentCommodityId=" + $scope.priceT.parentCommodityId + "&commidityId=" + $scope.priceT.commidityId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {

             if (response.statusMsg === "S") {
                 $scope.stateList = response.listStates;
             } else {
                 $scope.stateList = [];
             }
         });
     };

     $scope.getMandiList = function () {

         $http({
             url: commlink + 'priceTrend/apmcDetails',
             method: 'POST',
             data: "parentCommodityId=" + $scope.priceT.parentCommodityId + "&commidityId=" + $scope.priceT.commidityId + "&stateId=" + $scope.priceT.stateId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {

             if (response.statusMsg === "S") {
                 $scope.mandiList = response.apmcList;
             } else {
                 $scope.mandiList = [];
             }
         });
     };

     $scope.getPriceTrend = function () {
         $("#previus-price-trend").hide();
         $scope.preyear = false;
         if ($scope.priceT.apmcId === undefined || $scope.priceT.apmcId == null) {
             $scope.priceT.apmcId = 0;
         }
         if ($scope.priceT.stateId === undefined || $scope.priceT.stateId == null) {
             $scope.priceT.stateId = 0;
         }
         if ($scope.priceT.commidityId === undefined || $scope.priceT.commidityId == null) {
             $scope.priceT.commidityId = 0;
         }

         var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";
         var para = "parentCommodityId=" + $scope.priceT.parentCommodityId + "&commidityId=" + $scope.priceT.commidityId + "&stateId=" + $scope.priceT.stateId + "&apmcId=" + $scope.priceT.apmcId + "&fromDate=" + fromD + "&toDate=" + toDate;
         console.log("main para" + para);
         $http({
             url: commlink + 'priceTrend/main',
             method: 'POST',
             data: para,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             //console.log("main response "+JSON.stringify(response));
             if (response.statusMsg == "S") {
                 $scope.dataSet = [];
                 $('#fullscreen').addClass('fullscreen');
                 $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                 var trnDates = [];
                 var minVals = [];
                 var maxVals = [];
                 for (var i = 0; i < response.priceTrend.length; i++) {
                     trnDates.push({
                         "label": response.priceTrend[i].trnDate
                     });
                     maxVals.push({
                         "value": response.priceTrend[i].maxVal
                     });
                     minVals.push({
                         "value": response.priceTrend[i].minVal
                     });
                 }
                 $scope.id = "price-trend";
                 $scope.caption = "Price Trend Between " + $scope.priceT.fromDate + " To " + $scope.priceT.toDate;
                 $scope.yAxisName = "Amount Rs.";
                 $scope.xAxisName = "Date";
                 $scope.dataSet.category = trnDates;
                 $scope.dataSet.data1 = minVals;
                 $scope.dataSet.data2 = maxVals;
                 $scope.dataSet.lavel1 = "Min Price";
                 $scope.dataSet.lavel2 = "Max Price";
                 $scope.changeChartTypePT();
                 // $scope.getPreYearPriceTrend();
             } else {
                 var priceTrend = new FusionCharts({
                     type: 'zoomline',
                     renderAt: 'price-trend'
                 });
                 priceTrend.render();
             }
         });
     };
     $("#previus-price-trend").hide();
     $scope.getPreYearPriceTrend = function (preyear) {

         if (preyear === true) {

             $("#previus-price-trend").show();
             if ($scope.priceT.apmcId === undefined || $scope.priceT.apmcId == null) {
                 $scope.priceT.apmcId = 0;
             }
             if ($scope.priceT.stateId === undefined || $scope.priceT.stateId == null) {
                 $scope.priceT.stateId = 0;
             }
             if ($scope.priceT.commidityId === undefined || $scope.priceT.commidityId == null) {
                 $scope.priceT.commidityId = 0;
             }

             var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
             var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";

             var fd = new Date(fromD);
             var dd = fd.getDate();
             var mm = fd.getMonth() + 1; //January is 0!
             var yyyy = fd.getFullYear() - 1;
             if (dd < 10) {
                 dd = '0' + dd;
             }
             if (mm < 10) {
                 mm = '0' + mm;
             }
             var td = new Date(toDate);
             var tdd = td.getDate();
             var tmm = td.getMonth() + 1; //January is 0!
             var tyyyy = td.getFullYear() - 1;
             if (tdd < 10) {
                 tdd = '0' + tdd;
             }
             if (tmm < 10) {
                 tmm = '0' + tmm;
             }

             $scope.showfDate = dd + "/" + mm + "/" + yyyy;
             $scope.showtDate = tdd + "/" + tmm + "/" + tyyyy;
             fromD = yyyy + "-" + mm + "-" + dd + " 00:00:00";
             toDate = tyyyy + "-" + tmm + "-" + tdd + " 23:59:59";
             var para = "parentCommodityId=" + $scope.priceT.parentCommodityId + "&commidityId=" + $scope.priceT.commidityId + "&stateId=" + $scope.priceT.stateId + "&apmcId=" + $scope.priceT.apmcId + "&fromDate=" + fromD + "&toDate=" + toDate;
             console.log(para);
             $http({
                 url: commlink + 'priceTrend/main',
                 method: 'POST',
                 data: para,
                 crossDomain: 'true',
                 headers: {
                     "Content-Type": "application/x-www-form-urlencoded"
                 }
             }).success(function (response) {
                 //console.log(JSON.stringify(response));
                 if (response.statusMsg == "S") {

                     $scope.previous.dataSet = [];

                     $('#fullscreen').addClass('fullscreen');
                     $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');

                     var trnDates = [];
                     var minVals = [];
                     var maxVals = [];
                     for (var i = 0; i < response.priceTrend.length; i++) {
                         trnDates.push({
                             "label": response.priceTrend[i].trnDate
                         });
                         maxVals.push({
                             "value": response.priceTrend[i].maxVal
                         });
                         minVals.push({
                             "value": response.priceTrend[i].minVal
                         });
                     }

                     //$scope.mandiList = response.apmcList; 
                     $scope.previous.id = "previus-price-trend";
                     $scope.previous.caption = "Price Trend Between " + $scope.showfDate + " To " + $scope.showtDate;
                     $scope.previous.yAxisName = "Amount Rs.";
                     $scope.previous.xAxisName = "Date";
                     $scope.previous.dataSet.category = trnDates;
                     $scope.previous.dataSet.data1 = minVals;
                     $scope.previous.dataSet.data2 = maxVals;
                     $scope.previous.dataSet.lavel1 = "Min Price";
                     $scope.previous.dataSet.lavel2 = "Max Price";
                     $scope.changeChartTypePT();
                 } else {
                     $scope.previous = {};
                     var prepriceTrend = new FusionCharts({
                         type: 'zoomline',
                         renderAt: 'previus-price-trend'
                     });
                     prepriceTrend.render();
                 }
             });
         } else {
             $("#previus-price-trend").hide();
         }
     };
     $scope.getPriceMarket = function () {
         if ($scope.priceT.stateId === undefined || $scope.priceT.stateId == null) {
             $scope.priceT.stateId = 0;
         }
         if ($scope.priceT.commidityId === undefined || $scope.priceT.commidityId == null) {
             $scope.priceT.commidityId = 0;
         }
         var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";
         var para = "parentCommodityId=" + $scope.priceT.parentCommodityId + "&commidityId=" + $scope.priceT.commidityId + "&stateId=" + $scope.priceT.stateId + "&fromDate=" + fromD + "&toDate=" + toDate;
         //console.log(para);
         $http({
             url: commlink + 'priceTrend/compareApmc',
             method: 'POST',
             data: para,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             //console.log("response price market "+JSON.stringify(response));
             if (response.statusMsg == "S") {
                 $scope.dataSet = [];
                 $('#fullscreen').addClass('fullscreen');
                 $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');
                 var compareApmc = [];
                 var maxValue = [];
                 var qtl = [];
                 for (var i = 0; i < response.compareApmc.length; i++) {
                     compareApmc.push({
                         "label": response.compareApmc[i].apmcName
                     });
                     maxValue.push({
                         "value": +response.compareApmc[i].maxVal
                     });
                     qtl.push({
                         "value": +response.compareApmc[i].qtl
                     });
                 }

                 $scope.id = "price-market";
                 $scope.caption = "";
                 $scope.yAxisName = "Mandi";
                 $scope.xAxisName = "Price";
                 $scope.dataSet.category = compareApmc;
                 $scope.dataSet.data1 = maxValue;
                 $scope.dataSet.data2 = qtl;
                 $scope.dataSet.lavel1 = "Max Value";
                 $scope.dataSet.lavel2 = "Traded Quantity";
                 $scope.priceMktChartType();
             } else {
                 $("#price-market").insertFusionCharts({
                     swfUrl: "FusionCharts/Column3D.swf",
                     id: "myChartId",
                     dataSource: {
                         "data": []
                     }
                 });
             }
         });
     };

     $scope.getCommodityListFarmer = function () {
         //console.log("ddddddddddddd");
         var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";

         $http({
             url: commlink + 'getFarmerInfo/parentCommodityDetails',
             method: 'POST',
             data: "language=en&fromDate=" + fromD + "&toDate=" + toDate,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             if (response.statusMsg === "S") {
                 $scope.commodityList1 = response.parentCommodityList;
             } else {
                 $scope.commodityList1 = [];
             }
         });
     };

     $scope.getVarietyListFarmer = function () {
         var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";

         $http({
             url: commlink + 'getFarmerInfo/commodityDetails',
             method: 'POST',
             data: "fromDate=" + fromD + "&toDate=" + toDate + "&parentCommodityId=" + $scope.priceT.parentCommodityId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (responses) {
             if (responses.statusMsg === "S") {
                 $scope.varietyList = responses.listCommodity;
             } else {
                 $scope.varietyList = [];
             }
         });
     };


     $scope.getStateListFarmer = function () {
         var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";

         $http({
             url: commlink + 'getFarmerInfo/stateDetails',
             method: 'POST',
             data: "fromDate=" + fromD + "&toDate=" + toDate + "&parentCommodityId=" + $scope.priceT.parentCommodityId + "&commidityId=" + $scope.priceT.commidityId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {

             if (response.statusMsg === "S") {
                 $scope.stateList = response.listStates;
             } else {
                 $scope.stateList = [];
             }
         });
     };

     $scope.getMandiListFarmer = function () {
         var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";

         $http({
             url: commlink + 'getFarmerInfo/apmcDetails',
             method: 'POST',
             data: "fromDate=" + fromD + "&toDate=" + toDate + "&parentCommodityId=" + $scope.priceT.parentCommodityId + "&commidityId=" + $scope.priceT.commidityId + "&stateId=" + $scope.priceT.stateId,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             if (response.statusMsg === "S") {
                 $scope.mandiList = response.apmcList;
             } else {
                 $scope.mandiList = [];
             }
         });
     };

     $scope.criFarmerGraph = function () {
         $scope.getPriceTrend();
         $scope.getPriceMarket();
         var commDesc = [];
         var trdQty = [];
         var arrQty = [];
         var fromD = $scope.priceT.fromDate.split("/").reverse().join("-") + " 00:00:00";
         var toDate = $scope.priceT.toDate.split("/").reverse().join("-") + " 23:59:59";
         var para = "fromDate=" + fromD + "&toDate=" + toDate + "&parentCommId=" + $scope.priceT.parentCommodityId + "&stateId=" + $scope.priceT.stateId + "&apmcId=" + $scope.priceT.apmcId;
         console.log("para " + para);
         $http({
             url: commlink + 'getFarmerInfo/getArrivalTrade',
             method: 'POST',
             data: para,
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             if (response.statusMsg == "S") {
                 $('#fullscreen').addClass('fullscreen');
                 $('#fullscreen').find('.fa').removeClass('fa-window-maximize').addClass('fa-minus');

                 for (var i = 0; i < response.arrVarietyArrTrd.length; i++) {
                     commDesc.push({
                         "label": response.arrVarietyArrTrd[i].commDesc
                     });
                     arrQty.push({
                         "value": response.arrVarietyArrTrd[i].arrQty
                     });
                     trdQty.push({
                         "value": response.arrVarietyArrTrd[i].trdQty,
                         "tooltext": response.arrVarietyArrTrd[i].commDesc + "{br} Traded Value " + response.arrVarietyArrTrd[i].trdVal + "{br} Traded Quantity " + response.arrVarietyArrTrd[i].trdQty + "{br}Note :- Traded Quantity Includes Lots of Previous Days(Unsold Lots)"
                     });
                 }
                 FusionCharts.ready(function () {
                     var farmerInfo = new FusionCharts({
                         type: 'mscolumn3d',
                         renderAt: 'critical-Info-farmer',
                         width: '100%',
                         height: '500',
                         dataFormat: 'json',
                         dataSource: {
                             "chart": {
                                 "caption": "Arrival Vs Trade Value",
                                 // "xAxisName": "Group",
                                 "yAxisName": "Quantity (in Quintal)",
                                 "showValues": "0",
                                 "labelDisplay": "rotate",
                                 "thousandSeparatorPosition": "2,3",
                                 "formatNumberScale": "0",
                                 "slantLabels": "1",
                                 "canvasBgAlpha": '0'
                             },

                             "categories": [{
                                 "category": commDesc
            }],
                             "dataset": [{
                                 "seriesname": "Quantity Arrived",
                                 "data": arrQty
            }, {
                                 "seriesname": "Traded Quantity",
                                 "data": trdQty
            }]
                         }
                     });
                     farmerInfo.render();

                 });
             } else {
                 var farmerInfo = new FusionCharts({
                     type: 'mscolumn3d',
                     renderAt: 'critical-Info-farmer'
                 });
                 farmerInfo.render();
             }

         });
         //critical-Info-farmer
     };

     $scope.oninit();
 });

 /* ================================ State Wise Trading Dashboard =================================== */

 var appState = angular.module('stateTradingApp', []);
 appState.controller('stateTrading', function ($scope, $http, $interval) {



     $scope.oninit = function () {
         $scope.getDatalivestateWise();
     };


     $scope.getDatalivestateWise = function () {
         $scope.isWaitShow = true;
         $http({
             url: commlink + 'liveBidding/stateWise',
             method: 'POST',
             data: "language=en&orgId=1",
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.listActiveState = response.listActiveState;
             $scope.isWaitShow = false;
         });

     }

     $interval(function () {
         $scope.getDatalivestateWise();
     }, 900000);
     $scope.oninit();

 });
 /*================================== State Wise Trading Dashboard  ==============================*/

 var appComm = angular.module('commodityTradingApp', []);
 appComm.controller('commodityTrading', function ($scope, $http, $interval) {

     $("#parentGroupWise").show();
     $("#commGroupWise").hide();
     $("#varietyWise").hide();
     $("#groupWiseHdr").show();
     $("#commWiseHdr").hide();
     $("#varietyWiseHdr").hide();

     $scope.oninit = function () {
         $scope.state = null;
         $scope.getdataParentGroupWise();
     };

     $scope.getdataParentGroupWise = function () {
         $scope.isWaitShow = true;
         $http({
             url: commlink + 'liveBidding/parentGroupWise',
             method: 'POST',
             data: "language=en&orgId=1",
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.activeParGroupList = response.activeParGroupList;
             $scope.isWaitShow = false;
         });
     }

     $scope.backParent = function () {
         $("#parentGroupWise").show();
         $("#commGroupWise").hide();
         $("#varietyWise").hide();
         $("#groupWiseHdr").show();
         $("#commWiseHdr").hide();
         $("#varietyWiseHdr").hide();
     }

     $scope.isActiveGroup = function (isActiveGrp) {
         if (isActiveGrp.active === "Y") {
             $scope.isWaitShow = true;
             $("#parentGroupWise").hide();
             $("#commGroupWise").show();
             $("#varietyWise").hide();
             $("#groupWiseHdr").hide();
             $("#commWiseHdr").show();
             $("#varietyWiseHdr").hide();
             $scope.parentGroupName = isActiveGrp.parentGroup;

             $http({
                 url: commlink + 'liveBidding/commGroupWise',
                 method: 'POST',
                 data: "parentGroupId=" + isActiveGrp.parentGroupId + "&language=en&orgId=1",
                 crossDomain: 'true',
                 headers: {
                     "Content-Type": "application/x-www-form-urlencoded"
                 }
             }).success(function (response) {
                 $scope.commGroupWiseList = response.activeCommGroupList;
                 $scope.isWaitShow = false;
             });
         }
     }

     $scope.backActiveGroup = function () {
         $("#parentGroupWise").hide();
         $("#commGroupWise").show();
         $("#varietyWise").hide();
         $("#groupWiseHdr").hide();
         $("#commWiseHdr").show();
         $("#varietyWiseHdr").hide();
     }

     $scope.isVariety = function (activeComm) {
         $scope.commGroupIds = null;
         if (activeComm.active === "Y") {
             $scope.isWaitShow = true;
             $("#parentGroupWise").hide();
             $("#commGroupWise").hide();
             $("#varietyWise").show();
             $("#commWiseHdr").hide();
             $("#groupWiseHdr").hide();
             $("#varietyWiseHdr").show();

             $scope.commName = activeComm.commGroup;
             $scope.commGroupIds = activeComm.commGroupId;
             $scope.state = null;
             $scope.getVarietyGrid();
             $scope.getStateVarietyList();
         }
     }

     $scope.getVarietyGrid = function () {
         $http({
             url: commlink + 'liveBidding/getActiveVariertyList',
             method: 'POST',
             data: "commGroupId=" + $scope.commGroupIds + "&stateId=" + $scope.state + "&language=en&orgId=1",
             crossDomain: 'true',
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             if (response.statusMsg == "S") {
                 $scope.varietyWiseList = response.activeVarietyList;
                 $scope.isWaitShow = false;
             } else {
                 $scope.varietyWiseList = null;
                 $scope.isWaitShow = false;
             }
         });
     }

     $scope.getStateVarietyList = function () {
         $http({
             url: commlink + 'liveBidding/getStateList',
             method: 'POST',
             crossDomain: 'true',
             data: "commGroupId=" + $scope.commGroupIds + "&language=en&orgId=1",
             headers: {
                 "Content-Type": "application/x-www-form-urlencoded"
             }
         }).success(function (response) {
             $scope.states = response.listStates;
         });
     }

     $interval(function () {
             $scope.getdataParentGroupWise();
         },
         900000);

     $scope.oninit();

 });

 appComm.filter('isempty', function () { // convert  null to empty(null == empty) filter
     return function (input) {
         return isEmpty(input) ? '' : input;
     };

     function isEmpty(i) {
         return (i === null || i === undefined || i === "null");
     }

 });
 appComm.filter('isemptyNum', function () { // convert  null to 0.00(null == number) filter
     return function (input) {
         return isEmpty(input) ? '0.00' : input;
     };

     function isEmpty(i) {
         return (i === null || i === undefined || i === "null");
     }

 });
