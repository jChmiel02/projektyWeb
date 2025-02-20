document.addEventListener('DOMContentLoaded', function() {
    // Wykres dla dochodów
    const ctxDochody = document.getElementById('wykresDochodow').getContext('2d');
    const dataDochody = {
        labels: Object.keys(dochody),
        datasets: [{
            label: 'Dochody',
            data: Object.values(dochody),
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(220, 220, 220, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsDochody = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres dochodów dla aktualnego miesiąca'
            }
        }
    };

    const wykresDochodow = new Chart(ctxDochody, {
        type: 'pie',
        data: dataDochody,
        options: optionsDochody
    });

    // Wykres dla wydatków

    const ctxWydatki = document.getElementById('wykresWydatkow').getContext('2d');
    const dataWydatki = {
        labels: Object.keys(wydatki),
        datasets: [{
            label: 'Wydatki',
            data: Object.values(wydatki),
            backgroundColor: [
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(220, 220, 220, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsWydatki = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres wydatków dla aktualnego miesiąca'
            }
        }
    };

    const wykresWydatkow = new Chart(ctxWydatki, {
        type: 'pie',
        data: dataWydatki,
        options: optionsWydatki
    });

// Wykres dla dochodów miesiecznych
    const ctxDochodyM = document.getElementById('wykresDochodowM').getContext('2d');
    const dataDochodyM = {
        labels: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
        datasets: [{
            label: 'Dochody',
            data: sumyDochodow,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsDochodyM = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres dodatkowych dochodów miesięcznych na przestrzeni 12 miesięcy'
            },
            legend: {
                display: false
            }
        }
    };

    const wykresDochodowM = new Chart(ctxDochodyM, {
        type: 'bar',
        data: dataDochodyM,
        options: optionsDochodyM
    });

// Wykres dla najwyższych dochodów w typie doughnut na podstawie nazw
    const ctxNajwyzszeDochody = document.getElementById('wykresNajwyzszychDochodow').getContext('2d');
    const dataNajwyzszeDochody = {
        labels: najwyzszeDochodyNazwy,
        datasets: [{
            label: 'Najwyższy dodatkowy dochód w miesiącu',
            data: najwyzszeDochodyKwoty,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsNajwyzszeDochody = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres przedstawiający udział najwyżsyzch kwot i ich nazw z każdego miesiąca'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        const index = tooltipItem.index;
                        const label = data.labels[index];
                        const value = data.datasets[tooltipItem.datasetIndex].data[index];
                        return `Nazwa: ${label}, Kwota: ${value}`;
                    }
                }
            }
        }
    };

    const wykresNajwyzszychDochodow = new Chart(ctxNajwyzszeDochody, {
        type: 'doughnut',
        data: dataNajwyzszeDochody,
        options: optionsNajwyzszeDochody
    });


    // Wykres dla najwyższych dochodów na postwie miesiecy
    const ctxNajwyzszeDochodyM = document.getElementById('wykresNajwyzszychDochodowM').getContext('2d');
    const dataNajwyzszeDochodyM = {
        labels: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
        datasets: [{
            label: 'Najwyższy dodatkowy dochód w miesiącu',
            data: najwyzszeDochodyKwoty,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsNajwyzszeDochodyM = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres przedstawiający najwyższą kwotę dodatkowego dochodu na przestrzeni 12 miesięcy'
            },
            legend: {
                display: false
            }
        }
    };
    const wykresNajwyzszychDochodowM = new Chart(ctxNajwyzszeDochodyM, {
        type: 'bar',
        data: dataNajwyzszeDochodyM,
        options: optionsNajwyzszeDochodyM
    });

// Mapowanie cyfr miesięcy na nazwy miesięcy
    const nazwyMiesiecy = {
        1: 'Styczeń',
        2: 'Luty',
        3: 'Marzec',
        4: 'Kwiecień',
        5: 'Maj',
        6: 'Czerwiec',
        7: 'Lipiec',
        8: 'Sierpień',
        9: 'Wrzesień',
        10: 'Październik',
        11: 'Listopad',
        12: 'Grudzień'
    };
// Konwersja miesięcy na nazwy miesięcy
    const etykiety = labels.map(miesiac => nazwyMiesiecy[miesiac]);

// Wykres dla sumy dochodów i wydatków
    const ctxDochodyWydatki = document.getElementById('wykresDochodowWydatkow').getContext('2d');
    const dataDochodyWydatki = {
        labels: etykiety,
        datasets: [
            {
                label: 'Dochody',
                data: sumaDochodow,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderWidth: 1
            },
            {
                label: 'Wydatki',
                data: sumaWydatkow,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderWidth: 1
            }
        ]
    };

    const optionsDochodyWydatki = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres przedstawiający sumę dochdów i sumę wydatków na przestrzeni 12 miesięcy'
            }
        }
    };

    const wykresDochodowWydatkow = new Chart(ctxDochodyWydatki, {
        type: 'bar',
        data: dataDochodyWydatki,
        options: optionsDochodyWydatki
    });

