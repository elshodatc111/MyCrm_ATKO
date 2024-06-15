@extends('User.layout.app')
@section('title',"Online Cours")
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Online Cours</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('User') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Online Cours</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            @foreach($Guruhlar as $value)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title w-100 text-center">{{ $value['cours_name'] }}</h2>
                        <a href="{{ route('user_online_show',$value['cours_id']) }}" class="btn btn-success text-white w-100">Darslarni boshlash</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection