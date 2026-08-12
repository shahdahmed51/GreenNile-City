const canvas = document.getElementById('myChart');

const data = {
    labels: ['Open', 'In Progress', 'Done', 'Canceled'],

    datasets: [{
        label: 'Maintenance Requests',

        data: [
            Number(chartData['Open']),
            Number(chartData['In Progress']),
            Number(chartData['Done']),
            Number(chartData['Canceled'])
        ],

        borderWidth: 1,
        borderRadius: 6
    }]
};

new Chart(canvas, {
    type: 'bar',

    data: data,

    options: {
        responsive: true,

        maintainAspectRatio: false,

        scales: {
            y: {
                beginAtZero: true,

                ticks: {
                    precision: 0
                }
            }
        }
    }
});


function changePeriod(period) {
    window.location.href =
        'dashboard.php?period=' + period;
}