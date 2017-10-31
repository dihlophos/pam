@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Hi, {{ Auth::user()->displayname }}!</p>
                    <p>Admin: {{ Auth::user()->isAdmin()?"Yes":"No" }}</p>
                    <my-component></my-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
