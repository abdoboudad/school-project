@extends('admin.layouts.layout')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
<style>
  .first_charts{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .first_charts .chart1{
    background-color: rgb(224, 224, 224);
    width: 70%;
  }
</style>
<div class="first_charts">
  <div class="chart1">
    <canvas id="myChart2"></canvas>
  </div>
  <div class="chart2">
    <canvas id="myChart"></canvas>
  </div>
</div>


<script>
  var ctx2 = document.getElementById('myChart2').getContext('2d');
  var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
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
</script>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Teacher', 'Students', 'Admins'],
      datasets: [{
        data: [{{ $teachers->count() }}, {{ $students->count() }}, {{ $admins->count() }}],
        backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)'],
        borderWidth: 1
      }]
    },
    options: {
      cutout: '70%',
      responsive: true,
      maintainAspectRatio: false
    }
  });
</script>


@endsection