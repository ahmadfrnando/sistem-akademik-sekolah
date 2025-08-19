<?php

namespace App\Http\Requests;

use App\Models\Guru;
use Illuminate\Foundation\Http\FormRequest;

class GuruKelasRequest extends FormRequest
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
    protected function prepareForValidation(): void
    {
        if ($this->guru_id) {
            $mapelId = Guru::whereKey($this->guru_id)->value('mapel_id');
            if ($mapelId) {
                // injeksikan ke payload sebelum proses rules()
                $this->merge(['mapel_id' => $mapelId]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'kelas_id' => 'required|exists:ref_kelas,id',
            'guru_id' => 'required|unique:guru_kelas,guru_id,NULL,id,kelas_id,' . $this->kelas_id,
            'mapel_id' => 'required|exists:ref_mapel,id',
            'nama_kelas' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'kelas_id.required' => 'Kelas harus dipilih.',
            'guru_id.required' => 'Guru harus dipilih.',
            'guru_id.unique' => 'Guru sudah terdaftar di kelas ini.',
            'nama_kelas.required' => 'Nama kelas harus diisi.',
        ];
    }
}
