@extends('layouts.app')

@section('content')
    @isset($conversation)
        <conversations-dashboard :id="{{ $conversation->id }}"></conversations-dashboard>
    @else
        <conversations-dashboard></conversations-dashboard>
    @endisset
@endsection
