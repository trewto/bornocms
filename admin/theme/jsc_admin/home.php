	<?php if(isset($_GET['welcome'])) {?>
							
							<!-- if isset .../admin/?welcome=true than display a welcome message -->
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Welcome!</strong> You are now logged in .
							</div>   
							<?php }	?>
							
							
									<?php if(loginuserinfo("email")=="bornocms@gmail.com"){?>
									<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Demo user!</strong> You are visiting as a demo user
							</div>   
							
							<?php } ?>
							
							
							
							<?php /*if ( user_can( 'manage_site' ) ) {
								if(file_exists('../install.php')){
							?>
							<!-- if install.php file exists than display to delete this msg -->
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Note!</strong> You Should Delete This install.php file . Do it mannualy or <a href="del.php?type=file&id=install.sphp">Click here </a>
							</div>   
							<?php } } */?>
							

	<!-- Inculde the necessary page-->
			<?php 
				if($include != 'theme/home.php'){
					include($include);
				}
			?>
			<?php if($include=="theme/home.php"){
			?>



			
			
			
			
			
			
			<div id="test">
				<div class="container">
					<div class="row-fluid">
						<div class="span6">
						
							<?php 
								/* 
								*  pending post query
								*/
								$query = borno_query("SELECT * FROM $prefix_content where post_status='pending'");
								$count = mysqli_num_rows($query);
							?>
							
			
						 <div class="col-md-9">
                     <!--   Basic Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quick Information
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table table-striped table-hover">
                                   
                                    <tbody>
                                        <tr>
                                            <td><?php echo site_count(0,'all_post').' '; ?></td>
                                            <td><a href="<?php echo admin_url() ; ?>/?pages=managepost&by=all">Published</a></td>
                                            <td><?php echo site_count(loginuserinfo('id'),'user_total_post'); ?></td>
                                            <td><a href="<?php echo admin_url() ; ?>/?pages=managepost&by=user">By you</a></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td>	<a href="<?php echo admin_url() ; ?>/?pages=managepost&by=totalpending">Pending</a></td>
											
											<td><?php 
											$notify = new notify(loginuserinfo('id'));
											echo $notify->counter();?>
											</td>
                                            <td><?php
							
							echo "<a href='".admin_url()."/?pages=notify'>Notification </a>";
						?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><?php echo  site_count($id=0,$thing='doc')?></td>
                                            <td>Document</td>
                                            <td><?php echo  site_count($id=0,$thing='total_user')?></td>
														
														
                                            <td>Users</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                      <!-- End  Basic Table  -->
                </div>
							  <div class="col-sm-6 col-md-3">
				<div class="thumbnail">
				<div class='label label-success'>ID</div>
				  <img src="<?php echo get_gravatar( loginuserinfo("email"), 90);?>"  class="thumbnail idcardavatar"/>
					 <center>
						  <div class="caption">
							<h3><?php echo display_name(loginuserinfo('id'));?></h3>
							<p><?php  echo ucr_role_name(loginuserinfo('level')) ;?></p>
							<p><a href="<?php echo user_profile_link(loginuserinfo('id'),false); ?>" class="btn btn-primary" role="button">Profile</a></p>
						  </div>
					</center>
				</div>
			  </div>
						
						
						
						
						</div>
						<div class="span6">
						
						
		
                
				
				
                <div class="col-md-6">
                     <!--   Basic Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Lasted Content
                        </div>
                        <div class="panel-body">
                                   
									<?php lasted_content_with_out_text(10); ?>
                                    
                        </div>
                    </div>
                      <!-- End  Basic Table  -->
                </div>  
				<div class="col-md-6">
                     <!--   Basic Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Lasted Comment
                        </div>
                        <div class="panel-body">
                                   
									<?php lasted_comment(5); ?>
                                    
                        </div>
                    </div>
                      <!-- End  Basic Table  -->
                </div>
    
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<?php } ?>