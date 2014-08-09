var currentUserId = sessionStorage.currentUserId || '';
angular.module('CivicDutyApp.controllers', [])
.controller('AppCtrl', function ($scope){
	$scope.loggedIn = sessionStorage.authenticated || false;
	$scope.$on('loggedIn', function(){
		$scope.loggedIn = true;
	});
	$scope.$on('loggedOut', function(){
		$scope.loggedIn = false;
	});
})
.controller('NavCtrl', function ($scope){

})
.controller('SplashCtrl', function ($scope){
	$scope.loggedIn = sessionStorage.authenticated;
})
.controller('LoginCtrl', function ($scope, $location, $sanitize, Authenticate){
	$scope.login = function(){
		Authenticate.save({
			'username':$sanitize($scope.username),
			'password':$sanitize($scope.password)
		}, function(response){
			console.log('response');
			console.log(response);
			currentUserId = response.user.id;
			sessionStorage.currentUserId = response.user.id;
			console.log(currentUserId);
			$scope.flash = '';
			$location.path('/home');
			sessionStorage.authenticated = true;
			$scope.$emit('loggedIn');
		}, function(response){
			console.log('response');
			console.debug(response);
			$scope.flash = response.data.flash;
		});
	}
})
.controller('HomeCtrl', function ($scope, $location, Authenticate, Users){
	if (!sessionStorage.authenticated){
        $location.path('/');
    }
    console.log('currentUserId');
    console.log(currentUserId);
    $scope.currentUserId = currentUserId;
	$scope.logout = function (){
		Authenticate.get({},function(){
			delete sessionStorage.authenticated
			$location.path('/');
			$scope.$emit('loggedOut');
		})
	}
})
.controller('ProfileCtrl', function ($scope, Users, $routeParams){
	console.log('$routeParams');
	console.debug($routeParams);
	console.log($routeParams.id);
	// console.log(id);
	$scope.activityLimit = 10;
	Users.get({id:$routeParams.id}, function(user){
		console.log('user');
		console.debug(user);
		$scope.user = user;
	}, function(res){
		$scope.error = 'error';
	});
	$scope.getPercentage = function(){
		if($scope.user){
			if($scope.user.morality > 100){
				return 100;
			}
			if($scope.user.morality < -100){
				return 100;
			}
			return Math.abs($scope.user.morality);
		}
		return 50;
	}
	$scope.more = function(){
		if($scope.activityLimit > $scope.user.activities.length){
			return
		}
		$scope.activityLimit += 10;
	}
	$scope.less = function(){
		$scope.activityLimit = 10;
	}
})
.controller('PlayCtrl', function ($scope, Activities){
	$scope.showForm = false;
	$scope.activityLimit = 5;
	Activities.query(function(activities){
		$scope.activities = activities;
	});
	$scope.more = function(){
		if($scope.activityLimit > $scope.activities.length){
			return
		}
		$scope.activityLimit += 5;
	}
	$scope.less = function(){
		$scope.activityLimit = 5;
	}
})
.controller('CommunityCtrl', function ($scope, Users){
	Users.query(function(users){
		$scope.users = users;
	});
	$scope.activityLimit = 3;
	$scope.userLimit = 5;
	$scope.more = function(){
		if($scope.userLimit > $scope.users.length){
			return
		}
		$scope.userLimit += 5;
	}
	$scope.less = function(){
		$scope.userLimit = 5;
	}
})
.controller('ActivityCtrl', function ($scope, Activities, Users, $routeParams){
	var user;
	Activities.get({id:$routeParams.id || 0}, function(activity){
		$scope.activity = activity;
	});
	Users.get({id:currentUserId}, function(user){
		$scope.user = user;
		window.user = user;
	});
	$scope.completeActivity = function(){
		Users.update({id:currentUserId}, {aid:$scope.activity.id}, function(response){
			$scope.flash = response;
		});
	}
	$scope.alreadyComplete = function(){
		if(!$scope.user || !$scope.activity){
			return false;
		}
		for (var i = 0; i < $scope.user.activities.length; i++) {
			if($scope.user.activities[i].id == $scope.activity.id){
				return true;
			}
		};
		return false;
	}
})
.controller('NewActivityCtrl', function ($scope, Activities){
	function validatie (){
		$scope.newactivity;
	}
	$scope.addNewActivity = function(){
		if($scope.newActivityForm.$valid){
			Activities.save($scope.newactivity, function(resp){
				console.log(resp);
			});
			// alert('successfully created new activity');
		} else {
			alert('form not valid');
		}
	}
});