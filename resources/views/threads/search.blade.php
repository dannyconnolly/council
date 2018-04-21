@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <ais-index
                app-id="{{ config('scout.algolia.id') }}"
                api-key="{{ config('scout.algolia.key') }}"
                index-name="threads"
                query="{{ request('q') }}"
                >
                <div class="col-md-8">                 
                    <ais-results>
                        <template slot-scope="{ result }">
                            <li>
                                <a :href="result.path">
                                    <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                                </a>
                            </li>
                        </template>
                    </ais-results>
                </div><!-- /.col-md-8 -->

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Search
                        </div><!-- /.panel-heading -->

                        <div class="panel-body">
                            <ais-search-box>
                                <ais-input placeholder="Find a thread..." :autofocus="autofocus" class="form-control"></ais-input>
                            </ais-search-box>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel.panel-default -->
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Filter By Channel
                        </div><!-- /.panel-heading -->

                        <div class="panel-body">
                            <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>
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
            </ais-index>
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
