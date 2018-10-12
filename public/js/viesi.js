var viesuApp = angular.module('viesuApp', []);


viesuApp.controller('viesiCtrl', function($scope, $http) {
	$scope.forma = {};
	var currentPage = 0;
	var nextPage = 10;
	var page = 10;


		// IP adrese
		$http.get("http://ip-api.com/json")
		.then(function(response) {
			$scope.ip = response.data;
			$scope.forma.ip = $scope.ip.query;
			
		}, function(response) {
			$scope.ip = "IP not found";
		});
		// Parluks
		function get_browser_info(){
			var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
			if(/trident/i.test(M[1])){
				tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
				return {name:'IE ',version:(tem[1]||'')};;
			}   
			if(M[1]==='Chrome'){
				tem=ua.match(/\bOPR\/(\d+)/)
				if(tem!=null)   {return {name:'Opera', version:tem[1]};}
			}   
			M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
			if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
			return {
				name: M[0],
				version: M[1]
			};
		}
		var browserv=get_browser_info();


		$scope.forma.browser = browserv.name + " " + browserv.version;

	//GET ierakstus
	$http.get("viesi")
	.then(function(response) {
		var resp = response.data;

		var count = resp.length;

		var pageTotal =  Math.ceil(count/page);
	
		
		$scope.nextPage = function() {
			if (currentPage+page<count) {
				currentPage += page;
				nextPage += page ;
				$scope.viesi = resp.slice(currentPage,nextPage);
				$scope.pageNumber += 1;
			}
		};

		$scope.previousPage = function() {
			if (currentPage-page>=0) {
				currentPage -= page;
				nextPage -=page ;
				$scope.viesi = resp.slice(currentPage,nextPage);
				$scope.pageNumber -= 1;
			}
		};

		$scope.orderByDate = function() {
			resp = resp.sort(function(a,b){
				return new Date(b.datums) - new Date(a.datums);
			});
			currentPage = 0;
			nextPage = page;
			$scope.viesi = resp.slice(currentPage,nextPage);
			$scope.pageNumber = 1;

		};

		$scope.orderByName = function() {
			resp = resp.sort(function(a, b) {
				var nameA = a.lietotaja_vards.toUpperCase(); 
				var nameB = b.lietotaja_vards.toUpperCase();  
				if (nameA < nameB) {
					return -1;
				}
				if (nameA > nameB) {
					return 1;
				}

				return 0;
			});
			currentPage = 0;
			nextPage = page;
			$scope.viesi = resp.slice(currentPage,nextPage);
			$scope.pageNumber = 1;

		};

		$scope.viesi = resp.slice(currentPage,nextPage);
		$scope.pageTotal = "/" + pageTotal;
		$scope.pageNumber = 1;
	}, function(response) {
		$scope.viesi = "Radās kļūda parādot datus!";
	});



	$scope.submitForm = function() {
		


		if (grecaptcha.getResponse() === "") {
			$scope.captcha = "Apstipriniet captcha!";
		}
		else {
		 		//forma uz datubazi
		 		$http.post('viesi', $scope.forma)
		 		.then(function(response) {
			//atjaunot ierakstus
			$http.get("viesi")
			.then(function(response) {
				var resp = response.data;
				$scope.viesi = resp.slice(currentPage,nextPage);
			}, function(response) {
				$scope.viesi = "Radās kļūda parādot datus!";
			});


			$scope.atbilde = "Ieraksts pievienots!";

		}, function(response) {
			$scope.atbilde = "Radās kļūda sūtot datus!";
		});
		 	}



		 };
		});


