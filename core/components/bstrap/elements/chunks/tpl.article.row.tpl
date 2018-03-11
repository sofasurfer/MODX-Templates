<div class="post col-md-4 grid-item" id="[[+alias]]">
  <div class="thumbnail">
    [[+tv.pageimage:isnot=``:then=`<a href="[[~[[+id]]]]" alt="[[+pagetitle]]" title="[[+pagetitle]]"><img class="img-responsive" src="[[+tv.pageimage:phpthumbof=`w=800&zc=0`]]" /></a>`]] 
    <div class="content">
        <h2 class="title"><a href="[[~[[+id]]]]" alt="[[+pagetitle]]" title="[[+pagetitle]]">[[+pagetitle]]</a></h2>   
        <p class="post-info">[[+publishedon:strtotime:date=`%b %d, %Y`]]</p>
        <div class="entry">
    	    <p>[[+introtext:default=`[[+content:strip_tags=``:ellipsis=`400`]]`]]</p>
        </div>
        <div class="postmeta">
          [[+tv.articlestags:notempty=`<span class="tags">[[%articles.tags]]: [[!tolinks? &items=`[[+tv.articlestags]]` &target=`[[*id]]` &useTagsFurl=`1`]]</span>`]]          
          <span class="links">
            <a href="[[~[[+id]]]]" class="readmore btn btn-default">[[%articles.read_more]]</a>
            [[+comments_enabled:is=`1`:then=`</a>`]]
          </span>
        </div>
    </div>
  </div>
</div>