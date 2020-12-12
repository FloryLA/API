<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EventRequest extends FormRequest
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
            'empresa_id' => "nullable|numeric",
            'sucursal_id' => "nullable|numeric",
            'usuario_id' => "required|numeric",
            'supervisor_id'=>"nullable|numeric",
            'project_id' => "nullable|numeric|exists:projects,id",
            'contacto_id' => "nullable|numeric",
            'titulo' => "required|string|max:255",
            'descripcion' => "nullable|string",
            'direccion' => "nullable|string",
            'latitud' => "nullable|numeric",
            'longitud' => "nullable|numeric",
            'tipoevento' => "nullable|string",
            'fechainicio' => "required|date",
            'horainicio' => 'nullable|date_multi_format:"H:i","H:i:s"',
            'fecharegistro' => "required|date",
            'fechafin' => "required|date",
            'horafin' => 'nullable|date_multi_format:"H:i","H:i:s"',
            'fecharecordatorio' => "required|date",
            'horarecordatorio' => 'nullable|date_multi_format:"H:i","H:i:s"',
            'temporizador' => 'nullable|date_multi_format:"H:i","H:i:s"',
            'recurrente' => "nullable|string",
            'periodo' => "nullable|string",
            'url' => "nullable|string"
        ];
    }








}
