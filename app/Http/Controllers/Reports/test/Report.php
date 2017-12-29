<?

namespace App\Http\Controllers\Reports;

interface Report
{
	public function getFact();
	public function getAnimals();
	public function getPreparationReceipts();
}
