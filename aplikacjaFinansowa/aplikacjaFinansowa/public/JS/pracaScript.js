document.addEventListener('DOMContentLoaded', function () {
    const viewChartButtons = document.querySelectorAll('.viewChart');

    viewChartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const pracaId = this.getAttribute('data-praca-id');
            const wynPracy = wynagrodzenia.filter(wyn => wyn.id_pracy === parseInt(pracaId));

            // Usuń wszystkie wykresy z modalu
            const modalBody = document.querySelector('.modal-body');
            modalBody.innerHTML = '';

            // Tworzymy kontener dla wykresu
            const chartContainer = document.createElement('div');
            chartContainer.classList.add('chart-container');

            // Tworzymy canvas dla wykresu
            const canvas = document.createElement('canvas');
            canvas.style.width = '100%';
            canvas.style.height = 'auto';
            chartContainer.appendChild(canvas);

            // Tworzymy etykiety i dane dla wykresu
            const labels = ['Ubezpieczenie Emerytalne', 'Ubezpieczenie Rentowe', 'Chorobowe', 'Ubezpieczenie Zdrowotne', 'Zaliczka na PIT', 'Wynagrodzenie Netto'];
            const data = [
                wynPracy[0].ubezpieczenie_emerytalne,
                wynPracy[0].ubezpieczenie_rentowe,
                wynPracy[0].chorobowe,
                wynPracy[0].ubezpieczenie_zdrowotne,
                wynPracy[0].zaliczka_na_pit,
                wynPracy[0].wynagrodzenie_netto
            ];

            // Tworzymy dane dla wykresu
            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Dane wynagrodzenia',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Tworzymy opcje dla wykresu
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            // Tworzymy nowy wykres kołowy
            new Chart(canvas, {
                type: 'bar',
                data: chartData,
                options: chartOptions
            });

            // Dodajemy wykres do modalu
            modalBody.appendChild(chartContainer);
        });
    });
});

function showStudentCheckbox() {
    var typUmowy = document.getElementById("typ_umowy").value;
    var studentCheckbox = document.getElementById("student_uczen_block");

    if (typUmowy === "umowa_zlecenie") {
        studentCheckbox.style.display = "block";
    } else {
        studentCheckbox.style.display = "none";
    }
}

function showStudentCheckboxEdit() {
    var typUmowy = document.getElementById("edit_typ_umowy").value;
    var studentCheckbox = document.getElementById("student_uczen_block_edit");

    if (typUmowy === "umowa_zlecenie") {
        studentCheckbox.style.display = "block";
    } else {
        studentCheckbox.style.display = "none";
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const editLinks = document.querySelectorAll('.editPraca');
    const editFormContainer = document.getElementById('editFormContainer');

    editLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const pracaId = this.getAttribute('data-id');
            const pracaToEdit = document.querySelector(`.pracaItem[data-praca-id="${pracaId}"]`);

            // Schowaj pozostałe prace
            const praca = document.querySelectorAll('.pracaItem');
            praca.forEach(function (item) {
                if (item !== pracaToEdit) {
                    item.style.display = 'none';
                }
            });

            // Wypełnij formularz danymi wybranej pracy
            document.getElementById('edit_nazwa').value = pracaToEdit.getAttribute('data-nazwa');
            document.getElementById('edit_liczba_godzin').value = pracaToEdit.getAttribute('data-liczba_godzin');
            document.getElementById('edit_ilosc_dni').value = pracaToEdit.getAttribute('data-ilosc_dni');
            document.getElementById('edit_stawka_godzinowa').value = pracaToEdit.getAttribute('data-stawka_godzinowa');
            document.getElementById('edit_typ_umowy').value = pracaToEdit.getAttribute('data-typ_umowy');
            const student_uczen = pracaToEdit.getAttribute('data-student_uczen');
            document.getElementById('edit_student_uczen').checked = student_uczen === "1";
            document.getElementById('editPracaId').value = pracaId;


            // Wyświetl formularz pracy
            editFormContainer.style.display = 'block';
            dodajPracaForm.style.display = 'none';
        });
    });
});
