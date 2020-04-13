@extends('layouts.app')

@section('content')
    
    <transition>
        <keep-alive>
            <router-view></router-view>
        </keep-alive>
    </transition>
    
@endsection
