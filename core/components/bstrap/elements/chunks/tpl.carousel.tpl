<div class="span6">
<div id="carousel[[+tv.gallery]]" class="carousel slide">
	<div class="carousel-inner" id="gallery-[[+tv.gallery]]" data-toggle="modal-[[+tv.gallery]]" data-target="#modal-[[+tv.gallery]]">
		<div class="item active"><ul class="thumbnails">
		[[!Gallery?
		    &useCss=`0`
		    &totalVar=`total[[+tv.gallery]]`
		    &start=`0`
		    &limit=`180`
		    &sort=`[[+sort:default=`rank`]]`
		    &album=`[[+tv.gallery]]`
		    &itemCls=`span2`
		    &activeCls=`active`
		    &thumbFar=`T`
		    &thumbZoomCrop=`1`
		    &thumbWidth=`260`
		    &thumbHeight=`180`
		    &thumbCls=`thumbnail`
		    &thumbTpl=`tpl.gallery.item`
		    &pageSliderContent=`</ul></div><div class="item"><ul class="thumbnails">`
		    &pageSlider=`[[+pageSlider:default=`12`]]`	    
		]]
		</ul></div>
		<div class="carousel-caption">
                     <h4><a href="[[~[[+id]]]]" title="[[+pagetitle]]">[[+longtitle:isnot=``:then=`[[+longtitle]]`:else=`[[+pagetitle]]`]]</a></h4>
                </div>
	</div>
	<a class="carousel-control left" href="#carousel[[+tv.gallery]]" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#carousel[[+tv.gallery]]" data-slide="next">&rsaquo;</a>
</div>
</div>