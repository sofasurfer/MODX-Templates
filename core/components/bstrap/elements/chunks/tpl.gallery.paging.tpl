<div class="row-fluid"> 
    <div class="span6"><p class="lead">Show [[+firstItem]] - [[+lastItem]] of Total [[+total.[[+album]]]] Results.</p></div>    
    <div class="span6">
        <div class="btn-toolbar">
            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Sort<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="[[~[[*id]]?sort=`name`]]" >Name</a></li>
                    <li><a href="[[~[[*id]]?sort=`date`]]" >Date</a></li>
                    <li><a href="[[~[[*id]]?sort=`size`]]" >Size</a></li>
                    <li><a href="[[~[[*id]]?sort=`rank`]]" >Rank</a></li>
                </ul>
            </div>
            [[+albumTags:notempty=`
            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Tags<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    [[!getTags?ids=`[[+albumTags]]`&tpl=`tpl.tag.menu`]]
                </ul>
            </div>
            `]]
        </div>
    </div>
</div>