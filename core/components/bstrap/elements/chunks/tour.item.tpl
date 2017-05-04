<li class="touritem">
	<span>[[+show_date:strtotime:date=`%e %B %Y`]]</span>
	- <a target="_blank" title="[[+club_name]] - [[+club_city]] ([[+club_country_code]])" href="[[+show_link:isnot=``:then=`[[+show_link]]`:else=`[[+club_website]]`]]">[[+club_name]]</a>
	<span>- [[+club_city]] ([[+club_country_code]])</span>
	[[+show_ticket_link:notempty=`
		<a target="_blank" title="Buy ticket" href="[[+show_ticket_link]]" class="ticket">
			<img height="15" src="http://neofill.com/wp-content/themes/neofill/images/ticket-icon.png" />
		</a>
	`]]
</li>