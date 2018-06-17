@extends('layouts.app')

@section('content')
    <h3>Warengruppen</h3>
    <hr>
    <div class=tree>
        {!! $categories !!}
    </div>
@endsection