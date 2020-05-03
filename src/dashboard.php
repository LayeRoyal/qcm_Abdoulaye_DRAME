<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>

<canvas id="myChart1" ></canvas>
<canvas id="myChart2" ></canvas>
<canvas id="myChart3" ></canvas>
        <script>
              var ctx = document.getElementById("myChart1");
              var myChart = new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                      labels: ["Group 1", "Group 2", "Group 3"],
                      datasets: [{
                          label: 'Groups',
                          data: [12, 19, 3]
                      }]
                  }
              });
        </script>
