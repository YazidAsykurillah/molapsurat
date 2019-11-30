<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuratTugasRequest extends FormRequest
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
            'nomor'=>'required',
            'tanggal'=>'required',
            'jenis_surat_tugas_id'=>'required',
            'tujuan_surat_tugas_id'=>'required',
            'uraian'=>'required',
            'attachment'=>'required|file|mimes:jpg,jpeg,png,JPG,JPEG,PNG,pdf,PDF',
        ];
    }
}
