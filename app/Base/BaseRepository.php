<?php

namespace App\Base;

abstract class BaseRepository
{
    public $model;

    public function __construct()
    {
        $this->getModel();
    }

    abstract public function getModel();

    public function all($data = [])
    {
        return $this->model->with($data)->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->model->where($column, $operator, $value, $boolean);
    }

    public function orderBy($column, $direction = 'asc')
    {
        return $this->model->orderby($column, $direction);
    }

    public function get($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function update($id, $data)
    {
        $object = $this->model->find($id);
        $object->fill($data);
        $object->save();
        return $object;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();
        return $model;
    }

    public function find($id, $with = [])
    {
        return $this->model->with($with)->findOrFail($id);
    }

    public function findSelect($select_fields=['*'], $id = null, $with = [])
    {
        return $this->model->select($select_fields)->with($with)->findOrFail($id);
    }

    public function first()
    {
        return $this->model->first();
    }

    public function findBy($column, $value, $with = [], $operator = '=')
    {
        return $this->model->with($with)->where($column, $operator, $value);
    }

    public function findByUser($column, $value, $with = [], $operator = '=')
    {
        return $this->model->with($with)
            ->where('user_id', Auth::user()->id)
            ->where($column, $operator, $value);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function paginate($value)
    {
        return $this->model->paginate($value);
    }

    public function count()
    {
        return $this->model->count();
    }

    public function mask($type, $str)
    {
        $mask = '';
        switch ($type) {
            case 'cnpj':
                $mask = '##.###.###/####-##';
                break;
            case 'cpf':
                $mask = '###.###.###-##';
                break;
            case 'telefone':
                $mask = '(##) ####-####';
                break;
            case 'celular':
                $mask = '(##) #####-####';
                break;
            case 'cep':
                $mask = '#####-###';
                break;
        }
        $str = str_replace(" ", "", $str);
        for ($i = 0; $i < strlen($str); $i++) {
            $mask[strpos($mask, "#")] = $str[$i];
        }

        return $mask;

    }

    public function replace($array, $rm, $data)
    {
        $str = $data;
        foreach ($array as $remove) {
            $str = str_replace($remove, $rm, $str);
        }
        return $str;
    }

    public function moneyFormat($money)
    {
        $money = str_replace('R$ ', '', $money);
        $money = str_replace(' R$', '', $money);
        $money = str_replace('.', '', $money);
        $money = str_replace(',', '.', $money);
        return $money != '' ? $money : null;
    }

    public function formatMoney($money)
    {
        $money = 'R$ '.str_replace('.', ',', $money);
        return $money != '' ? $money : null;
    }

    public function countRelationships($id, $relations)
    {
        $model = $this->model->where('id', '=', $id)
            ->withCount($relations)
            ->first();

        $hasRelationships = false;

        $result = collect($relations)->mapToGroups(function($relation) use ($model, &$hasRelationships){
            $countName = $relation.'_count';

            $count = $model->$countName ?? 0;

            if($count)
                $hasRelationships = true;

            return [$relation => $count];
        });

        $result->put('model', $model);

        $result->put('has_relationships', $hasRelationships);

        return $result;
    }

    public function onlyTrashed()
    {
        return $this->model->onlyTrashed();
    }

    public function findOrCreate($data)
    {
        return $this->model->firstOrCreate($data);
    }
}