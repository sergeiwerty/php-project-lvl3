@extends('layouts.app')

@section('content')
    <table class="table">
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
@endsection('content')