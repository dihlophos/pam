<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;
use App\Models\Subdivision;
use App\Models\Institution;
use App\Models\Organ;

class ReportsController extends Controller
{
    public function index($model, $id, $report)
    {
        $reports = null;
        $title = '';
        switch ($model) {
            case 'subdivision':
                $reports = new SubdivisionReports($id, $report);
                break;
            case 'institution':
                $reports = new InstitutionReports($id, $report);
                break;
            case 'organ':
                $reports = new OrganReports($id, $report);
                break;
            default:
                throw new ModelNotFoundException();
                break;
        }

        return view($reports->view, [
            'data' => $reports->getData(),
            'title' => $reports->title
        ]);
    }
}
