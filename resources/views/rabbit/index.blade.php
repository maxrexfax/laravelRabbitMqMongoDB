@extends('layouts.app')

@section('content')
    <canvas id="canvasElement"></canvas>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Enter message</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rabbit.send.post')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message to send') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="" required>
                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send message') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

