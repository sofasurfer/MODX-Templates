<ul class="thumbnails" id="[[*gallery]]" [[+rel:isequal=`gallery`:then=`data-toggle="modal-gallery" data-target="#modal-gallery"`]] >
[[!getPage?
    &pageActiveTpl=`<li class="active"><a [[+title]] href="[[+href]]">[[+pageNo]]</a></li>`              
    &elementClass=`modSnippet`  
    &element=`[[+element:default=`Gallery`]]`
    &limit=`[[+limit:default=`60`]]`
    &album=`[[*gallery]]`
    &path=`[[+path]]`
    &rel=`[[+rel:default=`gallery`]]`     
    &data-target=`[[+data-target]]`   
    &data-content=`[[+data-content]]`   
    &source=`[[+source:default=`4`]]`
    &sort=`[[+sort:default=`name`]]`
    &dir=`[[+dir:default=`ASC`]]`
    &pageLimit=`10`
    &cache_expires=`0`
    &cache_resource_key=`gallery`
    &pageVarKey=`page-[[*gallery:lcase]]`
    &pageNavVar=`page.[[*gallery:lcase]]`
    &totalVar=`total.[[*gallery:lcase]]`
    &placeholderPrefix=`[[*gallery:lcase]]`
    &itemCls=`[[+itemCls:default=`span2`]]`
    &imageWidth=`1024`
    &imageHeight=`1024`
    &thumbTpl=`tpl.gallery.item`
    &thumbWidth=`[[+width:default=`160`]]`
    &thumbHeight=`[[+height:default=`120`]]`
]]</ul>
<div class="pagination pagination-centered"><ul>[[+page.[[*gallery:lcase]]]]</ul></div>


<!-- modal-gallery is the modal dialog used for the image gallery -->
<!--div id="modal-gallery" class="modal modal-gallery modal-fullscreen modal-fullscreen-stretch hide fade" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
    </div>
</div-->

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>