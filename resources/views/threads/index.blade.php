@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('threads._list')

                {{ $threads->render() }}
            </div><!-- /.col-md-8 -->

            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Search
                    </div><!-- /.panel-heading -->

                    <div class="panel-body">
                        <form action="/threads/search" method="GET">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." name="q" class="form-control"/>
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-default" type="submit">Search</button>
                            </div>
                        </form>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel.panel-default -->

                @if (count($trending))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Trending Threads
                        </div><!-- /.panel-heading -->

                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach ($trending as $thread)
                                    <li class="list-group-item">
                                        <a href="{{ url($thread->path) }}">
                                            {{ $thread->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel.panel-default -->
                @endif
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
