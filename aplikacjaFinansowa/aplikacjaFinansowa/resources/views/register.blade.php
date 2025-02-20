<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rejestracja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link href="{{ asset('/CSS/registerStyle.css') }}" rel="stylesheet">
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<nav class="navbar sticky-top navbar-expand-md menuBarContainer">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarToggler01">
            <h2 class="navbar-brand mb-0">Wypełnij formularz rejestracyjny</h2>
        </div>
    </div>
</nav>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <form action="rejestracja" method="POST" id="registrationForm" class="w-75">
        @csrf
        <div class="mb-3">
            <label for="nazwa" class="form-label"><strong>Podaj swój login</strong></label>
            <input type="text" name="nazwa" id="nazwa" placeholder="Nazwa użytkownika" class="form-control"/>
            <span id="nazwa-feedback" class="mt-2"></span>
        </div>
        <div class="mb-3">
            <label for="haslo" class="form-label"><strong>Podaj swoje hasło</strong></label>
            <input type="password" name="haslo" id="haslo" placeholder="Hasło" class="form-control"/>
            <span id="haslo-feedback" class="mt-2"></span>
        </div>
        <div class="mb-3">
            <label for="wiek" class="form-label"><strong>Podaj swój wiek</strong></label>
            <input type="number" name="wiek" id="wiek" placeholder="Wiek" class="form-control"/>
        </div>

        <button type="submit" class="btn btn-primary">Zarejestruj</button>
    </form>
</div>

</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('/JS/registerScript.js') }}"></script>

