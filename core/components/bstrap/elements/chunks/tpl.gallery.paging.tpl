<div class="[[*layout:isequal=`fluid`:then=`row-fluid`:else=`row`]]">
    <div class="span4">
        <p class="navbar-text pull-left lead">
            [[!+pageCount:gt=`1`:then=`Page <strong>[[!+page]]</strong>, total `:else=`Total `]]
            <abbr title="Cached: [[!+gallerycacheage]] Time: [^t^]">
                <strong>[[+gallerytotal]]</strong> 
            </abbr>
            results
        </p>
    </div>
    <div class="span4"><center>
    [[!BreadCrumb? &showBreadCrumbAtHome=`0` &showHomeCrumb=`0` &currentAsLink=`1` &crumbSeparator=`>` &containerTpl=`tpl.breadcrumb.container`&linkCrumbTpl=`tpl.breadcrumb.row` &cls=`breadcrumb`]]
    </center></div>
    <div class="span4">    
        <div class="btn-toolbar pull-right">
            <div class="btn-group">
                <button class="btn btn-small">Sort</button>
                <button class="btn btn-small btn-small btn-small dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>        
                <ul class="dropdown-menu">
                    <li class="first [[+sort:isequal=`name`:then=`active`]]"><a href="[[~[[*id]]?sort=`name`]]" >Name</a></li>
                    <li [[+sort:isequal=`rank`:then=`class="active"`]] ><a href="[[~[[*id]]?sort=`rank`]]" >Rank</a></li>
                    <li [[+sort:isequal=`createdon`:then=`class="active"`]] ><a href="[[~[[*id]]?sort=`createdon`]]" >Date</a></li>
                    <li [[+sort:isequal=`rand`:then=`class="active"`]] ><a href="[[~[[*id]]?sort=`rand`]]" >Random</a></li>
                </ul>
            </div>
            <div class="btn-group">
                [[+albumTags:notempty=`
                <button class="btn btn-small btn-small">Tags</button>
                <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>            
                <ul class="dropdown-menu">
                    [[!getTags?ids=`[[+albumTags]]`&tpl=`tpl.tag.menu`]]
                </ul>
                `]]
            </div>  
        </div> 
    </div>
</div>
