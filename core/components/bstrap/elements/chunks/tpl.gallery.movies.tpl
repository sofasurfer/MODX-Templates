<center>
<ul class="thumbnails">  
[[!getPage?
	&pageActiveTpl=`<li class="active"><a [[+title]] href="[[+href]]">[[+pageNo]]</a></li>`  
	&element=`getDir`
	&limit=`90`
	&pageSlider=`24`
    &pageVarKey=`page-[[+directory]]`
	&pageNavVar=`page.[[+directory]]`
	&totalVar=`total-[[+directory]]`
	&sort=`time`
	&dir=`DESC` 
	&path=`[[+directory]]/`
	&source=`4`
	&class=`span2`
	&tpl=`tpl.thumb.item`
	&data-target=`#modal-video`
	&data-toggle=`modal`
    &data-content=`[[+duration]]`
	&title=``
    &alias=`[[+directory]]`
	&caption-class=`caption`
	&rel=`[[+path]]`
	&width=`260`
	&height=`180`
]]
</ul>
<div class="pagination pagination-centered"><ul>[[!+page.[[+directory]]]]</ul></div>
<small>Total [[!+total-[[+directory]]]] results ([^t^])</small>
</center>