// Wykres dla różnicy pomiędzy dochodami a wydatkami
    const ctxRoznica = document.getElementById('wykresRoznica').getContext('2d');
    const dataRoznica = {
        labels: etykiety,
        datasets: [
            {
                label: 'Różnica',
                data: różnicaDochodowWydatkow,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: false,
                pointRadius: 5,
                pointHoverRadius: 7
            }
        ]
    };

    const optionsRoznica = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Różnica pomiędzy Dochodami a Wydatkami na przestrzeni 12 miesięcy'
            },
            legend: {
                display: false
            }

        }

    };

    const wykresRoznica = new Chart(ctxRoznica, {
        type: 'line',
        data: dataRoznica,
        options: optionsRoznica
    });

    // Wykres dla najwyższych wydatków na postwie miesiecy
    const ctxNajwyzszeWydatkiM = document.getElementById('wykresNajwyzszychWydatkowM').getContext('2d');
    const dataNajwyzszeWydatkiM = {
        labels: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
        datasets: [{
            label: 'Suma wydatków miesięcznych',
            data: najwyzszeWydatkiKwoty,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsNajwyzszeWydatkiM = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres przedstawiający sumę wydatków miesięcznych na przestrzeni 12 miesięcy'
            },
            legend: {
                display: false
            }
        }
    };

    const wykresNajwyzszychWydatkuM = new Chart(ctxNajwyzszeWydatkiM, {
        type: 'bar',
        data: dataNajwyzszeWydatkiM,
        options: optionsNajwyzszeWydatkiM
    });

    // Wykres dla najwyższych wydatkow w typie doughnut na podstawie nazw
    const ctxNajwyzszeWydatki = document.getElementById('wykresNajwyzszychWydatki').getContext('2d');
    const dataNajwyzszeWydatki = {
        labels: najwyzszeWydatkiNazwy,
        datasets: [{
            label: 'Najwyższa kwota wydatku ',
            data: najwyzszeWydatkiKwoty,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsNajwyzszeWydatki = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres przedstawiający najwyższą kwotę wraz z jego nazwą dla każdego miesiąca na przestrzeni 12 miesięcy'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        const index = tooltipItem.index;
                        const label = data.labels[index];
                        const value = data.datasets[tooltipItem.datasetIndex].data[index];
                        return `Nazwa: ${label}, Kwota: ${value}`;
                    }
                }
            }
        }
    };

    const wykresNajwyzszychWydatki= new Chart(ctxNajwyzszeWydatki, {
        type: 'doughnut',
        data: dataNajwyzszeWydatki,
        options: optionsNajwyzszeWydatki
    });

    // Wykres dla wydatkow miesiecznych
    const ctxWydatkiM = document.getElementById('wykresWydatkiM').getContext('2d');

    const dataWydatkiM = {
        labels: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
        datasets: [{
            label: 'Najwyższy wydatek w miesiącu',
            data: najwyzszeWydatkiKwoty,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderWidth: 1
        }]
    };

    const optionsWydatkiM = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            title: {
                display: true,
                text: 'Wykres przedstwiający kwotę najwyższego wydatku w miesiącu na przestrzeni 12 miesięcy'
            },
            legend: {
                display: false
            }
        }
    };

    const wykresWydatkiM = new Chart(ctxWydatkiM, {
        type: 'bar',
        data: dataWydatkiM,
        options: optionsWydatkiM
    });

    // Wykres oszczędności miesięcznych
    var ctx = document.getElementById('oszczednosciMiesieczneChart').getContext('2d');
    var oszczednosciMiesieczneChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: oszczednosciMiesieczneLabels,
            datasets: [{
                label: 'Oszczędności miesięczne',
                data: oszczednosciMiesieczneKwoty,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 205, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 205, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Wykres przedstwiający zaoszczędzoną kwotę w każdym miesiącu na przestrzeni 12 miesięcy'
                },
                legend: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });




});

function showChartModal(chartId) {
    const modal = new bootstrap.Modal(document.getElementById('chartModal'));
    const chartCanvas = document.getElementById('chartCanvas');
    const ctx = chartCanvas.getContext('2d');

    ctx.clearRect(0, 0, chartCanvas.width, chartCanvas.height);
    switch (chartId) {
        case 'wykresDochodow':
            displayChart('wykresDochodow', ctx);
            break;
        case 'wykresWydatkow':
            displayChart('wykresWydatkow', ctx);
            break;
        case 'wykresDochodowM':
            displayChart('wykresDochodowM', ctx);
            break;
    }

    modal.show();
}

function displayChart(chartId, ctx) {
    const chartData = getChartData(chartId);
    new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

