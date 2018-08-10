<?php 
/**
	This Developed version code for learning purpose not for commmercial.
	any further queries contact vrushalrt@gmail.com
**/
	  //echo '<pre>'; 
      //print_r($hourly['hourly_forecast']); exit();
      //print_r($hourly['hourly_forecast'][1]['FCTTIME']['civil']); exit();
      //$i=0;
      // for ($i=0; $i < 10; $i++) //count($hourly['hourly_forecast']
      // { 

      //       echo $hourly['hourly_forecast'][$i]['FCTTIME']['civil']."<br>";
      // }

      //print_r($forecast['forecast']['simpleforecast']['forecastday'][3]['date']['weekday']); 
      //exit(); 

        //echo count($forecast['forecast']['simpleforecast']['forecastday'])."<br>";
        //$i=0;

        // for ($i=0; $i < count($forecast['forecast']['simpleforecast']['forecastday']); $i++) { 
         
        //   echo $forecast['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday']." ".$forecast['forecast']['simpleforecast']['forecastday'][$i]['high']['celsius']." ".$forecast['forecast']['simpleforecast']['forecastday'][$i]['low']['celsius']."<br>";
            
              
        //      //echo $hourly['hourly_forecast'][$i]['FCTTIME']['civil']."<br>";
        //     for ($j=0; $j < count($hourly['hourly_forecast']); $j++) { //count($hourly['hourly_forecast'])
              
        //       if (isset($forecast['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday']) && isset($hourly['hourly_forecast'][$j]['FCTTIME']['weekday_name']) && $forecast['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday'] == $hourly['hourly_forecast'][$j]['FCTTIME']['weekday_name']) {
                              
        //       $ftime = array(array('civil' => $hourly['hourly_forecast'][$j]['FCTTIME']['civil'],
        //                             'metric' => $hourly['hourly_forecast'][$j]['temp']['metric'],
        //                             'icon'  => $hourly['hourly_forecast'][$j]['icon_url']

        //                             )
        //                           );
        //         foreach ($ftime as $ftimes) {
        //           //print_r($ftimes);
        //         //echo $ftimes."<br>";  
        //         echo $ftimes['civil']."<br> ".$ftimes['metric']." ".$ftimes['icon']."<br>";
        //       }
        //        // continue;
        //         }

        //     }

        // }

        // exit();
 ?>
<!doctype html>
<html>
  <head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://s3.amazonaws.com/codecademy-content/projects/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"/>
  
  </head>
  <body>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 col-sm-offset-7">
            <h1>
              <?php echo $weather['current_observation']['temp_c']; ?>&deg;C
              <img src="<?php echo $weather['current_observation']['icon_url']; ?>">
            </h1>
            <p class="feel" data-weather="<?php $day = strtolower($weather['current_observation']['weather']);?>"><?php echo $weather['current_observation']['weather'];?></p>
            <p class="feel">Feels like 
              <strong><?php echo $weather['current_observation']['feelslike_c'];?>&deg;C</strong> |
              <?php echo $forecast['forecast']['simpleforecast']['forecastday'][0]['low']['celsius'];?>&deg;C
            </p>
            <p><?php echo $weather['current_observation']['observation_time'];?></p>
            <h2>5-day forecast</h2>
            <div class="forecast">
             
             <?php for ($i=0; $i < count($forecast['forecast']['simpleforecast']['forecastday']); $i++) { ?>

              <div class="day row">
                <div class="weekday col-xs-4" data-today="<?php echo $forecast['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday']; ?>">
                  <span class="glyphicon glyphicon-plus"></span>
                  <p class="weekdays">
                  <?php echo $forecast['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday']; ?>
                  </p>
                </div>
                  <div class="weather col-xs-3">
                  <img src="<?php echo $forecast['forecast']['simpleforecast']['forecastday'][$i]['icon_url'];  ?>">
                </div>
                <div class="weather col-xs-1">
                </div>
                <div class="high col-xs-2">
                  <p>
                  <?php echo $forecast['forecast']['simpleforecast']['forecastday'][$i]['high']['celsius']; ?>
                  </p>
                </div>
                <div class="low col-xs-2">
                  <p>
                  <?php echo $forecast['forecast']['simpleforecast']['forecastday'][$i]['low']['celsius']; ?>  
                  </p>
                </div>
              </div>
              <div class="hourly row">
                <div class="col-xs-4">
                   <?php   
                 for ($j=0; $j < count($hourly['hourly_forecast']); $j++) 
                 { 
              if (isset($forecast['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday']) && isset($hourly['hourly_forecast'][$j]['FCTTIME']['weekday_name']) && $forecast['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday'] == $hourly['hourly_forecast'][$j]['FCTTIME']['weekday_name']) 
              {
              $ftime = array(array('civil' => $hourly['hourly_forecast'][$j]['FCTTIME']['civil'],
                                    'metric' => $hourly['hourly_forecast'][$j]['temp']['metric'],
                                    'icon'  => $hourly['hourly_forecast'][$j]['icon_url']

                                    )
                                  );
              ?>
                <div class="col-xs-2">
                </div>
                <?php  foreach ($ftime as $ftimes) { ?>
                  <p class="hour"><?php echo $ftimes['civil'];?></p>
                  <p><img src="<?php echo $ftimes['icon']; ?>"></p>
                  <p class="temp"><?php echo $ftimes['metric'];?>&deg;C</p>
                 <?php }}} ?>  
                </div>
              </div>
             <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://s3.amazonaws.com/codecademy-content/projects/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/js/script.js');?>" ></script>
  </body>
</html>