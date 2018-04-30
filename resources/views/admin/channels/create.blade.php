@extends('admin.layout.app')

@section('administration-content')
    <form method="POST" action="{{ route('admin.channels.store') }}">
        @include ('admin.channels._form', ['buttonText' => 'Add Channel'])
    </form>
@endsection