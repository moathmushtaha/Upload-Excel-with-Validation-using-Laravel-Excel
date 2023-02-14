<?php

namespace App\Imports;

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class TicketsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    public static array $excel_ips;
    protected mixed $port_protocol;
    protected mixed $nvt_name;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ticket([
            'ip_address' => $row['ip'],
            'hostname' => $row['hostname'],
            'port' => $row['port'],
            'port_protocol' => $row['port_protocol'],
            'cvss' => $row['cvss'],
            'severity' => $row['severity'],
            'nvt_name' => $row['nvt_name'],
            'summary' => $row['summary'],
            'cves' => $row['cves'],
            'solution' => $row['solution'],
            'remarks' => null,
            'status' => 1,
            'date_discovered' => $row['timestamp'],
            'user_id' => 1,
        ]);
    }


    public function rules(): array
    {
        return [
            'ip' => function ($attribute, $value, $onFailure) {
                $is_exists = DB::table('tickets');
                $is_exists = $is_exists->where('ip_address', $value);

                if ($this->port_protocol) {
                    $is_exists = $is_exists->where('port_protocol', $this->port_protocol);
                }

                if ($this->nvt_name) {
                    $is_exists = $is_exists->where('nvt_name', $this->nvt_name);
                }

                $is_exists = $is_exists->whereIn('status', [1, 2, 3])->exists();

                self::$excel_ips [] = $value;

                if ($is_exists) {
                    $onFailure('IP Address already exists.');
                }
            },
        ];
    }

    public function prepareForValidation($data)
    {
        $data['timestamp'] = Carbon::parse($data['timestamp'])->toDateTimeString();

        $this->port_protocol = $data['port_protocol'];
        $this->nvt_name = $data['nvt_name'];

        return $data;
    }

    public function onFailure(Failure ...$failures)
    {
        //skip
    }
}
