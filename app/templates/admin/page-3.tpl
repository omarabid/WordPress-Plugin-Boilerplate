<div class="wrap">
	<h2>{{ title }}</h2>

	<form id="wpbp-search" method="get" action="{{ admin_url }}">
		<input type="hidden" name="page" value=""/>
		{{ table | raw }}	
	</form>
</div>
