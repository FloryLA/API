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
            'titulo' => "required|string|max:255",
            'id_usuario' => "required|numeric",
            'descripcion' => "nullable|string|max:255",
            'direccion' => "nullable|string|max:255",
            'latitud' => "nullable|numeric",
            'longitud' => "nullable|numeric",
            'tipoevento' => "nullable|string|max:255",
            'fecharegistro' => "nullable|date",
            'fechainicio' => "nullable|date",
            'fechafin' => "nullable|date",
            'horainicio' => "nullable|date_format:H:i",
            'horafin' => "nullable|date_format:H:i",
            'fecharecordatorio' => "nullable|date",
            'horarecordatorio' => "nullable|date_format:H:i",
            'temporizador' => "nullable|date_format:H:i",
            'recurrente' => "nullable|string|max:255",
            'periodo' => "nullable|string|max:255",
             'url' => "nullable|string|max:255",
        ];
    }
}
