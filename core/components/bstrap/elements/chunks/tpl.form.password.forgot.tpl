	<form class="form-horizontal" action="[[~[[*id]]]]?action=ForgotPassword" method="post"> 
		[[+loginfp.errors:notempty=`
		    <div class="alert alert-danger" role="alert">
		        <p>[[+loginfp.errors]]</p>
		    </div>
		`]]     
		<div class="form-group">
			<label class="col-sm-2 control-label" class="control-label" for="username">[[%login.username]]</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="username" name="username" placeholder="username" value="[[+loginfp.post.username]]">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
	    		[[%login.or_forgot_username]]
	    	</div>
	 	</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" class="control-label" for="email">[[%login.email]]</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="email" name="email" placeholder="email" value="[[+loginfp.post.email]]">
			</div>
		</div>	 
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
		        <input class="returnUrl" type="hidden" name="returnUrl" value="[[+loginfp.request_uri]]" />
	        	<input class="loginFPService" type="hidden" name="login_fp_service" value="forgotpassword" />
	        	<button class="btn btn-default btn btn-primary" type="submit" name="login_fp" >[[%login.reset_password]]</button>
	        	<a href="[[~[[*id]]]]" class="btn">Cancel</a>
			</div>
	  	</div>
	</form>

