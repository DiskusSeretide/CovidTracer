async function chartItSecond(domId){

    // return a 2d array
    // first dim contains visits per day
    // second contains visits from active cases per day
    url = 'PHP/chartQueries/fetchchart2.php';
    
    const d = await fetchData(url, getDateForGraph);
   
    const parsedData = parseData(d);
   
    const data = {
      labels: parsedData.visitsXs,
      datasets: [{
        label: 'Visits',
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
        label: 'Covid Cases',
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
        type: 'line',
        data,
        options: {
          plugins: {
            legend: {
              display:false
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      };
      
    const ctx = document.getElementById(domId).getContext('2d');
    const myChart = new Chart(ctx, config);
    
    // draw data according to checkboxes
    $("input[name='chooseBox2']").click((e) => {
      const data = e.target.value;
      const isShown = myChart.isDatasetVisible(data);

        if(!isShown)
          myChart.show(data)
        
        if(isShown)
          myChart.hide(data);
    });
 

    // fetch and draw new data on date change
    $("input[name='datepicker2']").change(async () => {
        // delete old dataa
        myChart.data.labels = [];
        myChart.data.datasets.forEach((dataset) => {
          dataset.data = [];
      });
      
      
      // fetch and parse new data
      const dnew = await fetchData(url, getDateForGraph);
      const parsedDataNew = parseData(dnew);

      // append new data
      myChart.data.labels = parsedDataNew.visitsXs;
      myChart.data.datasets[0].data = parsedDataNew.visitsYs;
      myChart.data.datasets[1].data = parsedDataNew.covidYs;
 
      myChart.update();
    });

 } // end of chartIt()

