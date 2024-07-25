<footer class="position-absolute w-100 bottom-0">
  <div class="bg-grey-blue mx-2 rounded-top-3">
    <div class="container">
      <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-4 d-flex justify-content-center justify-content-md-start">
          <p class="my-2">© 2024 CreativeWallet</p>
        </div>
        <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
          <p class="my-2">Author: Mateusz Przybyła</p>
          <a class="text-body-secondary" href="https://github.com/mateusz-przybyla" target="_blank"><img src="/assets/svg/github.svg" alt="graph-up-arrow" height="20" class="ms-3 my-1" /></a>
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/assets/scroll-to-top.js" type="text/javascript"></script>
<script src="/assets/chart.js" type="text/javascript"></script>
<script>
  const dps = <?php echo json_encode($dataPoints); ?>;

  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
      text: "",
    },
    data: [{
      type: "pie",
      startAngle: 240,
      yValueFormatString: '##0.00" PLN"',
      indexLabel: "{label} {y}",
      dataPoints: dps,
    }, ],
  });
  chart.render();
</script>
</body>

</html>