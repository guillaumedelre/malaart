document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById("materialStock")) {
        let options = {
            title: {
                display: false,
            },
            legend: {
                display: false,
                labels: {
                    // This more specific font property overrides the global property
                    fontFamily: 'Montserrat',
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return Math.abs(tooltipItem.value)
                    }
                }
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontFamily: 'Montserrat',
                        callback: function(value, index, values) {
                            return Math.abs(value);
                        }
                    },
                }],
                yAxes: [{
                    ticks: {
                        fontFamily: 'Montserrat',
                        beginAtZero: true
                    }
                }]
            }
        }

        let ctx = document.getElementById('materialStock').getContext('2d')
        let backgroundColors = []
        let hoverBackgroundColors = []
        let borderColors = []
        let labels = []
        let materialData = []
        window.stock.materials.forEach((materialItem) => {
            let color = randomColor()
            backgroundColors.push(hslObjectToString(color, 0.2))
            hoverBackgroundColors.push(hslObjectToString(color, 0.8))
            borderColors.push(hslObjectToString(color, 1))
            labels.push(materialItem.label)
            materialData.push(materialItem.stone ? materialItem.units * -1 : materialItem.units)
        })
        new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: labels,
                datasets: [{
                    data: materialData,
                    backgroundColor: backgroundColors,
                    hoverBackgroundColor: hoverBackgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: options
        });
    }
});
