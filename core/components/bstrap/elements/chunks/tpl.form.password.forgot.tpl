	<form class="form-horizontal" action="[[~[[*id]]]]?action=ForgotPassword" method="post"> 
		[[+loginfp.errors:notempty=`
		    <div class="alert alert-block alert-error fade in">
		        <button type="button" class="close" data-dismiss="alert">×</button>
		        <h4 class="alert-heading"><b class="icon-thumbs-down"></b> Oh snap! You got an error!</h4>
		        <p>[[+loginfp.errors]]</p>
		    </div>
		`]]     
		<div class="control-group">
			<label class="control-label" for="username">[[%login.username]]</label>
			<div class="controls">
			  <input type="text" id="username" name="username" placeholder="username" value="[[+loginfp.post.username]]">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
	    		[[%login.or_forgot_username]]
	    	</div>
	 	</div>
		<div class="control-group">
			<label class="control-label" for="email">[[%login.email]]</label>
			<div class="controls">
			  <input type="text" id="email" name="email" placeholder="email" value="[[+loginfp.post.email]]">
			</div>
		</div>	 
		<div class="form-actions">
	        <input class="returnUrl" type="hidden" name="returnUrl" value="[[+loginfp.request_uri]]" />
        	<input class="loginFPService" type="hidden" name="login_fp_service" value="forgotpassword" />
        	<button class="btn btn-primary" type="submit" name="login_fp" >[[%login.reset_password]]</button>
        	<a href="[[~[[*id]]]]" class="btn">Cancel</a>
	  	</div>
	</form>

