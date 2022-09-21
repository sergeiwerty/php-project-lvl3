<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6610f2; opacity: .8">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Анализатор страниц</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('urls.index') }}">Сайты</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@include('flash::message')
@if($errors->any())
    <div class="alert alert-danger w-100 p-3">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif