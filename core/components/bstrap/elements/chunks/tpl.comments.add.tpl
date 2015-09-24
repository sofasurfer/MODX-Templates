[[+preview]]
<span class="quip-success" id="quip-success-[[+idprefix]]">[[+successMsg]]</span>
 
<form class="form-horizontal" id="quip-add-comment-[[+idprefix]]" action="[[+url]]#comments" method="post">
    <input type="hidden" name="nospam" value="" />
    <input type="hidden" name="thread" value="[[+thread]]" />
    <input type="hidden" name="parent" value="[[+parent]]" />
    <input type="hidden" name="auth_nonce" value="[[+auth_nonce]]" />
    <input type="hidden" name="preview_mode" value="[[+preview_mode]]" />

    <div class="form-group">     
        <label class="col-sm-2 control-label" for="quip-comment-notify-[[+idprefix]]">[[%quip.notify_me]]:<span class="quip-error">[[+error.notify]]</span></label>
        <div class="col-sm-10">        
            <input class="form-control text-left" type="checkbox" value="1" name="notify" id="quip-comment-notify-[[+idprefix]]" [[+notify:if=`[[+notify]]`:eq=`1`:then=`checked="checked"`]] />
        </div>
    </div>   

    <div class="form-group [[+error.name:notempty=`error`]]">
        <label class="col-sm-2 control-label" for="quip-comment-name-[[+idprefix]]">[[%quip.name? &namespace=`quip` &topic=`default`]]</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="quip-comment-name-[[+idprefix]]" value="[[+name]]" />
            <span class="help-inline">[[+error.name]]</span>
        </div>
    </div>

    <div class="form-group [[+error.email:notempty=`error`]]">
        <label class="col-sm-2 control-label" for="quip-comment-email-[[+idprefix]]">[[%quip.email? &namespace=`quip` &topic=`default`]]</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="email" id="quip-comment-email-[[+idprefix]]" value="[[+email]]" />
            <span class="help-inline">[[+error.email]]</span>
        </div>
    </div>

    <!--div class="form-group [[+error.website:notempty=`error`]]">
        <label class="col-sm-2 control-label" for="quip-comment-website-[[+idprefix]]">[[%quip.website? &namespace=`quip` &topic=`default`]]</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="website" id="quip-comment-website-[[+idprefix]]" value="[[+website]]" />
            <span class="help-inline">[[+error.website]]</span>
        </div>
    </div-->

 
    <div class="form-group recaptcha">
        [[+quip.recaptcha_html]]
        <span class="quip-error">[[+error.recaptcha]]</span>
    </div>
   
    <div class="form-group [[+error.comment:notempty=`error`]]">
        <label class="col-sm-2 control-label" for="quip-comment-comment-[[+idprefix]]">[[%quip.comment_add_new]]</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="comment" id="quip-comment-box-[[+idprefix]]" rows="5">[[+comment]]</textarea>
            <span class="help-inline">[[+error.comment]]</span>
        </div>
    </div>     
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            [[+can_post:is=`1`:then=`<button type="submit" class="btn btn-primary" name="[[+post_action]]" value="1">[[%quip.post]]</button>`]]
            <button type="submit" class="btn btn-default" name="[[+preview_action]]" value="1">[[%quip.preview]]</button>
        </div>
    </div> 
</form>
