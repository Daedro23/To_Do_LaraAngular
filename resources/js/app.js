import '../../node_modules/angular/index';
import '@popperjs/core';

var Todo = angular.module('TodoList', [])

Todo.controller('TodoList', ['$scope', '$http', function ($scope, $http) {

    this.$onInit = function () {
        $scope.getTask();
        }

    $scope.getTask = function () {
        $http({
            method: 'GET',
            url: '/api/tasks'
          }).then(function successCallback(response) {
            $scope.model = response.data;
        });
    }

    $scope.openModal = function () {
        $scope.resetForm();
        $("#modal-add").modal('show');
    };

    $scope.resetForm = function () {
        this.AddName = ''; 
        this.AddDescription = '';
    };

      $scope.save = function() {
        $http({
            method: 'POST',
            url: '/api/tasks',
            data: { 
                name: this.AddName,
                description: this.AddDescription 
            },
            headers: {'Content-Type': 'application/json '}
        }).then(function success() {
            $scope.getTask();
            toastr.success('Task added');
        });
        $("#modal-add").modal('hide');
        }

        $scope.delete = function(id) {
            if (confirm('Are you sure you want to delete this task?')) {
                $http({
                    method: 'DELETE',
                    url: 'api/tasks/'+id,
                    data: {
                        id: this.task.id,
                        name : this.task.name,
                        description: this.task.description 
                    },
                    headers: {
                        'Content-type': 'application/json;charset=utf-8'
                    }
                }).then(function success() {
                    toastr.success('Task delete');
                    $scope.getTask();
                });
            }
        }
        $scope.edit_task = {};
        $scope.editTask = function () {
            $scope.edit_task = this.task;
            $("#modal-edit").modal('show');
        };

        $scope.update = function () {
            $http.patch('api/tasks/' + $scope.edit_task.id, {
                name: $scope.edit_task.name,
                description: $scope.edit_task.description
            }).then(function success() {
                $scope.getTask();
                toastr.success('Task update');
                $("#modal-edit").modal('hide');
            });
        };

}]);
