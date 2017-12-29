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
                $reports = new SubdivisionReports();
                $title = 'по подразделению: ' . Subdivision::find($id)->name;
                break;
            case 'institution':
                $reports = new InstitutionReports();
                $title = 'по учреждению: ' . Institution::find($id)->name;
                break;
            case 'organ':
                $reports = new OrganReports();
                $title = 'по органу: ' . Organ::find($id)->name;
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
                    $title = 'Факт ' . $title;
                    break;
                case 'animals':
                    $data = $reports->getAnimals($id);
                    $view = 'reports.animals';
                    $title = 'Сведения о животных ' . $title;
                    break;
                case 'preparation_receipts':
                    $data = $reports->getPreparationReceipts($id);
                    $view = 'reports.preparation_receipts';
                    $title = 'Препараты ' . $title;
                    break;
                default:
                    //TODO: throw smth
                    break;
            }
        }
        
        return view($view, [
            'data' => $data,
            'title' => $title
        ]);
    }
}
