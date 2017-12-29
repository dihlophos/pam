<?
namespace App\Http\Controllers\Reports;


class SubdivisionReports implements ReportsCreator
{
    private $id;
    private $report;
    public function __construct($id, $report) 
    {
        $this->id = $id;
        $this->report = $report;
    }
    
    public function GetReport()
    {
        return new SubdivisionReport($this->id, $this->report);
    }
}
