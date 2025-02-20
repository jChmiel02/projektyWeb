$(document).ready(function() {
    $('#nazwa').on('input', function() {
        var nazwa = $(this).val();
        $.ajax({
            url: '/check-username',
            type: 'GET',
            data: {
                nazwa: nazwa
            },
            success: function(response) {
                if (response.available) {
                    $('#nazwa-feedback').text('Nazwa użytkownika jest wolna.').removeClass('text-danger').addClass('text-success');
                } else {
                    $('#nazwa-feedback').text('Nazwa użytkownika jest zajęta.').removeClass('text-success').addClass('text-danger');
                }
            }
        });
    });

    $('#haslo').on('input', function() {
        var haslo = $(this).val();
        var hasloOK = true;

        // Sprawdzenie długości hasła
        if (haslo.length < 9) {
            $('#haslo-feedback').text('Hasło musi zawierać co najmniej 9 znaków.').removeClass('text-success').addClass('text-danger');
            hasloOK = false;
        } else {
            $('#haslo-feedback').text('').removeClass('text-danger').addClass('text-success');
        }

        // Sprawdzenie czy hasło zawiera co najmniej jedną małą literę, jedną dużą literę, jedną cyfrę oraz jeden znak specjalny.
        var regexLowercase = /[a-z]/;
        var regexUppercase = /[A-Z]/;
        var regexDigit = /\d/;
        var regexSpecial = /[@$!%*?&]/;

        if (!regexLowercase.test(haslo)) {
            $('#haslo-feedback').append('<br>Hasło musi zawierać co najmniej jedną małą literę.').removeClass('text-success').addClass('text-danger');
            hasloOK = false;
        }
        if (!regexUppercase.test(haslo)) {
            $('#haslo-feedback').append('<br>Hasło musi zawierać co najmniej jedną dużą literę.').removeClass('text-success').addClass('text-danger');
            hasloOK = false;
        }
        if (!regexDigit.test(haslo)) {
            $('#haslo-feedback').append('<br>Hasło musi zawierać co najmniej jedną cyfrę.').removeClass('text-success').addClass('text-danger');
            hasloOK = false;
        }
        if (!regexSpecial.test(haslo)) {
            $('#haslo-feedback').append('<br>Hasło musi zawierać co najmniej jeden znak specjalny.').removeClass('text-success').addClass('text-danger');
            hasloOK = false;
        }

        if (hasloOK) {
            $('#haslo-feedback').append('<br>Hasło spełnia wszystkie wymagania.').removeClass('text-danger').addClass('text-success');
        }
    });
});
