angular.module('CivicDutyApp.directives', [])
.directive('appVersion', ['version', function(version) {
	return function(scope, elm, attrs) {
		elm.text(version);
	};
}])
.directive('loginForm', function(){
	return {
		templateUrl: 'partials/login.html',
		link: function(scope, elem){
			$("[ng-model='username']").focus();
		}
	}
})
.directive('splash', function(){
	return {
		templateUrl: 'partials/splash.html',
		link: function(scope, elem) {
			// $(".main").onepage_scroll(); // :(
			// elem.onepage_scroll();
			elem.bind("keydown keypress", function (event) {
				console.log('keydown', event);
			});
		}
	}
})
.directive('modal', function(){
	return {}
})
.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
 
                event.preventDefault();
            }
        });
    };
});;