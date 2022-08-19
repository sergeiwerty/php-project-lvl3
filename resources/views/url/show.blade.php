@extends('layouts.app')

@section('content')
    <table class="table border">
        <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>{{ $urlData->id}}</td>
        </tr>
        <tr>
            <th scope="row">Имя</th>
            <td>{{ $urlData->name }}</td>
        <tr>
            <th scope="row">Дата создания</th>
            <td>{{ $urlData->created_at }}</td>
        </tr>
        </tbody>
    </table>
    <h1>Проверки</h1>
    <form action="/urls/{{ $urlData->id }}/checks" method="POST">
        @csrf
        <input class="btn btn-primary" type="submit" value="Запустить проверку">
    </form>
    @if(isset($checks))
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Код ответа</th>
                <th scope="col">h1</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Дата создания</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($checks as $check)
                <tr>
                    <th scope="row">{{ $check->id }}</th>
                    <td>{{ $check->status_code }}</td>
                    <td>{{ $check->h1 }}</td>
                    <td>{{ $check->title }}</td>
                    <td>{{ $check->description }}</td>
                    <td>{{ $check->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection('content')