
<div>

    </style>
<div>
    <canvas  id="myChart" style="height: 40vh; width: auto;"></canvas>
</div>
  

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script> 

$(function() {

    setInterval(() =>  Livewire.emit('ubahData'),30000);

    var chartData = JSON.parse('<?php echo $unras ?>');

  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: chartData.bulan,
      datasets: [{
        label: 'Total Unras',
        data: chartData.total,
        backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
            ],
        borderWidth: 1
      },{
        type: 'bar',
        label: 'Unras Di OJK',
        data: chartData.ojk,
        backgroundColor: [
                'rgba(255, 99, 132, 0.2)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',

            ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

    Livewire.on('berhasilUpdate', event => {
        var chartData = JSON.parse(event.data);
            
        myChart.data.labels = chartData.bulan;
        myChart.data.datasets[0].data = chartData.total;
        myChart.data.datasets[1].data = chartData.ojk;
        myChart.update('none');
    
    });



  });

</script>
@endpush
    
</div>

