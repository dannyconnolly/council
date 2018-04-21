{{-- Editing the question --}}
<div class="panel panel-default" v-if="editing">
    <div class="panel-heading">

        <div class="level">
            <input type="text" class="form-control" v-model="form.title" /> 
        </div><!-- /.level -->
    </div><!-- /.panel-heading -->

    <div class="panel-body">
        <div class="form-group">
            <wysiwyg v-model="form.body"></wysiwyg>
        </div>
    </div><!-- /.panel-body -->
    
    <div class="panel-footer">
        <div class="level">
            <button class="btn btn-xs level-item" @click="editing = true" v-show="! editing">Edit</button>
            <button class="btn btn-xs btn-primary level-item" @click="update">Update</button>
            <button class="btn btn-xs level-item" @click="resetForm">Cancel</button>
            
            @can ('update', $thread)
            <form action="{{ $thread->path() }}" method="POST" class="ml-a">
                {{ csrf_field() }}

                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-link">Delete Thread</button>
            </form>
            @endcan
        </div><!-- /.level -->
    </div><!-- /.panel-footer -->
</div><!-- /.panel panel-default -->

{{-- Viewing the question --}}
<div class="panel panel-default" v-else>
    <div class="panel-heading">

        <div class="level">

            <img src="{{ $thread->creator->avatar_path }}" width="25" height="25" alt="{{ $thread->creator->name }}" class="mr-1" />

            <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted: 
                <span v-text="title"></span>
            </span>
        </div><!-- /.level -->
    </div><!-- /.panel-heading -->

    <div class="panel-body" v-html="body"></div><!-- /.panel-body -->
    
    <div class="panel-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-xs" @click="editing = true">Edit</button>
    </div><!-- /.panel-footer -->
</div><!-- /.panel panel-default -->