@extends('layouts.front')

@if($count==0)

@section('title','Ads Banner')

@section('content1')

<div class="card mt-3">
  <div class="card-body">
		<h3>Maaf, Postingan Tidak Ditemukan</h3>
	</div>
</div>

@endsection

@else
@php $title =  $data[0]->gimmick_title @endphp
@section('title', $title)
@php $description =  $data[0]->meta_description @endphp
@section('description',$description)

@section('content1')
<div class="card mt-3 mb-3">
  <div class="card-body">
	@foreach($data as $gimmick)
		<h1>{{ $gimmick->gimmick_title }}</h1>
		<div class="text-muted" style="font-size: 12px; !important">
			<i class="fa fa-calendar"></i> {{ $gimmick->created_at }} <br>
	  </div>
		{!! $gimmick->description !!}
	@endforeach
	</div>
</div>

@endsection
@endif