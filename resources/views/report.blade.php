<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/css/mdb.min.css" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<style>
    .flot {
        left: 0px;
        top: 0px;
        width: 610px;
        height: 250px;
    }
    #flotTip {
        padding: 3px 5px;
        background-color: #000;
        z-index: 100;
        color: #fff;
        opacity: .80;
        filter: alpha(opacity=85);
    }
    .pieLabel div {
        color: white !important;
        text-shadow: 0 0 4px #000;
    }
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <input type="text" id="daterange" />
                </div>
                <div class="card-body">
                    <div id="pie-placeholder" class="flot"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/js/mdb.min.js"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.min.js"></script>
<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.tooltip.min.js"></script>

<script type="text/javascript">

    var currentDate = moment();
    var lastMonthDate = moment().subtract(1, 'month').add(1, 'day');
    $('#daterange').daterangepicker({
        startDate: lastMonthDate,
        endDate: currentDate
    }, function(start, end,) {
        getData(start, end)
    });

    function getData(start, end) {
        let url = '{{ route('ajax-report') }}'
        let params = {
            _token: '{{ csrf_token() }}',
            from_date: start.format('DD-MM-YYYY'),
            to_date: end.format('DD-MM-YYYY')
        }
        $.post(url, params).done(function (res) {
            console.log(res)
            initChart(res)
        })

        function initChart(data) {
            var options = {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 2 / 3,
                            formatter: function (label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + series.data[0][1] + '</div>';

                            },
                            threshold: 0.1
                        }
                    }
                },
                grid: {
                    hoverable: true
                },
                tooltip: true,
                tooltipOpts: {
                    cssClass: "flotTip",
                    content: "%p.0%, %s",
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            };
            $.plot($("#pie-placeholder"), data, options);
        }
    }

    $(document).ready(function () {
        getData(lastMonthDate, currentDate)
    })
</script>
