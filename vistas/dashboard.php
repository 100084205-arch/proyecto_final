 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Tablero Principal</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Tablero Principal</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <div class="content">

     <div class="container-fluid">

         <!-- row Tarjetas Informativas -->
         <div class="row">

             <!-- Total de Piedras -->
             <div class="col-lg-3">
                 <!-- small box -->
                 <div class="small-box bg-success">
                     <div class="inner">
                         <h4 id="totalPiedras">0</h4>

                         <p>Total de Piedras</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-clipboard"></i>
                     </div>
                    
                 </div>
             </div>

             <!-- TARJETA Total de Prendas -->
             <div class="col-lg-3">
                 <!-- small box -->
                 <div class="small-box bg-danger">
                     <div class="inner">
                         <h4 id="TotalPrendas">0</h4>

                         <p>Total de Prendas</p>
                     </div>
                     <div class="icon">
                         <i class="ion-android-remove-circle"></i>
                     </div>
                    
                 </div>
             </div>
                       <!-- TARJETA Total de Vouchers -->
                 <div class="col-lg-3">
                    <!-- small box -->
                 <div class="small-box bg-pink">
                     <div class="inner">
                         <h4 id="ToltalVouchers">0</h4>

                         <p>Total de Vouchers</p>
                     </div>
                     <div class="icon">
                         <i class="ion-android-remove-circle"></i>
                     </div>
                     
                 </div>
             </div>

           
             

         </div> <!-- ./row Tarjetas Informativas -->



         <!-- row Grafico de barras para los productos de warehouse-->
         <div class="row">

             <div class="col-12">

                 <div class="card card-info">

                     <div class="card-header">

                         <h3 class="card-title" id="title-header"></h3>

                         <div class="card-tools">

                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                             <button type="button" class="btn btn-tool" data-card-widget="remove">
                                 <i class="fas fa-times"></i>
                             </button>

                         </div> <!-- ./ end card-tools -->

                     </div> <!-- ./ end card-header -->


                     <div class="card-body">

                         <div class="chart">

                             <canvas id="barChart"
                                 style="min-height: 280px; height: 200px; max-height: 350px; width: 100%;">

                             </canvas>

                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>

         </div><!-- ./row Grafico de barras -->
         
<div class="row mt-4" >
            <div class="col-md-3" >
                <canvas id="graficoBarras" style=" height: 450px;  width: 100%;"></canvas>
            </div>
            <div class="col-md-4" >
                <canvas id="graficoPastel" ></canvas>
            </div>
            <div class="col-md-5">
                <canvas id="graficoLineas"  style=" height: 450px;  width: 100%;"></canvas>
            </div>
        </div>
         <!-- row Grafico de barras para los articulos locales-->

     </div><!-- /.container-fluid -->
   

 </div>

 <!-- /.content -->

 <script>
