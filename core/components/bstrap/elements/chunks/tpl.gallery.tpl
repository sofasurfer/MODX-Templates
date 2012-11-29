[[$tpl.gallery.paging?album=`[[+album:lcase]]`]]
<ul class="thumbnails" id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery">
[[!getPage?
    &pageActiveTpl=`<li class="active"><a [[+title]] href="[[+href]]">[[+pageNo]]</a></li>`              
    &elementClass=`modSnippet`  
    &element=`Gallery`
    &limit=`[[+limit:default=`360`]]`
    &album=`[[+album]]`
    &cache=`cache-[[+album]]`
    &sort=`name`
    &pageVarKey=`page[[+album:lcase]]`
    &pageNavVar=`page.[[+album:lcase]]`    
    &totalVar=`total.[[+album:lcase]]`
    &placeholderPrefix=`[[+album:lcase]]`
    &itemCls=`[[+itemCls:default=`span2`]]` 
    &imgCls=`thumbnail`
    &thumbTpl=`tpl.gallery.item` 
    &thumbWidth=`160` 
    &thumbHeight=`120`
]]</ul>

<div class="pagination pagination-centered pagination-mini"><ul>[[+page.[[+album:lcase]]]]</ul></div>

<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery modal-fullscreen modal-fullscreen-stretch hide fade" tabindex="-1">
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
</div>