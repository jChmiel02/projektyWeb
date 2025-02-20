document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myChart').getContext('2d');

    // Użyj pobranych kategorii jako etykiet
    const labels = kategorie.map(kategoria => kategoria.toLowerCase());

    // Oblicz sumę wszystkich dodatkowych dochodów
    const sumaDochodow = labels.reduce((total, kategoria) => total + (sumaDochodowKategorii[kategoria] || 0), 0);

    const data = {
        labels: labels,
        datasets: [{
            label: 'Udział kategorii',
            data: labels.map(kategoria => sumaDochodowKategorii[kategoria] || 0), // Użyj sum dochodów dla każdej kategorii jako dane na osi Y
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
                text: `Wykres przedstawiający udział poszczególnych kategorii w dodatkowych dochodach. Suma wszystkich dodatkowych dochodów: ${sumaDochodow}`

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
    const editLinks = document.querySelectorAll('.editDochod');
    const editFormContainer = document.getElementById('editFormContainer');

    editLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const dochodId = this.getAttribute('data-id');
            const dochodToEdit = document.querySelector(`.dochodItem[data-dochod-id="${dochodId}"]`);

            // Schowaj pozostałe dochody
            const dochod = document.querySelectorAll('.dochodItem');
            dochod.forEach(function(item) {
                if (item !== dochodToEdit) {
                    item.style.display = 'none';
                }
            });
            // Wypełnij formularz danymi wybranego dochodu
            document.getElementById('editKategoria').value = dochodToEdit.getAttribute('data-kategoria');
            document.getElementById('editKwota').value = dochodToEdit.getAttribute('data-kwota');
            document.getElementById('editNazwa').value = dochodToEdit.getAttribute('data-nazwa');
            document.getElementById('editDochodId').value = dochodId;

            // Wyświetl formularz edycji
            editFormContainer.style.display = 'block';
            dochodForm.style.display = 'none';

        });
    });
});
