<?

namespace App\Http\Controllers\Reports;

interface ReportsFactory
{
    public function getFact($id);
    public function getAnimals($id);
    public function getPreparationReceipts($id);
}
