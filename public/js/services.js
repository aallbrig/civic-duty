angular.module('CivicDutyApp.services', [])
.value('version', '0.1')
.value('currentUserId')
.factory('Authenticate', function ($resource){
	return $resource("http://localhost:8000/service/authenticate/");
})
.factory('Flash', function (){
	var message;
	return {
		show: function(message){
			message = message;
		}
	}
})
.factory('Users', function ($resource){
	return $resource("http://localhost:8000/v1/api/user/:id", null, {
           'update': { method:'PUT' }
       });
})
.factory('Activities', function ($resource){
	return $resource("http://localhost:8000/v1/api/activity/:id");
});
// angular.module('CivicDutyApp.services', [])
// .value('version', '0.1')
// .factory('Authenticate', function ($resource){
// 	return $resource("http://localhost:8000/service/authenticate/", {}, {
//          jsonpquery: { method: 'JSONP', params: {callback: 'JSON_CALLBACK'}, isArray: true }
//     });
// })
// .factory('Flash', function (){
// 	var message;
// 	return {
// 		show: function(message){
// 			message = message;
// 		}
// 	}
// })
// .factory('Users', function ($resource){
// 	return $resource("http://localhost:8000/v1/api/user/:id", {}, {
//          jsonpquery: { method: 'JSONP', params: {callback: 'JSON_CALLBACK'}, isArray: true }
//     });
// })
// .factory('Activities', function ($resource){
// 	return $resource("http://localhost:8000/v1/api/activity/:id", {}, {
//          jsonpquery: { method: 'JSONP', params: {callback: 'JSON_CALLBACK'}, isArray: true }
//     });
// });