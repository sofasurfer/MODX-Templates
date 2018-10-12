<div id="blueimp-gallery-images" class="row">
    [[!getPage?   
        &elementClass=`modSnippet`  
        &element=`Gallery`
        &pageActiveTpl=`<li class="active"><a[[+activeClasses:default=` class="active"`]][[+title]] href="[[+href]]">[[+pageNo]]</a></li>`        
        &totalVar=`total`
        &limit=`260` 
        &album=`[[+gallery]]` 
        &itemCls=`[[+itemCls:default=`col-md-2 gal-item`]]`
        &imgCls=`img-responsive`
        &clsImage=``
        &linkToImage=`1`
        &thumbWidth=`500`
        &thumbHeight=`500`
        &toPlaceholder=`page.list`]]
        [[+page.list]]   
    </div>
    <nav>
      <ul class="pagination">
        [[!+page.nav]]
      </ul>
    </nav>

    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

