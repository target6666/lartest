@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-md-12">
            <h3>Warengruppen</h3>
            <hr>
            <div class=tree>
                {!! $categories !!}
            </div>
        </div>
    </div>
@endsection