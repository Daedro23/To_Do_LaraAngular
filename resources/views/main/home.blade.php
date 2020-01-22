@section('content')
<div class="container" ng-controller="TodoList">
    <button ng-click="openModal()" class="btn btn-md btn-success">New Task</button>
    <div class="marg">
        <table id="tabla" class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
            <tr ng-repeat="task in model | orderBy:'id'">
                <td>@{{task.id}}</td>
                <td>@{{task.name}}</td>
                <td>@{{task.description}}</td>
                <td>
                    <button class="btn btn-sm btn-primary" ng-click="editTask(task.id)">Edit</button >
                    <button class="btn btn-sm btn-danger" ng-click="delete(task.id)">Delete</button >
                </td>
            </tr>
        </tbody>
        </table>		
    </div>


    <!--Modal new task -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModal-label">Add task</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form ng-submit="save()" role="form" name="FormAdd" novalidate>
                <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label>
                            <input type="text" required name="AddName" class="form-control" ng-model="AddName">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea type="text" required name="AddDescription" class="form-control" ng-model="AddDescription" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" ng-disabled="!FormAdd.$valid" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit task -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModal-label">Edit task</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label>
                            <input type="text" name="edit_task.name" ng-model="edit_task.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea type="text" name="edit_task.description" ng-model="edit_task.description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" ng-click="update()">Edit</button>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection