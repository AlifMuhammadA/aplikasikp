<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="admin page absensi online sd prajamukti">
    <title><?php echo isset($title)?$title:''; ?> | Absensi Online SD Praja Mukti</title>

    <!-- ========== Css Files ========== -->
    <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style_login.css');?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/TweenLite.min.js'); ?>"></script>

    <script type="text/javascript">

		$(document).ready(function() {
		    $(document).mousemove(function(event) {
		        TweenLite.to($("body"), 
		        .5, {
		            css: {
		                backgroundPosition: "" + parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / '12') + "px, " + parseInt(event.pageX / '15') + "px " + parseInt(event.pageY / '15') + "px, " + parseInt(event.pageX / '30') + "px " + parseInt(event.pageY / '30') + "px",
		            	"background-position": parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / 12) + "px, " + parseInt(event.pageX / 15) + "px " + parseInt(event.pageY / 15) + "px, " + parseInt(event.pageX / 30) + "px " + parseInt(event.pageY / 30) + "px"
		            }
		        })
		    })
		});
    </script>

</head>
<body>
	<div class="container">
        <div class="row vertical-offset-100">
        	<div class="col-md-4 col-md-offset-4">
            	<div class="panel panel-default">
                    <div class="panel-heading">                                
                    	<div class="row-fluid user-row">
                        	<img src="<?php echo base_url('assets/img/logo.png');?>" class="img-responsive" alt="Conxole Admin"/>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h3><?php echo isset($judul)?$judul:'';?></h3>
						<?php
				            $attr = array('class' => 'form-signin');
				            echo form_open($form, $attr);
		        		?>
                        	<fieldset>
                            	<label class="panel-login">
                                	<div class="login_result">
                                		<?php 
									        $msg = $this->session->flashdata('msg');
									        $msg_status = $this->session->flashdata('msg_status');
									        if(isset($msg)): 
									    ?> 
										<div class="alert <?php echo $msg_status; ?> alert-dismissible fade in" role="alert">
									      	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									      	<?php echo $msg; ?>
									    </div>
									    <?php endif; ?> 
                                	</div>
                                </label>
                                <input class="form-control" placeholder="Username" id="username" name="username" type="text" required>
                                <input class="form-control" placeholder="Password" id="password" name="password" type="password" required>
                                <br></br>
                                <input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Login »">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</body>
</html>
