<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz logowania</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link href="{{ asset('/CSS/loginStyle.css') }}" rel="stylesheet">

</head>
<body>

<nav class="navbar sticky-top navbar-expand-md menuBarContainer">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarToggler01">
            <h2 class="navbar-brand mb-0">Formularz logowania</h2>
        </div>
    </div>
</nav>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<div class="container">
    <form action="{{ url('login') }}" method="POST" class="w-50">
        @csrf
        <div class="mb-3">
            <label for="nazwa" class="form-label"><strong>Podaj swój login</strong></label>
            <input type="text" name="nazwa" id="nazwa" placeholder="Nazwa użytkownika" class="form-control"/>
        </div>
        <div class="mb-3">
            <label for="haslo" class="form-label"><strong>Podaj swoje hasło</strong></label>
            <input type="password" name="haslo" id="haslo" placeholder="Hasło" class="form-control"/>
        </div>
        <button type="submit" class="btn btn-primary">Zaloguj</button>
    </form>
    <div class="mt-3 text-center">
        <p>Nie masz konta? <span class="register-link" onclick="window.location.href='{{ url('/rejestracja') }}'">Załóż je!</span>
        </p>
    </div>
</div>
</body>
</html>
