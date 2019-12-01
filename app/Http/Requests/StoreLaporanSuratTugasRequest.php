<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanSuratTugasRequest extends FormRequest
{
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
            'surat_tugas_id'=>'required|unique:laporan_surat_tugas,surat_tugas_id|exists:surat_tugas,id',
            'tanggal_approve_ketua_tim'=>'required',
            'tanggal_approve_pengendali_mutu'=>'required',
            'tanggal_approve_pengendali_teknis'=>'required',
            'attachment'=>'required|file|mimes:jpg,jpeg,png,JPG,JPEG,PNG,pdf,PDF',
        ];
    }
}
