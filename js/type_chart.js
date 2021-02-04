$(document).ready(function()
{
    var type = [] ;
    var unit = [] ;

    $.post('type_chart_json.php',function(type_data)
    {
        for(let i in type_data)
        {
            type.push(type_data[i].type) ;
            unit.push(type_data[i].unit) ;
        }

    var type_chart = document.getElementById('type-chart').getContext('2d');
    var render_type_chart = new Chart(type_chart, 
    {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: 
            {
                labels: type,
        datasets: 
                [{
                    backgroundColor: ['rgb(255,204,115)','rgb(82,151,255)','rgb(120,80,163)','rgb(29,171,114)','rgb(255,82,82)'],
                    data: unit
                }],
            },

        // Configuration options go here
        options: 
                {
                    legend: {
                                position:'bottom'
                            },

                    padding:{
                                left: 0,
                                right: 0,
                                top: 0,
                                bottom: 0
                            },
                    responsive: true,

                    plugins: {
                                datalabels: {
                                                color:'white',
                                                anchor:'end',
                                                align:'start',
                                            },
                             }
                    
                }
    }); // CHART



    }) ;   // POST 


}) ; //Doc. ready



