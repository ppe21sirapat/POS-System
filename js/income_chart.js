$(document).ready(function()
{   
    var income_date = [] ;
    var income_total = [] ;

    $.post('income_chart_json.php',function(income_data)
    {
        for(let i in income_data)
        {
            income_date.push(income_data[i].date) ;
            income_total.push(income_data[i].total) ;
        }

        income_date.reverse() ;
        income_total.reverse() ;

        var income_chart = document.getElementById('income-chart').getContext('2d');
        var render_income_chart = new Chart(income_chart,
        {
            type: 'line',
            data:
                {
                    labels: income_date,
                    datasets:
                            [{
                                label: 'Daily Sale',
                                data: income_total,
                                backgroundColor: 'rgba(0,190,227,0.5)',
                                borderColor: 'white',
                                pointBackgroundColor: 'rgba(0,190,227,0.7)',
                                pointBorderColor: 'white',
                                pointBorderWidth:'2',
                                pointRadius: '7',
                                pointHoverBackgroundColor: 'rgb(0,190,227)',
                                pointHoverBorderColor: 'white',
                                pointHoverBorderWidth:'2.5',
                                pointHoverRadius: '7.5',
                            }],
        },

        options: 
                {    
                    legend: {
                                labels: {
                                            fontColor: 'white',
                                            fontSize: 18
                                        }
                            },
                    scales: 
                            {
                                xAxes: [{
                                            display: true,
                                            gridLines:{
                                                        color:'white',
                                                      },
                                            ticks:  {
                                                        fontColor: "white",
                                                        fontSize: 14,
                                                        beginAtZero: true 
                                                    }         
                                       }],

                                yAxes: [{
                                            display: true,
                                            gridLines:{
                                                        color:'white'
                                                      },
                                            scaleLabel:{
                                                        display:false,
                                                        labelString:'Baht'
                                                       },
                                            ticks:  {
                                                        fontColor: "white",
                                                        fontSize: 14,
                                                        stepSize: 100,
                                                        beginAtZero: true 
                                                    }

                                       }]
                            },
                    padding: {
                                left: 0,
                                right: 0,
                                top: 0,
                                bottom: 0
                             },
                    responsive: false,

                    plugins: {
                                datalabels: {
                                                color:'white',
                                                anchor:'end', 
                                                align:'start',
                                                offset:15, 
                                            }
                             },
                }
        }) ; // CHART

        // ANIMATE INC NUMBER
        var inc_count = 0 ; 
        var inc_duration = setInterval(inc_number,1) ;

        function inc_number()
        {
            $('#daily-total').text(inc_count) ; //Display total in html
            if(inc_count == income_total[6])
            {
                clearInterval(inc_duration) ;
            }

            inc_count++
            console.log(inc_count) ;
        }

    } ); //POST

}) ;