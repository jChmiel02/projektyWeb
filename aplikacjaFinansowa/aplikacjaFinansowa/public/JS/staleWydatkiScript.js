document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myChart').getContext('2d');

    // Użyj pobranych kategorii jako etykiet
    const labels = kategorie.map(kategoria => kategoria.toLowerCase());

    // Oblicz sumę wszystkich dodatkowych dochodów
    const sumaWydatkow= labels.reduce((total, kategoria) => total + (sumaDochodowKategorii[kategoria] || 0), 0);

    const data = {
        labels: labels,
        datasets: [{
            label: 'Udział kategorii',
            data: labels.map(kategoria => sumaDochodowKategorii[kategoria] || 0),
            backgroundColor: [
                'rgba(178, 102, 255, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(153, 102, 255, 0.5)'
            ],
            hoverBackgroundColor: [
                'rgba(128, 56, 184, 0.8)',
                'rgba(38, 115, 169, 0.8)',
                'rgba(184, 40, 65, 0.8)',
                'rgba(184, 140, 26, 0.8)',
                'rgba(0, 109, 109, 0.8)',
                'rgba(165, 82, 0, 0.8)',
                'rgba(87, 59, 148, 0.8)'
            ],
            borderWidth: 1
        }]
    };

    const options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: {
                display: true,
                text: `Wykres przedstawiający udział poszczególnych kategorii w stałych wydatkach. Suma wszystkich stałych wydatków: ${sumaWydatkow}`

            }
        }
    };

    const myChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });


    // Obsługa zdarzenia kliknięcia przycisku
    const toggleChartBtn = document.getElementById('toggleChartBtn');
    toggleChartBtn.addEventListener('click', function() {
        const chartContainer = document.getElementById('chartContainer');
        if (chartContainer.style.display === 'none') {
            chartContainer.style.display = 'block';
        } else {
            chartContainer.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const editLinks = document.querySelectorAll('.editWydatek');
    const editFormContainer = document.getElementById('editFormContainer');

    editLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const wydatekId = this.getAttribute('data-id');
            const wydatekToEdit = document.querySelector(`.wydatekItem[data-wydatek-id="${wydatekId}"]`);

            // Schowaj pozostałe wydatki
            const staleWydatki = document.querySelectorAll('.wydatekItem');
            staleWydatki.forEach(function(item) {
                if (item !== wydatekToEdit) {
                    item.style.display = 'none';
                }
            });
            // Wypełnij formularz danymi wybranego wydatku
            document.getElementById('editKategoria').value = wydatekToEdit.getAttribute('data-kategoria');
            document.getElementById('editKwota').value = wydatekToEdit.getAttribute('data-kwota');
            document.getElementById('editNazwa').value = wydatekToEdit.getAttribute('data-nazwa');
            document.getElementById('editWydatekId').value = wydatekId;

            // Wyświetl formularz edycji
            editFormContainer.style.display = 'block';
            staleWydatkiForm.style.display = 'none';

        });
    });
});
