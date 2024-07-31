/* Chart */

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: "",
  },
  data: [
    {
      type: "pie",
      startAngle: 240,
      yValueFormatString: '##0.00" PLN"',
      indexLabel: "{label} {y}",
      dataPoints: dps,
    },
  ],
});
chart.render();
