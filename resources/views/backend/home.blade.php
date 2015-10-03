@extends('master')
@section('title', 'Admin Control Panel')

@section('content')

    <div class="container">
        <div class="row banner">

            <div class="col-md-12">

                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="mdi-social-person"></i>
                        </div>
                        <div class="row-content">
                            <div class="action-secondary"><i class="mdi-social-info"></i></div>
                            <h4 class="list-group-item-heading">Manage Users</h4>
                            <a href="/admin/users" class="btn btn-default btn-raised">All Users</a>
                            <a href="/admin/users/excel" class="btn btn-info btn-raised">Excel</a>
                            <a href="/admin/users/pdf" target="_blank" class="btn btn-success btn-raised">PDF</a>
                            {{--<a href="/admin/users/screen" target="_blank" class="btn btn-active btn-raised">Screen</a>--}}
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="mdi-social-group"></i>
                        </div>
                        <div class="row-content">
                            <div class="action-secondary"><i class="mdi-material-info"></i></div>
                            <h4 class="list-group-item-heading">Manage Roles</h4>
                            <a href="/admin/roles" class="btn btn-default btn-raised">All Roles</a>
                            <a href="/admin/roles/create" class="btn btn-primary btn-raised">Create A Role</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="mdi-editor-border-color"></i>
                        </div>
                        <div class="row-content">
                            <div class="action-secondary"><i class="mdi-material-info"></i></div>
                            <h4 class="list-group-item-heading">Manage Posts</h4>
                            <a href="/admin/posts" class="btn btn-default btn-raised">All Posts</a>
                            <a href="/admin/posts/create" class="btn btn-primary btn-raised">Create A Post</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="mdi-file-folder"></i>
                        </div>
                        <div class="row-content">
                            <div class="action-secondary"><i class="mdi-material-info"></i></div>
                            <h4 class="list-group-item-heading">Manage Categories</h4>
                            <a href="/admin/categories" class="btn btn-default btn-raised">All Categories</a>
                            <a href="/admin/categories/create" class="btn btn-primary btn-raised">New Category</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="mdi-av-my-library-books"></i>
                        </div>
                        <div class="row-content">
                            <div class="action-secondary"><i class="mdi-material-info"></i></div>
                            <h4 class="list-group-item-heading">View Logs</h4>
                            <a href="/logs" class="btn btn-warning btn-raised btn-lg" target="_blank">Errors & Warnings</a>
                            <a href="/audits" class="btn btn-info btn-raised btn-lg" target="_blank">Audit Trail</a>
                            <a href="/queries" class="btn btn-success btn-raised btn-lg" target="_blank">All Queries</a>
                            <a href="/slowQueries" class="btn btn-danger btn-raised btn-lg" target="_blank">Slow Queries</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

