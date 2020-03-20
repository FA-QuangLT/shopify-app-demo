@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <input type="text" class="daterange" />

                    <ul class="list-unstyled">
                        @foreach($products as $product)
                        <li class="media my-4">
                            <img src="{{ $product['image']['src'] }}" style="width: 50%" class="mr-3" alt="{{ $product['title'] }}">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">{{ $product['title'] }}</h5>
                                {!! $product['body_html'] !!}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('_js')
    <script type="text/javascript">
        $('.daterange').daterangepicker();
    </script>
@endsection
