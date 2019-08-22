@extends('layouts.app')
@section('title')
    Welcome | Search Git Repositories
@endsection
@section('content')
    <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Search Git Repositories
                </div>
                @if(isset($message))
                    <h2>{{$message}}</h2>
                @endif
                <form action="/search" method="GET" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="hidden" class="form-control" name="page" value="1">
                        <input type="text" class="form-control" name="q" placeholder="Search Github">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                Search
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
@endsection
