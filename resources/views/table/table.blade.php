@if(count($table->rows()))
{!! $table->rows()->appends($_GET)->links() !!}
<div class="table-responsive no-padding">
	<table class="table table-striped table-bordered table-hover" id="table-search">
		<thead>
			<tr>
				@foreach($table->columnsList as $key => $column)
					@if($column['label'] != false)
					<th data-name="{{$column['name']}}">
						{{$column['label']}}
						@if(isset($column['_order']))
							@php
								$icons = [
									1 => 'glyphicon-sort',
									'asc' => 'glyphicon-sort-by-alphabet',
									'desc' => 'glyphicon-sort-by-alphabet-alt',
								]
							@endphp
						<a href="javascript:void(0)">
							<span class="glyphicon {{$icons[$column['_order']]}}"></span>
						</a>
						@endif
					</th>
					@endif
				@endforeach
				@if(count($table->actions()))
					<th class="text-center">Ações</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($table->rows() as $row)
				<tr>
					@foreach($table->columnsList as $key => $column)
						@if(isset($column['type']) && in_array($column['type'], ['datetime']))
							<td>{{ $row->{$column['name']}->format('d/m/Y') }}</td>
						@elseif(isset($column['type']) && in_array($column['type'], ['date']))
							<td>{{ date('d/m/Y', strtotime($row->{$column['name']})) }}</td>
						@elseif(isset($column['type']) && in_array($column['type'], ['money']))
							<td>R$ {{ number_format($row->{$column['name']}, 2, ',', '.') }}</td>
						@elseif(isset($column['type']) && in_array($column['type'], ['cpf']))
							<td>{{ !empty($row->{$column['name']}) ? CustomHelper::mask($row->{$column['name']}, '###.###.###-##') : null }}</td>
						@elseif(isset($column['type']) && in_array($column['type'], ['tel']))
							<td>{{ !empty($row->{$column['name']}) ? CustomHelper::mask($row->{$column['name']}, '(##) ####-#####') : null }}</td>
						@elseif(isset($column['type']) && in_array($column['type'], ['boolean']))
							<td>{!! !empty($row->{$column['name']}) ? '<span class="label bg-green">Sim</span>' : '<span class="label bg-red">Não</span>' !!}</td>
						@elseif(isset($column['type']) && in_array($column['type'], ['column_unique']))
							<td>{{ $row->{$column['name']} }}</td>
						@elseif(isset($column['type']) && $column['type'] == 'date_with_label')
							<td>
								{{ date('d/m/Y', strtotime($row->{$column['name']})) }}
								@if(isset($row->{$column['view_label']}))
								<span class="pull-right-container">
					              	<span class="label {{ $row->{$column['color_label']} }} pull-right">-{{ $row->{$column['view_label']} }}</span>
					            </span>
					            @endif
							</td>
						@elseif(isset($column['with']))
							<td>
								@if(is_object($row->{$column['with']}) && !isset($row->{$column['with']}[0]))
									{{ $row->{$column['with']}->{$column['column_with']} }}
								@else
									@foreach ($row->{$column['with']} as $name)
									<span class="label bg-green">{{ $name->{$column['column_with']} }}</span>
									@endforeach
								@endif
							</td>
						@elseif($column['label'] != false)
							<td>{{ $row->{$column['name']} }}</td>
						@endif
					@endforeach
					@if(count($table->actions()))
						<td class="text-center">
							@foreach($table->actions() as $action)
								@include($action['template'], [
									'row' => $row,
									'action' => $action,
									'color' => $action['color']
								])
							@endforeach
						</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	@if(count($table->rows()) == 1)
	<p>Foi encontrado {{ count($table->rows()) }} registro</p>
	@elseif($table->rows()->total() > $table->rows()->perPage())
	<p>Exibindo {{ count($table->rows()) }} de um total de {{ $table->rows()->total() }} registros</p>
	@else
	<p>Foram encontrados {{ count($table->rows()) }} registros</p>
	@endif
	{!! $table->rows()->appends($_GET)->links() !!}
</div>
@else
<table class="table">
	<tr>
		<td>Nenhum registro encontrado!</td>
	</tr>
</table>
@endif

@push('js')
<script type="text/javascript">
	$(document).ready(function(){
		$('#table-search>thead>tr>th[data-name]>a')
			.click(function(){
				var anchor = $(this);
				var field = anchor.closest('th').attr('data-name');
				var order = 
					anchor.find('span').hasClass('glyphicon-sort-by-alphabet-alt') || anchor.find('span').hasClass('glyphicon-sort')
					? 'asc':'desc';
				var url = "{{url()->current()}}?";
				@if(\Request::get('page'))
					url += "page={{\Request::get('page')}}&";
				@endif
				@if(\Request::get('search'))
					url += "search={{\Request::get('search')}}&";
				@endif
				url+='field_order='+field+'&order='+order;
				window.location = url;
			});
	});
</script>
@endpush