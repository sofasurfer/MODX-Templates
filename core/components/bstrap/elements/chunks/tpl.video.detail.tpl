<div class="row">
    <div class="col-md-12">
        <h2>[[+title]]</h2>
        <div align="center" class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item"
                [[+jpg:isnot=``:then=`poster="[[+path]]/[[+jpg:phpthumbof=`w=[[+width]]&h=[[+height]]&zc=[[+imagecrop:default=`1`]]]]"`]] 
                controls="controls" preload="[[+preload:default=`auto`]]" [[+autoplay:isequal=`1`:then=`autoplay="autoplay"`]]>
                [[+mp4:isnot=``:then=`<source type="video/mp4" src="[[+path]]/[[+mp4]]" />`]]
                [[+webm:isnot=``:then=`<source type="video/webm" src="[[+path]]/[[+webm]]" />`]]
                [[+ogv:isnot=``:then=`<source type="video/ogg" src="[[+path]]/[[+ogv]]" />`]]
                <img src="[[+jpg]]" width="[[+width]]" height="[[+height]]" title="No video playback capabilities" />
            </video>
        </div>
    </div>
</div>