@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Имя</th>
            <th scope="col">Последняя проверка</th>
            <th scope="col">Код ответа</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($urls as $url)
            <tr>
                <th scope="row">{{ $url->id }}</th>
                <td>{{ $url->name }}</td>
                <td>{{ is_null($url->check) ? '' : $url->check->created_at }}</td>
                <td>{{ is_null($url->check) ? '' : $url->check->status_code }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection('content')