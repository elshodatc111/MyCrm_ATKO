@extends('User.layout.app')
@section('title',"Online Cours")
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Online Cours</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('User') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user_online') }}">Online kurslar</a></li>
                <li class="breadcrumb-item active">Kurs mavzulari</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $Mavzu['mavzu_name'] }}</h3>
                        <div class="main-video">
                            <div class="video">
                                <video src="{{ $Mavzu['mavzu_video'] }}" style="width:100%;" id="myvideo" controls muted controlsList="nodownload"></video>
                            </div>
                        </div>
                        <p>{{ $Mavzu['mavzu_text'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Kurs mavzulari</h3>
                        <ul style="list-style:none;padding:0;">
                            @foreach($Mavzular as $item)
                            <li class="py-2" style="border-bottom:1px solid gray">
                                <a href="{{ route('user_online_lessen',$item['mavzu_id']) }}">{{ $item['mavzu_name'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


@endsection