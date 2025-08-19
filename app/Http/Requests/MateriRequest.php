<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriRequest extends FormRequest
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
            'file_materi' => 'nullable|mimes:pdf|max:2048',
            'deskripsi' => 'required|string',
            'nama_materi' => 'required|string',
            'tanggal_deadline' => 'required|date|after_or_equal:today',
            'kelas_id' => 'required|exists:ref_kelas,id',
            'guru_id' => 'required|exists:guru,id',
            'mapel_id' => 'required|exists:ref_mapel,id',
        ];
    }

    public function messages()
    {
        return [
            'file_materi.mimes' => 'File harus berupa pdf',
            'file_materi.max' => 'Ukuran file maksimal 2MB.',
            'deskripsi.required' => 'Deskripsi materi harus diisi.',
            'nama_materi.required' => 'Nama materi harus diisi.',
            'kelas_id.required' => 'Kelas harus dipilih.',
            'guru_id.required' => 'Guru harus dipilih.',
            'mapel_id.required' => 'Mapel harus dipilih.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
            'guru_id.exists' => 'Guru yang dipilih tidak valid.',
            'mapel_id.exists' => 'Mapel yang dipilih tidak valid.',
            'tanggal_deadline.after_or_equal' => 'Tanggal deadline harus setelah tanggal hari ini.',
        ];
    }
}
