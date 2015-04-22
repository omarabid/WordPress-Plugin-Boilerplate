<div class="wrap">
	<h2>{{ title }}</h2>
	<h3>Twig Examples</h3>
	<h4>Twig `Include` Example</h4>
	{% include 'sub/extend.tpl' %}
	<h4>Twig `For` Example</h4>
	<ul>
	{% for item in list %}
		<li>Item Value: {{ item.key }}</li>
	{% endfor %}
	</ul>
</div>
