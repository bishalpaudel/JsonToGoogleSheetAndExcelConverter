<?php

namespace App\Http\Controllers;

use GoogleSheets\Facades\Sheets;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Maatwebsite\Excel\Facades\Excel;
use PulkitJalan\Google\Facades\Google;

class JsonConverterController extends BaseController
{
    use ValidatesRequests;

    public function toCsv(Request $request){

        $result = $this->formatPersonJSONToArray($request->all());

        Excel::create('PersonRecord', function($excel) use($result) {
            $excel->sheet('Sheet1', function($sheet) use($result) {
                $sheet->fromArray($result, null, 'A1', true, false);
            });
        })->store("csv");

        return response()->json([],201);
    }


    public function saveToGoogleSheets(Request $request){

        $this->initializeSheet();

        $result = $this->formatPersonJSONToArray($request->all());

        Sheets::sheet('Sheet1')->update($result);

        return response()->json([],201);
    }


    private function formatPersonJSONToArray(array $input): array{
        $output = [];
        $keys = [];

        foreach($input as $person=>$actions){
            if(is_array($actions)){
                foreach ($actions as $action){
                    $output[$person][$action] = 1;
                    $keys[$action] = 0;
                }
            }
        }

        return $this->convertToSheetArray($keys, $output);
    }


    private function initializeSheet()
    {
        Sheets::setService(Google::make('sheets'));
        Sheets::spreadsheet(env("GOOGLE_SHEET_ID"));
    }

    /**
     * @param $keys
     * @param $output
     * @return array
     */
    private function convertToSheetArray(array $keys, array $output): array
    {
        $rows = [];
        $key = 0;
        $rows[$key] = array_keys($keys);
        array_unshift($rows[$key], "");
        $key++;
        foreach ($output as $person_type => $actions) {
            if (is_array($actions)) {
                $rows[$key] = array_values(array_merge($keys, $actions));
                array_unshift($rows[$key], $person_type);
                $key++;
            }
        }
        return $rows;
    }
}
