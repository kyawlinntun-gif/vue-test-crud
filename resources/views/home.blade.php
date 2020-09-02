@extends('layouts.app')

@section('content')
    <div class="home">
        <router-view></router-view>
        <!-- set progressbar -->
        <vue-progress-bar></vue-progress-bar>
    </div>
@endsection
