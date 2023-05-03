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
            'CHECK IN',
            'CHECK OUT',
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


            $export_data = Visitor::select("created_at", "updated_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")
            // ->whereBetween('created_at', [$start_date, $end_date])
            ->where('companyCode', Auth::user()->company_name)
            ->where('is_deleted', '0')
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->orderby('created_at')
            ->get();


            // dd($export_data, empty($export_data),count($export_data));
            // if(count($export_data) == 0) {
            //     dd("No Data Found !");
            // }

            $data_array[] = array(
                'DATE',
                'CHECK IN',
                'CHECK OUT',
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
                    'created_at'        => date('d-m-Y', strtotime($data->created_at)),
                    'checkIN'           => date('h:i:s A', strtotime($data->created_at)),
                    'CheckOut'          => date('h:i:s A', strtotime($data->updated_at)),
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

            $export_data =  Visitor::select("created_at", "updated_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")->where('companyCode', Auth::user()->company_name)->where('is_deleted', '0')->get();

            // dd($export_data);
            // if(count($export_data) == 0) {
            //     dd("No Data Found !");
            // }

            $data_array[] = array(
                'DATE',
                'CHECK IN',
                'CHECK OUT',
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
                    'created_at'        => date('d-m-Y', strtotime($data->created_at)),
                    'checkIN'           => date('h:i:s A', strtotime($data->created_at)),
                    'CheckOut'          => date('h:i:s A', strtotime($data->updated_at)),
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
