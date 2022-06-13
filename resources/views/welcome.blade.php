@extends('layouts.app')

@section('content')
    <canvas id="canvasElement"></canvas>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Welcome page</h1>
                    </div>
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
