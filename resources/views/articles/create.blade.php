@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Neuen Artikel anlegen</h3>
            <hr>
            {!! Form::open(array('route' => 'articles.store')) !!}
                <div class="row">

                    <div class="col-md-6"> <!-- linke Spalte -->
                        
                {{-- <!--WARENGRUPPE-->
                        <div class="form-group row">
                            {{ Form::label('parent', 'Warengruppe :*', array('class'=> 'col-form-label col-sm-3'))}}
                            {{ Form::select('animal',
                            [
                            'Cats' => ['leopard' => 'Leopard2'],
                            'Dogs' => ['spaniel' => 'Spaniel','Dogs' => ['spaniel' => 'Spaniel']]
                            ]
                            , array('class'=>'form-control col-sm-8'))}}
                        </div> --}}

                <!--ARTNO-->
                        <div class="form-group row">
                            {{ Form::label('artno', 'Art-No :*', array('class'=> 'col-form-label col-sm-3'))}}
                            {{ Form::text('artno', null, array('class' => 'form-control col-sm-8')) }}
                        </div>
                        

                <!--NAME-->
                        <div class="form-group row">
                            {{ Form::label('name', 'Bezeichnung :*', array('class'=> 'col-form-label col-sm-3'))}}
                            {{ Form::text('name', null, array('class' => 'form-control col-sm-8')) }}
                        </div>

                {{-- <!--VK-->
                        <div class="form-group row">
                            {{ Form::label('vk', 'VK-Preis :*', array('class'=> 'col-form-label col-sm-3'))}}
                            {{ Form::text('vk', null, array('class' => 'form-control col-sm-8')) }}
                        </div> --}}
                    </div><!--ende linke Spalte-->


                    <div class="col-md-6"><!-- rechte Spalte -->
                        <div class="form-group row"> <!-- Checkboxen inline-->
                            <div class="col-md-3"></div>
                            <div class="md-8">
                <!--ACTIVE-->
                                {{ Form::checkbox('active', true, true, array('class' => 'form-check-input', 'id'=>'active')) }}
                                {{ Form::label('active', 'Aktiv', array('class'=> 'form-check-label'))}}
                            </div>
                        </div>
                <!--DESC1-->
                        <div class="form-group row">
                            {{ Form::label('desc1', 'Beschreibung :', array('class'=> 'col-form-label col-sm-3'))}}
                            {{ Form::textarea('desc1', null, array('class' => 'form-control col-sm-8', 'rows'=>3)) }}
                        </div>
                <!--VOL L B H-->
                        <div class="form-group row">
                            {{ Form::label('vol_l', 'Ma&szlig;e :', array('class'=> 'col-form-label col-sm-3'))}}
                            {{ Form::text('vol_l', null, array('class' => 'form-control col-sm-2', 'placeholder' => 'L in cm')) }}
                            {{ Form::text('vol_b', null, array('class' => 'form-control col-sm-2', 'placeholder' => 'B in cm')) }}
                            {{ Form::text('vol_h', null, array('class' => 'form-control col-sm-2', 'placeholder' => 'H in cm')) }}
                        </div>
                <!--WEIGHT-->
                        <div class="form-group row">
                                {{ Form::label('weight', 'Gewicht :', array('class'=> 'col-form-label col-sm-3'))}}
                                {{ Form::text('weight', null, array('class' => 'form-control col-sm-2', 'placeholder' => 'kg')) }}
                            </div>                   
                    </div><!--ende rechte Spalte-->


                </div>
            {{ Form::submit('Artikel anlegen', array('class'=>'btn btn-primary btn-lg btn-block'))}}
            {!! Form::close()!!}
        </div>
    </div>
@endsection