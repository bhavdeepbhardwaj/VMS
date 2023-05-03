<?php

namespace App\Exports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class ExportVisitor implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

     protected $companyCode, $startDate, $endDate;

    public function __construct(String $companyCode, String $startDate, String $endDate) {

        $this->companyCode = $companyCode;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


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
        // dd("123",$this->companyCode);
        $url = 'https://visitor.globalsyncteam.com/Visitor/';
        // if($this->companyCode != 'all'){
            $start_date = $this->startDate;
            $end_date = $this->endDate;
            $company_code = $this->companyCode;
            $export_data = Visitor::where('is_deleted', '0')
            ->where(function($query) use ($company_code){
                if($this->companyCode != 'all'){
                $query->where('companyCode', $this->companyCode);
                }
            })
                    ->where(function ($query) use ($start_date, $end_date) {
                        if ($this->startDate != '' && $this->endDate != '') {
                            $from = date($this->startDate);
                            $to = date($this->endDate);
                            $query->whereDate('created_at', '>=', $from);
                            $query->whereDate('created_at', '<=', $to);
                            // whereBetween('created_at', [$from, $to])
                            //    dd($guest);

                        } else if ($this->startDate != '' && $this->endDate == '') {
                            $from = date($this->startDate);
                            $to = date($this->startDate);
                            $query->whereDate('created_at', '>=', $from);
                            $query->whereDate('created_at', '<=', $to);
                            // $query->whereBetween('created_at', [$from, $to])
                        }
                    })
                    ->orderBy('created_at', 'DESC')->get();
                    // dd($guest);

                    // dd($export_data);

        // }else{
            // $export_data =  Visitor::select("created_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")->get();
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
                // dd($data);
                // dd(date('d-m-Y', strtotime($data->created_at)));

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
