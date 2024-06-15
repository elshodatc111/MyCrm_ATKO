@extends('SuperAdmin.layout.home')
@section('title','Online Kurslar')
@section('content')

<main id="main" class="main">

<div class="pagetitle">
    <h1>Online Kurslar</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('SuperAdmin')}}">Bosh sahifa</a></li>
            <li class="breadcrumb-item active">Online Kurslar</li>
        </ol>
    </nav>
</div> 
    <section class="section dashboard">
        @if (Session::has('success'))
            <div class="alert alert-success">{{Session::get('success') }}</div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error') }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Online kurslar</h1>
                <div class="table-responsive">
                    <table class="table table-bordered text-center" style="font-size:14px">
                    <thead>
                        <tr>
                            <td class="bg-primary text-white">#</td>
                            <td class="bg-primary text-white">Filial kurs</td>
                            <td class="bg-primary text-white">Online kurs</td>
                            <td class="bg-primary text-white">Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($response as $value)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $value['cours_name'] }}</td>
                            <td>{{ $value['cours_name_api'] }}</td>
                            <td>
                                <a href="{{ route('online_update',$value['id']) }}">
                                    <i class="bi bi-gear"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection