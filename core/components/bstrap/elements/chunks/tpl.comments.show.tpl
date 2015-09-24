<li class="[[+cls]]" id="[[+idprefix]][[+id]]" [[+depth_margin:notempty=`style="padding-left: [[+depth_margin]]px"`]]>

    <div class="quip-comment-left">
        [[+gravatarUrl:notempty=`<img src="[[+gravatarUrl]]" class="quip-avatar" alt="" />`]]
    </div>

	<div id="[[+idprefix]][[+id]]-div" class="quip-comment-body [[+alt]]">

	    <p class="quip-comment-meta">
	        <span class="quip-comment-author">[[+authorName]]:</span> 
	        <span class="quip-comment-createdon"><a href="[[+url]]">[[+createdon]]</a>
	        [[+approved:if=`[[+approved]]`:is=`1`:then=``:else=`- <em>[[%quip.unapproved? &namespace=`quip` &topic=`default`]]</em>`]]
	        </span>
	    </p>

	    <div class="quip-comment-text">
	        <p>[[+body]]</p>

	        [[+replyUrl:notempty=`<p><span class="quip-reply-link"><a href="[[+replyUrl]]">[[%quip.reply? &namespace=`quip` &topic=`default`]]</a></span></p>`]]
	    </div>

	    <div class="quip-comment-options">
	        [[+report]]
	        [[+options]]
	    </div>
	    <div class="quip-break"></div>
	</div>
    [[+children:notempty=`<ol class="quip-comment-list">[[+children]]</ol>`]]
</li>
