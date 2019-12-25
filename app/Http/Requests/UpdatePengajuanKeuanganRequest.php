<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengajuanKeuanganRequest extends FormRequest
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
            'jenis_surat_tugas_id'=>'required|integer|exists:jenis_surat_tugas,id',
            'nama_kegiatan'=>'required',
            'tanggal_mulai_kegiatan'=>'required',
            'tanggal_selesai_kegiatan'=>'required',
            'pic_id'=>'required',
            'jumlah_pengajuan'=>'required'
        ];
    }
}
