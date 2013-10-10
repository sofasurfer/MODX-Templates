<form id="my_id" action="[[~[[+landing:default=`[[*id]]`]]]]" method="[[+method:default=`get`]]">
	<div class="input-append">
	  <input id="searchField" class="span2" id="appendedInputButtons" name="query" type="text" value="[[+searchValue:default=`Search the site`]]">
	  <button class="btn" type="button">Search</button>
	</div>
    <input type="hidden" name="id" value="[[+landing:default=[[*id]]]]" />
</form>