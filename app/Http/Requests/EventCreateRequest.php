<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EventCreateRequest extends FormRequest
{

    //protected $redirectRoute = ' EventController@store  ' ;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'direccion'=>'required',
        'direccion.required'=>'Es necesario ingresar una direccion para el evento',
        'latitud'=>'required',
        'longitud'=>'required',
        'titulo'=>'required',
        'tipoevento'=>'required',
        'descripcion'=>'required',
        'fecharegistro'=>'required',
        'fechainicio'=>'required',
        'fechafin'=>'required',
        'horainicio'=>'required',
        'horafin'=>'required',
        'fecharecordatorio'=>'required',
        'horarecordatorio'=>'required',
        'recurrente'=>'required',
        'periodo'=>'required',
        'url'=>'required',
        'temporizador'=>'required',
        'zonahoraria'=>'required',
        'usuario_id'=>'required'
        ];
    }
}
