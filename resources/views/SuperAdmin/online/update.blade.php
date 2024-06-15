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
            <li class="breadcrumb-item active">Taxrirlash</li>
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
                <h1 class="card-title">Online kursni taxrirlash</h1>
                <form action="{{ route('online_update',$Cours->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 my-2">
                            <label for="">Kursning nomi</label>
                            <input type="text" class="form-control" disabled value="{{ $Cours->cours_name }}">
                            <input type="hidden" name="cours_id" value="{{ $Cours->id }}">
                        </div>
                        <div class="col-lg-6 my-2">
                            <label for="cours_id_api">Online kursni tanlang</label>
                            <select name="cours_id_api" class="form-select" required>
                                <option value="">Tanlang...</option>
                                @foreach($response as $value)
                                <option value="{{ $value->cours_id }}">{{ $value->cours_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 my-2">
                            <button class="btn btn-primary" type="submit">Saqlash</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>

@endsection