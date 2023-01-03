<?php

namespace App\Exports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VisitorExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Visitor::all();
//     }
// }
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'DATE',
            'VISITOR ID',
            'NAME',
            'EMAIL',
            'PHONE',
            'HOST',
            'PURPOSE',
            'ADDRESS',
            'IMAGES'
        ];
    }

    public function rules()
    {
        return [
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }

    public function collection()
    {

        if (request()->start_date || request()->end_date != NULL) {

            // dd(request()->all());

            // $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            // dd($start_date,$end_date);

            $url = 'https://visitor.globalsync.com.au/Visitor/';

            $check = Visitor::whereBetween('created_at', [$start_date, $end_date])->count();

            // dd($check);

            $export_data =  Visitor::select("created_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")->whereBetween('created_at', [$start_date, $end_date])->orWhere('companyCode', 'LIKE', '%'. Auth::user()->company_name .'%')->orderby('created_at')->get();

            dd($export_data);

            $data_array[] = array(
                'DATE',
                'VISITOR ID',
                'NAME',
                'EMAIL',
                'PHONE',
                'HOST',
                'PURPOSE',
                'ADDRESS',
                'IMAGES'
            );

            foreach ($export_data as $data) {

                $data_array[] = array(
                    'created_at'        => $data->created_at,
                    'visitorID'         => $data->visitorID,
                    'name'              => $data->name,
                    'email'             => $data->email,
                    'phone'             => $data->phone,
                    'host'              => $data->host,
                    'purpose'           => $data->purpose,
                    'address'           => $data->address,
                    'pic'               => $url . $data->pic,
                );
            }
            // dd($data_array);
            return collect($data_array);
        } else {
            $url = 'https://visitor.globalsync.com.au/Visitor/';

            $companyName = Auth::user()->company_name;

            $export_data =  Visitor::select("created_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")->where('companyCode', Auth::user()->company_name)->get();

            // dd($export_data);

            $data_array[] = array(
                'DATE',
                'VISITOR ID',
                'NAME',
                'EMAIL',
                'PHONE',
                'HOST',
                'PURPOSE',
                'ADDRESS',
                'IMAGES'
            );

            foreach ($export_data as $data) {

                $data_array[] = array(
                    'created_at'        => $data->created_at,
                    'visitorID'         => $data->visitorID,
                    'name'              => $data->name,
                    'email'             => $data->email,
                    'phone'             => $data->phone,
                    'host'              => $data->host,
                    'purpose'           => $data->purpose,
                    'address'           => $data->address,
                    'pic'               => $url . $data->pic,
                );
            }
            // dd($data_array);
            return collect($data_array);
        }
    }
}
