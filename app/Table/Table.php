<?php

namespace App\Table;

use Illuminate\Database\Eloquent\Builder;

class Table
{
	private $rows = [];
	private $columns = [];
	private $rowsArray = [];
	private $actions = [];
	private $filters = [];
	private $joins = [];
	private $where = [];
	private $groupBy = [];
	private $with = [];

	public  $columnsList = [];
	public  $columnUnique = [];

	/**
	 * @var Builder
	 */
	private $model = null;
	private $modelOriginal = null;
	private $perPage = 15;

	public function paginate($perPage)
	{
		$this->perPage = $perPage;
		return $this;
	}

	public function rows(){
		return $this->rows;
	}

	public function model($model = null){
		if(!$model) {
			return $this->model;
		}
		$this->model = !is_object($model) ? new $model : $model;
		$this->modelOriginal = clone $this->model;
		return $this;
	}

	public function joins($joins)
	{
		$this->joins = $joins;
		return $this;
	}

	public function filters($filters)
	{
		$this->filters = $filters;
		return $this;
	}

	public function where($where)
	{
		$this->where = $where;
		return $this;
	}

	public function groupBy($groupBy)
	{
		$this->groupBy = $groupBy;
		return $this;
	}

	public function with($with)
	{
		$this->with = $with;
		return $this;
	}

	public function columns($columns = null){
		if(!$columns) {
			return $this->columns;
		}
		$this->columnsList = $columns;
		foreach($columns as $key => $column){
			$columns[$key]['column'] = (isset($column['alias']) ? $column['column'].' as '.$column['alias'] : $column['column']);
			if(isset($columns[$key]['with_pivot'])){
				unset($columns[$key]);
			}
			if(isset($column['type']) && $column['type'] == 'column_unique'){
				if(isset($column['column_unique_main'])){
					$column_key = $key;
				}
				$columns[$column_key]['column_unique'][] = $column['column'];
			}
		}
		$this->columns = ($columns);
		return $this;
	}

	public function rowsArray()
	{
		return $this->rowsArray->data;
	}

	public function actions()
	{
		return $this->actions;
	}

	public function addAction($label, $route, $color = null, $template = null)
	{
		$this->actions[] = [
			'label' => $label,
			'route' => $route,
			'color' => $color,
			'template' => $template
		];
		return $this;
	}

	public function addEditAction($route, $color = null, $template = null)
	{
		$this->addAction('Editar', $route, $color, !$template ? 'table.edit_action' : $template);
		return $this;
	}

	public function addDeleteAction($route, $color = null, $template = null)
	{
		$this->addAction('', $route, $color, !$template ? 'table.delete_action' : $template);
		return $this;
	}

	public function search()
	{
		$columns = collect($this->columns())->pluck('column')->toArray();
		$this->applyWith();
		$this->applyJoins();
		$this->applyWhere();
		$this->applyGroupBy();
		$this->applyFilters();
		$this->applyOrder();
		// dd($this->model->toSql());
		$this->rows = $this->model->paginate($this->perPage, $columns);
		return $this;
	}

	protected function applyFilters()
	{
		foreach ($this->filters as $filter) {
			$field = $filter['name'];
			$operator = $filter['operator'];

			$search = \Request::get($filter['label']);

			$this->search[$filter['label']] = $search;
			if(!empty($search)){
				$search = strtolower($operator) === 'like' ? "%{$search}%" : $search;
				if($operator == 'between') {
					$dateStart = \DateTime::createFromFormat('d/m/Y', \Request::get($filter['date_start']))->format('Y-m-d').' 00:00:00';
					$dateEnd = \DateTime::createFromFormat('d/m/Y', \Request::get($filter['date_end']))->format('Y-m-d').' 23:59:59';
					$this->model = $this->model->whereBetween($field, [$dateStart, $dateEnd]);
				} else if(!strpos($filter['name'], '.') || $filter['model_master'] == 1) {
					$this->model = $this->model->where($field, $operator, $search);
				} else {
					if(isset($filter['no_relation']) == true){
						$this->model = $this->model->where($field, $operator, $search);
					} else {
						list($relation, $field) = explode('.', $filter['name']);
						$this->model = $this->model->whereHas($relation, function($query) use ($field, $operator, $search) {
							$query->where($field, $operator, $search);
						});
					}
				}
			} else if(isset($filter['start'])){
				if($operator == 'between') {
					$dateStart = (new \DateTime())->modify('-1 month');
					$dateEnd = new \DateTime();
					$this->model = $this->model->whereBetween($field, [$dateStart, $dateEnd]);
				}
			}
		}
	}

	protected function applyOrder()
	{
		$fieldOrderParam = \Request::get('field_order');
		$orderParam = \Request::get('order');
		foreach ($this->columns() as $key => $column){
			if($column['name'] === $fieldOrderParam && isset($column['order'])){
				$order = $orderParam == 'desc' ? 'desc' :  'asc';
				$this->columns[$key]['_order'] = $order;
				$this->model = $this->model->orderBy("{$column['name']}", $order);
			} elseif(isset($column['order'])){
				$this->columns[$key]['_order'] = $column['order'];
				if($column['order'] === 'asc' || $column['order'] === 'desc') {
					$this->model = $this->model->orderBy("{$column['name']}", $column['order']);
				}
			}
		}
	}

	protected function applyJoins()
	{
		foreach ($this->joins as $join) {
			$this->model = $this->model->{$join['type']}($join['name'], $join['id1'], $join['id2']);
		}
	}

	protected function applyWhere()
	{
		if(isset($this->where) && !empty($this->where[0])){
			foreach ($this->where as $where) {
				$this->model = $this->model->where($where['column'], '=', $where['value']);
			}
		}
	}

	protected function applyGroupBy()
	{
		foreach ($this->groupBy as $column) {
			$this->model = $this->model->groupBy($column);
		}
	}

	protected function applyWith()
	{
		foreach ($this->with as $table) {
			if(!empty($table['filter'])){
				$field = $table['filter'][0];
				$operator = $table['filter'][1];
				$search = $table['filter'][2];
				$this->model = $this->model->orWhereHas($table['table'], function($query) use ($field, $operator, $search) {
					$query->where($field, $operator, $search);
				});
			} else {

				$this->model = $this->model->with([$table['table'] => function($query) use ($table) {
					$query->select($table['columns']);
				}]);
			}

			$this->model = $this->model->orWhereHas($table['table'], function($query) {
				$query->whereNull('deleted_at');
			});
		}
	}
}
