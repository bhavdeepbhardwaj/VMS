// Visitor Registration Data

(function($) {

    var charts = {
        init: function() {
            // -- Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            this.ajaxGetPostMonthlyData();

        },

        ajaxGetPostMonthlyData: function() {
            var urlPath = '/get-visitor-chart-data';
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function(response) {
                // console.log(response);
                charts.createCompletedJobsChart(response);
            });
        },

        /**
         * Created the Completed Jobs Chart
         */
        createCompletedJobsChart: function(response) {

            var ctx = document.getElementById("myAreaChartVisitor");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: response.months, // The response got from the ajax request containing all month names in the database
                    datasets: [{
                        label: "Visitor Registration",
                        lineTension: 0.3,
                        backgroundColor: "rgba(252,207,45,0.2)",
                        borderColor: "rgba(255,204,6)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255,204,6)",
                        pointBorderColor: "rgba(255,255,255)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(255,204,6)",
                        pointHitRadius: 20,
                        pointBorderWidth: 2,
                        data: response.visitor_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 10
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: response.max, // The response got from the ajax request containing max limit for y axis
                                maxTicksLimit: 100
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: true
                    }
                }
            });
        }
    };

    charts.init();

})(jQuery);
