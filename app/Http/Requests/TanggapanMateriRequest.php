<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TanggapanMateriRequest extends FormRequest
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
            'file' => 'nullable|mimes:pdf|max:2048',
            'materi_id' => 'required|exists:materi,id',
            'kelas_id' => 'required|exists:ref_kelas,id',
            'guru_id' => 'required|exists:guru,id',
            'tanggapan' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'materi_id.required' => 'ID Materi harus diisi.',
            'materi_id.exists' => 'ID Materi tidak valid.',
            'kelas_id.required' => 'ID Kelas harus diisi.',
            'kelas_id.exists' => 'ID Kelas tidak valid.',
            'guru_id.required' => 'ID Guru harus diisi.',
            'guru_id.exists' => 'ID Guru tidak valid.',
            'tanggapan.required' => 'Tanggapan harus diisi.',
            'tanggapan.string' => 'Tanggapan harus berupa teks.',
            'file.mimes' => 'File harus berupa pdf.',
            'file.max' => 'Ukuran file maksimal 2MB.',
        ];
    }
}
