<li class="[[+cls]]">
    <a class="thumbnail" title="[[+name]]" href="[[+url]]" rel="[[+rel]]" [[+data-target:notempty=`data-target="[[+data-target]]"`]]  >
        <img src="[[+thumbnail]]" alt="[[+name]]" />[[+idx]]/[[+total]] : [[+pageSlider]] = [[+idx:add:mod=`[[+pageSlider]]`]]
    </a>
</li>
[[+idx:add:gt=`[[+total]]`:and:mod=`[[+pageSlider]]`:isequal=`0`:then=`[[+pageSliderContent]]`]]