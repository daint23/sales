<?php

namespace App\Http\Requests;

use App\Models\Mssalesman;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMssalesmanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $coba = Mssalesman::with(['jual'])->where('sal_id', $this->mssalesman->sal_id)->get();
        return [
            'nama' => ['required', Rule::unique('mssalesman', 'sal_nm')->ignore($this->mssalesman)],
            'kota' => ['required', 'exists:App\Models\Mskota,kta_id'],
            'bekerja_sejak' => ['nullable', 'date',
                function (string $attribute, mixed $value, Closure $fail) use ($coba) {
                    $juals = $coba[0]['jual'];
    
                    foreach ($juals as $jual) {
                        if ($value < $jual['jul_tanggaljual']) {
                            $fail('Tanggal kerja lebih kecil dari tanggal jual');
                        }
                    }
                }
            ]
        ];
    }
}
