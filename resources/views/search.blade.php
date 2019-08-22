<!-- include default template -->
@extends('layouts.app')

<!-- Set Page Title -->
@section('title')
    Search Results | {{$query}}
@endsection

<!-- Display Main Content -->
@section('content')
    <div class="content">
        <div class="container">
             <div class="row">
                <div class="col-md-12">
                    <div class="title m-b-md">
                        Repository for Search {{$query}}
                    </div>
                    <div class="m-b-md">
                        <h4>Total Repositories Found {{number_format($total)}}</h4>
                    </div>
                </div>
            </div>
            <!-- Paggnation NavBar -->
            <div class="row">
                <div class="col-xs-12">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        @if($current > 1)
                            <li class="page-item"><a class="page-link" href="/search?&q={{$query}}&page={{$current-1}}">Previous</a></li>
                        @endif
                        <li class="page-item"><a class="page-link" href="/search?&q={{$query}}&page={{$current}}">{{$current}}</a></li>
                        <li class="page-item"><a class="page-link" href="/search?&q={{$query}}&page={{$current+1}}">{{$current+1}}</a></li>
                        <li class="page-item"><a class="page-link" href="/search?&q={{$query}}&page={{$current+2}}">{{$current+2}}</a></li>
                        @if($current < $total/$limit)
                            <li class="page-item"><a class="page-link" href="/search?&q={{$query}}&page={{$current+1}}">Next</a></li>
                        @endif
                      </ul>
                    </nav>
                </div>
            </div>
            <!-- End Paggnation NavBar -->
            <!-- Show Repository Table -->
            <div class="row">
                <div class="col-md-8">
                    @if(isset($repositories))
                        <h2>Repository Results </h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Repository</th>
                                    <th>Username</th>
                                    <th>Description</th>
                                    <th>Starts</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repositories as $repository)
                                    <tr>
                                        <td><a href="{{$repository->html_url}}">{{$repository->name}}</a></td>
                                        <td>{{$repository->owner->login}}</td>
                                        <td>{{$repository->description}}</td>
                                        <td>{{$repository->stargazers_count}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <!-- End Show Repository Table -->
                <!-- Show Search Overview by Language -->
                <div class="col-md-4">
                    @if(isset($languages))
                        <h2>Languages</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Language</th>
                                    <th>Repositories</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($languages as $language=>$repo)
                                    <tr>
                                        <td><a href="https://github.com/search?l={{$language}}&q={{$query}}&type=Repositories">{{$language}}</a></td>
                                        <td>{{$repo}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <!-- End Show Search Overview by Language -->
        </div>
    </div>
@endsection
