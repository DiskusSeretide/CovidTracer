async function chartIt(domId){

    // return a 2d array
    // first diminsion contains visits per day
    // second contains visits from active cases per day
    const url = 'PHP/chartQueries/fetchchart1.php';
    const d = await fetchData(url, getDatesForGraph);
    const parsedData = parseData(d);
   
    const data = {
      labels: parsedData.visitsXs,
      datasets: [{
        label: 'Total Visits Per Day',
        data: parsedData.visitsYs ,
        backgroundColor: [
          'rgba(52, 164, 235, 1)',
          'rgba(100, 130, 23, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(222, 98, 222, 1)',
          'rgba(145, 0, 0, 1)'
        ],
        borderColor: [
          'rgba(52, 164, 235, 1)',
          'rgba(100, 130, 23, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(222, 98, 222, 1)',
          'rgba(145, 0, 0, 1)'
        ],
        borderWidth: 2
      },
      {
        label: 'Total Visits From Active Cases Per Day',
        data: parsedData.covidYs,
        backgroundColor: [
          'rgba(52, 164, 235, 1)',
          'rgba(100, 130, 23, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(222, 98, 222, 1)',
          'rgba(145, 0, 0, 1)'
        ],
        borderColor: [
          'rgba(52, 164, 235, 1)',
          'rgba(100, 130, 23, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(222, 98, 222, 1)',
          'rgba(145, 0, 0, 1)'
        ],
        borderWidth: 2}]
      };

      // config
      const config = {
        type: 'bar',
        data,
        options: {
          plugins: {
            legend: {
              display:false
            }
          },
          scales: {

            x: {
              type: "time",
              time: {
                unit: 'day'
              }
            },
            y: {
              beginAtZero: true
            }
          }
        }
      };
      
    const ctx = document.getElementById(domId).getContext('2d');
    const myChart = new Chart(ctx, config);
    
    // draw data according to checkboxes
    $("input[name='chooseBox']").click((e) => {
      const data = e.target.value;
      const isShown = myChart.isDatasetVisible(data);

        if(!isShown)
          myChart.show(data)
        
        if(isShown)
          myChart.hide(data);
    });
 

    // fetch and draw new data on date change
    $("input[name='datepicker']").change(async () => {
        // delete old dataa
        myChart.data.labels = [];
        myChart.data.datasets.forEach((dataset) => {
          dataset.data = [];
      });
      
      
      // fetch and parse new data
      const dnew = await fetchData(url, getDatesForGraph);
      const parsedDataNew = parseData(dnew);

      // append new data
      myChart.data.labels = parsedDataNew.visitsXs;
      myChart.data.datasets[0].data = parsedDataNew.visitsYs;
      myChart.data.datasets[1].data = parsedDataNew.covidYs;
 
      myChart.update();
    });

 } // end of chartIt()

