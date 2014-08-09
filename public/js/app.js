// Declare app level module which depends on filters, and services
angular.module('CivicDutyApp', [
	'ngRoute',
	'ngResource',
	'ngSanitize',
	'CivicDutyApp.filters',
	'CivicDutyApp.services',
	'CivicDutyApp.directives',
	'CivicDutyApp.controllers'
	])
.config(['$routeProvider', function($routeProvider) {
	$routeProvider.when('/', {templateUrl: 'partials/splashPage.html', controller: 'SplashCtrl'});
	$routeProvider.when('/home', {templateUrl: 'partials/home.html', controller: 'HomeCtrl'});
	$routeProvider.when('/profile/:id?', {templateUrl:'partials/profile.html', controller:'ProfileCtrl'});
	$routeProvider.when('/community', {templateUrl:'partials/community.html', controller: 'CommunityCtrl'});
	$routeProvider.when('/play', {templateUrl:'partials/play.html', controller: 'PlayCtrl'});
	$routeProvider.when('/activity-detail/:id', {templateUrl:'partials/activity-detail.html', controller: 'ActivityCtrl'});
	$routeProvider.otherwise({redirectTo: '/'});
}])
.config(function($httpProvider){
	var interceptor = function($rootScope,$location,$q,Flash){
		var success = function(response){
			return response
		}
		var error = function(response){
			if (response.status == 401){
				delete sessionStorage.authenticated
				$location.path('/')
				Flash.show(response.data.flash)
			}
			return $q.reject(response)
		}
		return function(promise){
			return promise.then(success, error)
		}
	}
	$httpProvider.responseInterceptors.push(interceptor)
})
.run(function($http,CSRF_TOKEN){
	$http.defaults.headers.common['csrf_token'] = CSRF_TOKEN;
	$http.defaults.headers.common['Access-Control-Allow-Origin'] = "*";
	$http.defaults.headers.common['Access-Control-Allow-Methods'] = "GET, POST, PUT, DELETE, OPTIONS";
	$http.defaults.headers.common['Access-Control-Allow-Headers'] = "Authorization";
});
// .run(function($http){
// 	$http.defaults.headers.common['Access-Control-Allow-Origin'] = "*";
// 	$http.defaults.headers.common['Access-Control-Allow-Methods'] = "GET, POST, PUT, DELETE, OPTIONS";
// 	$http.defaults.headers.common['Access-Control-Allow-Headers'] = "Authorization";
// });