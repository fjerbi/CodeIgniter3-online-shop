<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->

    <meta charset="utf-8">
    <title>Tableau de bord</title>
    <meta name="description" content="Bootstrap Metro Dashboard">
    <meta name="author" content="Dennis Ji">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->

    <link id="bootstrap-style" href="<?php echo base_url(); ?>adminfiles/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>adminfiles/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url(); ?>adminfiles/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url(); ?>adminfiles/css/style-responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->





<div class="row-fluid">
				
				<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
					<div class="number">3<i class="icon-arrow-up"></i></div>
					<div class="title">Visites</div>
					<div class="footer">
						<a href="#"> Compte rendu</a>
					</div>	
				</div>
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number">25<i class="icon-arrow-up"></i></div>
					<div class="title">Ventes</div>
					<div class="footer">
						<a href="#"> Compte rendu</a>
					</div>
				</div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number">20<i class="icon-arrow-up"></i></div>
					<div class="title">Commandes</div>
					<div class="footer">
						<a href="#"> Compte rendu</a>
					</div>
				</div>
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
					<div class="number">4<i class="icon-arrow-down"></i></div>
					<div class="title">Utilisateurs</div>
					<div class="footer">
						<a href="#"> Compte rendu</a>
					</div>
				</div>	
				
			</div>		

			<div class="row-fluid">
				
				<div class="span8 widget blue" onTablet="span7" onDesktop="span8">
					
					<div id="stats-chart2"  style="height:282px" ></div>
					
				</div>
				
				
						
			<div class="row-fluid">
				
				<div class="widget blue span5" onTablet="span6" onDesktop="span5">
					
					<h2><span class="glyphicons globe"><i></i></span> Demographics</h2>
					
					<hr>
					
					<div class="content">
						
						<div class="verticalChart">
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>37%</span>
									</div>
								
								</div>
								
								<div class="title">US</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>16%</span>
									</div>
								
								</div>
								
								<div class="title">PL</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>12%</span>
									</div>
								
								</div>
								
								<div class="title">GB</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>9%</span>
									</div>
								
								</div>
								
								<div class="title">DE</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>7%</span>
									</div>
								
								</div>
								
								<div class="title">NL</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>6%</span>
									</div>
								
								</div>
								
								<div class="title">CA</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>5%</span>
									</div>
								
								</div>
								
								<div class="title">FI</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>4%</span>
									</div>
								
								</div>
								
								<div class="title">RU</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>3%</span>
									</div>
								
								</div>
								
								<div class="title">AU</div>
							
							</div>
							
							<div class="singleBar">
							
								<div class="bar">
								
									<div class="value">
										<span>1%</span>
									</div>
								
								</div>
								
								<div class="title">N/A</div>
							
							</div>	
							
							<div class="clearfix"></div>
							
						</div>
					
					</div>
					
				</div><!--/span-->
				
				
				<div class="widget yellow span4 noMargin" onTablet="span12" onDesktop="span4">
					<h2><span class="glyphicons fire"><i></i></span> Server Load</h2>
					<hr>
					<div class="content">
						 <div id="serverLoad2" style="height:224px;"></div>
					</div>
				</div>
			
			</div>
			
			<div class="row-fluid">
				
				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Weekly Stat</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li>
								<a href="#">
									<i class="icon-arrow-up green"></i>                               
									<strong>92</strong>
									New Comments                                    
								</a>
							</li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-down red"></i>
							  <strong>15</strong>
							  New Registrations
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-minus blue"></i>
							  <strong>36</strong>
							  New Articles                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-comment yellow"></i>
							  <strong>45</strong>
							  User reviews                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-up green"></i>                               
							  <strong>112</strong>
							  New Comments                                    
							</a>
						  </li>
						</ul>
					</div>
				</div>
			</div>
		</head>
























    <script src="<?php echo base_url(); ?>adminfiles/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery-migrate-1.0.0.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.ui.touch-punch.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/modernizr.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.cookie.js"></script>

<script src='<?php echo base_url(); ?>adminfiles/js/fullcalendar.min.js'></script>

<script src='<?php echo base_url(); ?>adminfiles/js/jquery.dataTables.min.js'></script>

<script src="<?php echo base_url(); ?>adminfiles/js/excanvas.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.stack.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.resize.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.chosen.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.uniform.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.cleditor.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.noty.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.elfinder.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.raty.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.iphone.toggle.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.uploadify-3.1.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.gritter.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.imagesloaded.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.masonry.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.knob.modified.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.sparkline.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/counter.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/retina.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/custom.js"></script>
<!-- end: JavaScript-->
<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({

            	message: "Welcome to LaraShop55 Admin."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>
</body>
</html>
