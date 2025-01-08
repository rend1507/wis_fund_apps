@extends("layouts.loggedin")

@if(session("edit_id"))
@section('title', (ucwords(session("action_id") ?: "Edit" )).' Pengajuan '.session("edit_id"))
@else
@section('title', 'Tambah Pengajuan')
@endif

@section('content')
@include("content.ajuan.form")
@stop