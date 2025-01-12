@extends("layouts.loggedin")

@if(session("edit_id"))
@section('title', (ucwords(session("action_id") ?: "Edit" )).' User '.session("edit_id"))
@else
@section('title', 'Tambah User')
@endif

@section('content')
@include("content.user.form")
@stop