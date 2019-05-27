<a href="{{route($action['route'], [$row->getKey()])}}" class="btn {{ isset($action['color']) ? $action['color'] : 'btn-primary' }} btn-xs">
	<span class="glyphicon glyphicon-pencil"></span> @lang('common.editar')
</a>