@extends('layouts.app')

@section('header')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new thread</div>

                <div class="panel-body">

                    @if (count($errors))
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="/threads" method="POST" role="form">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="channel_id">Choose a Channel:</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">Choose one...</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}"{{ old('channel_id') == $channel->id ? ' selected' : ''}}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="Title" required />
                        </div>
                    
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <wysiwyg name="body"></wysiwyg>
                        </div>
                        
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LdKKVEUAAAAAKJhSWC0m5Env9p6sZBGD1QX6C0p"></div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
