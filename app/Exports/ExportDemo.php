<?php

namespace App\Exports;

use App\Models\Demo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class ExportDemo implements FromCollection
{
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

            $url = 'https://visitor.globalsyncteam.com/Demo/';

            $check = Demo::whereBetween('created_at', [$start_date, $end_date])->count();

            // dd($check);

            $export_data =  Demo::select("created_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")->whereBetween('created_at', [$start_date, $end_date])->get();

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
            $url = 'https://visitor.globalsyncteam.com/Demo/';

            $export_data =  Demo::select("created_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")->get();

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
