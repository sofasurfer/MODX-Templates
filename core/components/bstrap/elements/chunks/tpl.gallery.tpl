<center>
<ul class="thumbnails">
[[!getPage?   
    &pageActiveTpl=`<li class="active"><a [[+title]] href="[[+href]]">[[+pageNo]]</a></li>`              
    &elementClass=`modSnippet`  
    &element=`Gallery`
    &limit=`[[+limit]]`
    &album=`[[+album]]`
    &pageVarKey=`page[[+album]]`
    &pageNavVar=`page.[[+album]]`    
    &totalVar=`total-[[+album]]`
    &itemCls=`span2` 
    &imgCls=`thumbnail`
    &thumbTpl=`tpl.gallery.item` 
    &thumbWidth=`160` 
    &thumbHeight=`120`
    &plugin=`slimbox` 
    &loop=`1`
    &slimboxRenderJsOnStartup=`0` 
]]</ul>
<div class="pagination pagination-centered pagination-mini"><ul>[[!+page.[[+album]]]]</ul></div>
<small>Total [[!+total-[[+album]]]] results ([^t^])</small>    
</center>