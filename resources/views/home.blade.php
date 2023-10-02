@extends('template\tmpl')

@section('content')
    @auth
        <div class="row text-center">
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="{{ route('category') }}">
                                <div class="col-xs-2">
                                    <i class="fa-solid fa-layer-group fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <h2>Category</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="{{ route('tasks') }}">
                                <div class="col-xs-2">
                                    <i class="fa-solid fa-list-check fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <h2>Tasks</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="{{ route('users') }}">
                                <div class="col-xs-2">
                                    <i class="fa-solid fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <h2>Users</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
