<!DOCTYPE html>  
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Step 1 - Include the fusioncharts core library -->
    <!-- <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script> -->
    <!-- Step 2 - Include the fusion theme -->
    <!-- <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script> -->
</head>

<body>
       <div style="width:400px; height:400px" id="chart"></div>

</body>

</html>

<script>

var options = {
            chart: {
                type: 'donut',
            },
            series: [44, 55, 41, 17, 15],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }

       var chart = new ApexCharts(
            document.querySelector("#chart"),
            options
        );
        
        chart.render();

</script>