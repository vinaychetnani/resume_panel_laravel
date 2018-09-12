@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Resume Details</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => 'parseform']) !!}

                        <div class="form-group">
                            {!! Form::label('r_id', 'Resume Id') !!}
                            {!! Form::text('r_id', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('benchmark', 'Benchmark') !!}
                            {!! Form::text('benchmark', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('community', 'Community') !!}
                            {!! Form::text('community', null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection