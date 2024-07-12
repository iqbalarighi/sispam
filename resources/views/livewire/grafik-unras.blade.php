
<div>


  

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script> 

$(function() {

    setInterval(() =>  Livewire.emit('ubahData'),120000);

var chartData = JSON.parse('{!! $unras !!}');
const ctx = document.getElementById('myChart').getContext('2d');

   const data = {
      labels: chartData.bulan,
      datasets: [{
        label: 'Unras Terjadi',
        data: chartData.total,
        backgroundColor: [
                'rgba(54, 162, 235, 1)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
            ], 
      },{
        label: 'Unras Di OJK',
        data: chartData.ojk,
        backgroundColor: [
                'rgba(209, 6, 6, 1)',
            ],
            borderColor: [
                'rgba(209, 6, 6, 1)',
            ],
      }]
    };

    const config = {
        type: 'line',
        data,
        options:{
            plugins:{
             datalabels: {
                anchor: 'start',
                align: 'top',
                weight: 'bold',
                color: 'black',
            },
        font: {
          
        }
          },
          tension: 0.4,
            scales: {
                y: {
                  beginAtZero: true
              }
            }
          },
            plugins: [ChartDataLabels]
        };

    //const myChart = new Chart(ctx, config);

var myChart = new Chart(ctx, config);

    Livewire.on('berhasilUpdate', event => {

        var chartData = JSON.parse(event.data);
        myChart.data.labels = chartData.bulan;
        myChart.data.datasets[0].data = chartData.total;
        myChart.data.datasets[1].data = chartData.ojk;
        myChart.update();
    });
  });

</script>
@endpush
    
</div>

