$( function() {
  $( ".column" ).sortable({
    connectWith: ".column",
    handle: ".portlet-header",
    cancel: ".portlet-toggle",
    placeholder: "portlet-placeholder ui-corner-all"
  });

  $( ".portlet" )
    .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
    .find( ".portlet-header" )
      .addClass( "ui-widget-header ui-corner-all" )
      .prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");

  $( ".portlet-toggle" ).on( "click", function() {
    var icon = $( this );
    icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
    icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
  });
} );



$(function () {
  var totalRevenue = 24;
  
  // CanvasJS column chart to show revenue from Jan 2015 - Dec 2015
  var revenueColumnChart = new CanvasJS.Chart("revenue-column-chart", {
    animationEnabled: true,
    backgroundColor: "transparent",
    theme: "theme2",
    axisX: {
      labelFontSize: 14,
    },
    axisY: {
      labelFontSize: 14,
    },
    toolTip: {
      borderThickness: 0,
      cornerRadius: 0,
      content: "<span style='\"'color: {color};'\"'>{label}</span>: {y} hours",
    },
    data: [
      {
        type: "column",
        dataPoints: [
          { label: "Task 1", y: 24 },
          { label: "Task 2", y: 17 },
          { label: "Task 3", y: 12 },
          { label: "Task 4", y: 11 },
          { label: "Task 5", y: 10 },
          { label: "Task 6", y: 10 },
          { label: "Task 7", y: 14 },
          { label: "Task 8", y: 11 },
          { label: "Task 9", y: 1 },
          { label: "Task 10", y: 15 },
          { label: "Task 11", y: 15 },
          { label: "Task 12", y: 16 }
        ]
      }
    ]
  });
  
  revenueColumnChart.render();
  
  //CanvasJS pie chart to show product wise annual revenue for 2015
  var productsRevenuePieChart = new CanvasJS.Chart("products-revenue-pie-chart", {
    animationEnabled: true,
    theme: "theme2",
    legend: {
      fontSize: 14
    },
    toolTip: {
      borderThickness: 0,
      content: "<span style='\"'color: {color};'\"'>{name}</span>: {y} hours (#percent%)",
      cornerRadius: 0
    },
    data: [
      {       
        indexLabelFontColor: "#676464",
        indexLabelFontSize: 14,
        legendMarkerType: "square",
        legendText: "{indexLabel}",
        showInLegend: true,
        startAngle:  90,
        type: "pie",
        dataPoints: [
          {  y: 12, name:"Task A", indexLabel: "Task A - 41%", legendText: "Task A", exploded: true },
          {  y: 5, name:"Task B", indexLabel: "Task B - 18%", legendText: "Task B" },
          {  y: 36, name:"Task C", indexLabel: "Task C - 24%", legendText: "Task C", color: "#8064a1" },
          {  y: 26, name:"Task D", indexLabel: "Task D - 17%", legendText: "Task D" }
        ]
      }
    ]
  });
  
  productsRevenuePieChart.render();
  
  //CanvasJS spline chart to show orders from Jan 2015 to Dec 2015
  
  
});