$(document).ready(function() {
     setInterval(() => {
         $.ajax({
             url: "ajax/dashboard.ajax.php",
             method: 'POST',
             dataType: 'json',
             success: function(respuesta) {
              $("#totalPiedras").html(respuesta[0]['totalPiedras']);
             $("#TotalPrendas").html(respuesta[0]['TotalPrendas']);
              $("#ToltalVouchers").html(respuesta[0]['ToltalVouchers']);
            //  $("#salidas_del_mes").html(respuesta[0]['salidas_del_mes']);
            //  $("#totalProductosLocales").html(respuesta[0]['totalProductosLocales']);
            //  $("#TotalPrendasLocales").html(respuesta[0]['TotalPrendasLocales']);
            // // $("#ToltalVouchers").html(respuesta[0]['ToltalVouchers']);
            //  $("#salidas_del_mesLocales").html(respuesta[0]['salidas_del_mesLocales']);
           

             }
         });
     }, 910000);
  

    /* =======================================================
    SOLICITUD AJAX TARJETAS INFORMATIVAS DE WAREHOUSE
    =======================================================*/
    $.ajax({
        url: "ajax/dashboard.ajax.php",
        method: 'POST',
        dataType: 'json',
        success: function(respuesta) {
            // console.log("respuesta", respuesta);
             $("#totalPiedras").html(respuesta[0]['totalPiedras']);
             $("#TotalPrendas").html(respuesta[0]['TotalPrendas']);
             $("#ToltalVouchers").html(respuesta[0]['ToltalVouchers']);
            // $("#salidas_del_mes").html(respuesta[0]['salidas_del_mes']);
            // $("#totalPiedrasLocales").html(respuesta[0]['totalPiedrasLocales']);
            //  $("#productos_inactivoLocales").html(respuesta[0]['productos_inactivoLocales']);
            // // $("#sin_ubicaciones").html(respuesta[0]['sin_ubicaciones']);
            //  $("#salidas_del_mesLocales").html(respuesta[0]['salidas_del_mesLocales']);

        }
    });

    /* =======================================================
    SOLICITUD AJAX GRAFICO DE BARRAS PARA LA SALIDA WAREHOUSE DEL MES
    =======================================================*/
    $.ajax({
        url: "ajax/dashboard.ajax.php",
        method: 'POST',
        data: {
            'accion': 3 //parametro para obtener las salidas de warehouse del mes
        },
        dataType: 'json',
        success: function(respuesta) {
            // console.log("respuesta", respuesta);

            var fecha_creado = [];
            var cant_piedra = [];
            var cant_piedra_ant = [];

            var cant_piedra_mes = 0;

            for (let i = 0; i < respuesta.length; i++) {

                fecha_creado.push(respuesta[i]['fecha_creado']);
                cant_piedra.push(respuesta[i]['cant_piedra']);
                cant_piedra_ant.push(respuesta[i]['cant_piedra_ant']);
                cant_piedra_mes = parseFloat(cant_piedra_mes) + parseFloat(respuesta[i][
                    'cant_piedra'
                ]);

            }

            cant_piedra.push(0);


            $(".card-title").html('Total::' + cant_piedra_mes.toFixed(2).toString(0).replace(
                /\d(?=(\d{3})+\.)/g, "$&,"));

            var barChartCanvas = $("#barChart").get(0).getContext('2d');

            var areaChartData = {
                labels: fecha_creado,
                datasets: [{
                    label: '',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    data: cant_piedra
                }]
            }

            var barChartData = $.extend(true, {}, areaChartData);

            var temp0 = areaChartData.datasets[0];

            barChartData.datasets[0] = temp0;

            var barChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                events: false,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                },
                animation: {
                    duration: 500,
                    easing: "easeOutQuart",
                    onComplete: function() {
                        var ctx = this.chart.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global
                            .defaultFontFamily, 'normal',
                            Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset) {
                            for (var i = 0; i < dataset.data.length; i++) {
                                var model = dataset._meta[Object.keys(dataset
                                        ._meta)[0]].data[i]._model,
                                    scale_max = dataset._meta[Object.keys(dataset
                                        ._meta)[0]].data[i]._yScale.maxHeight;
                                ctx.fillStyle = '#444';
                                var y_pos = model.y - 5;
                                // Make sure data value does not get overflown and hidden
                                // when the bar's value is too close to max value of scale
                                // Note: The y value is reverse, it counts from top down
                                if ((scale_max - model.y) / scale_max >= 0.93)
                                    y_pos = model.y + 20;
                                ctx.fillText(dataset.data[i], model.x, y_pos);
                            }
                        });
                    }
                }
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })


        }
    });




    /* =======================================================
    SOLICITUD AJAX GRAFICO DE BARRAS PARA LOS ARTICULOS LOCALES  DEL MES
    =======================================================*/
    $.ajax({
        url: "ajax/dashboard.ajax.php",
        method: 'POST',
        data: {
            'accion': 3 //parametro para obtener las ventas del mes
        },
        dataType: 'json',
        success: function(respuesta) {
            console.log("respuesta", respuesta);

           // var fecha_reducion = [];
            var cod_datos = [];
            var cod_datos_ant = [];

            var cod_datos_mes = 0;

            for (let i = 0; i < respuesta.length; i++) {

              //  fecha_reducion.push(respuesta[i]['fecha_reducion']);
                cod_datos.push(respuesta[i]['cod_datos']);
                cod_datos_ant.push(respuesta[i]['cod_datos_ant']);
                cod_datos_mes = parseFloat(cod_datos_mes) + parseFloat(respuesta[i][
                    'cod_datos'
                ]);

            }

            cod_datos.push(0);


            $(".card-titlee").html('Sa::' + cod_datos_mes.toString().replace(
                /\d(?=(\d{3})+\.)/g, "$&,"));

            var barChartCanvas = $("#barChartt").get(0).getContext('2d');

            var areaChartData = {
                labels: cod_datos,
                datasets: [ {
                    label: '',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    data: cod_datos
                }]
            }

            var barChartData = $.extend(true, {}, areaChartData);

            var temp0 = areaChartData.datasets[0];

            barChartData.datasets[0] = temp0;

            var barChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                events: false,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                },
                animation: {
                    duration: 500,
                    easing: "easeOutQuart",
                    onComplete: function() {
                        var ctx = this.chart.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global
                            .defaultFontFamily, 'normal',
                            Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset) {
                            for (var i = 0; i < dataset.data.length; i++) {
                                var model = dataset._meta[Object.keys(dataset
                                        ._meta)[0]].data[i]._model,
                                    scale_max = dataset._meta[Object.keys(dataset
                                        ._meta)[0]].data[i]._yScale.maxHeight;
                                ctx.fillStyle = '#444';
                                var y_pos = model.y - 5;
                                // Make sure data value does not get overflown and hidden
                                // when the bar's value is too close to max value of scale
                                // Note: The y value is reverse, it counts from top down
                                if ((scale_max - model.y) / scale_max >= 0.93)
                                    y_pos = model.y + 20;
                                ctx.fillText(dataset.data[i], model.x, y_pos);
                            }
                        });
                    }
                }
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })


        }

      
        
    });


})
 </script>