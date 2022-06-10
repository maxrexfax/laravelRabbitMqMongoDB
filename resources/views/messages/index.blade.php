@extends('layouts.app')

@section('content')
    <canvas id="canvasElement"></canvas>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>List of messages</h1>
                    </div>
                    <div class="card-body">
                        @foreach($messages as $message)
                            <p>{{$message->message}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

