<?php

namespace App\Http\Modules\Pacientes\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CrearPacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'oficio_id' => 'required|exists:oficios,id',
            'genero' => 'required|string',
            'lateralidad_dominante' => 'required|string',
            'municipio_id' => 'required|required|exists:municipios,id',
            'tipo_documento_id' => 'required|exists:tipos_documentos,id',
            'empresa_id' => 'required|exists:empresas,id',
            'estatura' => 'required|numeric',
            'estado_id' => 'required|exists:estados,id',
            'email' => 'required|email',
            'numero_documento' => 'required|integer|unique:users,numero_documento',
            'usa_lentes' => 'nullable|boolean',
            'sede_id' => 'required|exists:sedes,id',
            'dependencia_id' => 'required|exists:dependencias,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
           'estado_id' => 1
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
