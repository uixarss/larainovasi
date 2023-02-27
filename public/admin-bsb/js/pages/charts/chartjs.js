$(function () {
    new Chart(document.getElementById("radar_chart").getContext("2d"), getChartJs('radar'));
});

function getChartJs(type) {
    var config = null;

    if (type === 'radar') {
        config = {
            type: 'radar',
            data: {
                labels: ["Institusi", "SDM & Penelitian", "Infrastruktur", "Kecanggihan Produk", "Kecepatan Bisnis Proses", "Output Pengetahuan dan Teknologi", "Hasil Kreatif"],
                datasets: [{
                    label: "My First dataset",
                    data: [65, 25, 90, 81, 56, 55, 40],
                    borderColor: 'rgba(0, 188, 212, 0.8)',
                    backgroundColor: 'rgba(0, 188, 212, 0.5)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                    pointBorderWidth: 1
                }, {
                        label: "My Second dataset",
                        data: [72, 48, 40, 19, 96, 27, 100],
                        borderColor: 'rgba(233, 30, 99, 0.8)',
                        backgroundColor: 'rgba(233, 30, 99, 0.5)',
                        pointBorderColor: 'rgba(233, 30, 99, 0)',
                        pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                        pointBorderWidth: 1
                    }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    return config;
}