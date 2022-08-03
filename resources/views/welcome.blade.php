@extends('layouts.app')
@section('content')
    <div class="col col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
        <p for="exampleInputEmail1" class="form-label">Бесплатно проверяйте сайты на SEO пригодность</p>
        <form class="d-flex justify-content-center" action="/urls" method="POST">
            @csrf
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="url[name]">
            <input type="submit" class="btn btn-primary" value="Проверить">
        </form>
    </div>
@endsection('content')
