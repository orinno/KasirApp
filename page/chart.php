<?php 
  include '../config.php';
  $query = $dbconnect->query("
    SELECT MONTH(tanggal_waktu) as tgl, 
    SUM(total) as total 
    FROM transaksi 
    GROUP BY MONTH(tanggal_waktu);
  ");

  foreach($query as $data)
  {
    $month[] = $data['tgl'];
    $amount[] = $data['total'];
  }
?>

<div style="width: 100%;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($month) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Transaksi Perbulan',
      data: <?php echo json_encode($amount) ?>,
      backgroundColor: [
        'rgba(43, 43, 173, 0.5)',
        'rgba(255, 159, 64, 0.5)',
        'rgba(255, 205, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(201, 203, 207, 0.)'
      ],
      borderColor: [
        'rgb(43, 43, 173)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>