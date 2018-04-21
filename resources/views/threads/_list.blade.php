@forelse ($threads as $thread)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <div class="flex">
                    <h4>
                        <a href="{{ $thread->path() }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <strong>{{ $thread->title }}</strong>
                            @else
                            {{ $thread->title }}
                            @endif
                        </a>
                    </h4>
                    
                    <h5>
                        Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                    </h5>
                </div><!-- /.flex -->

                <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
            </div><!-- /.level -->
        </div><!-- /.panel-heading -->

        <div class="panel-body">                        
            <div class="body">{!! $thread->body !!}</div>
        </div><!-- /.panel-body -->

        <div class="panel-footer">
            {{ $thread->visits }} Visits
        </div><!-- /.panel-footer -->
    </div><!-- /.panel -->
@empty
    <p>There are no relevant results</p>
@endforelse