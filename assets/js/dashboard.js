const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul'],
        datasets: [{
            label: 'Requests',
            data: [20, 30, 25, 40, 35, 50, 45],
            borderColor: '#4CAF50',
            backgroundColor: 'rgba(76,175,80,0.2)',
            tension: 0.4,
            fill: false,
            borderWidth: 2,
            pointRadius:4,
             pointBackgroundColor: '#2d7e30', 

    pointBorderColor: '#2d7e30', 

        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});