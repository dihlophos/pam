<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;
use App\Models\Subdivision;

class ReportsController extends Controller
{
    public function index($model, $id, $report)
    {
        $reports = null;
        $title = '';
        switch ($model) {
            case 'subdivision':
                $reports = new SubdivisionReports();
                $title = Subdivision::find($id)->name;
                break;
            case 'institution':
                //TODO:
                break;
            case 'organ':
                //TODO:
                break;
            default:
                throw new ModelNotFoundException();
                break;
        }

        if ($reports) {
            switch ($report) {
                case 'fact':
                    $data = $reports->getFact($id);
                    $view = 'reports.fact';
                    $title =  'Факт по подразделению: '.$title;
                    break;
                default:
                    # code...
                    break;
            }
        }

        return view($view, [
            'data' => $data,
            'title' => $title
        ]);
    }
}
