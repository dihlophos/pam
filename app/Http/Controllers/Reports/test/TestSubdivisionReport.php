<?

namespace App\Http\Controllers\Reports;

use App\Models\Subdivision;
use Illuminate\Support\Facades\DB;

class TestSubdivisionReport implements Report
{
	private $id;
	public $title;
	public $view;
	public function __construct($id, $report) {
		$this->id = $id;
		$this->title = 'по подразделению: ' . Subdivision::find($id)->name;

		if ($reports) {
            switch ($report) {
                case 'fact':
                    $this->title = 'Факт ' . $this->title;
					$this->view = 'reports.fact';
                    break;
                case 'animals':
                    $this->title = 'Сведения о животных ' . $this->title;
					$this->view = 'reports.animals';
                    break;
                case 'preparation_receipts':
                    $this->title = 'Препараты ' . $this->title;
					$this->view = 'reports.preparation_receipts';
                    break;
                default:
                    //TODO: throw smth
                    break;
            }
        }
	}

	public function getData()
	{
		if ($reports) {
            switch ($report) {
                case 'fact':
                    return getFact();
                    break;
                case 'animals':
                    return getAnimals();
                    break;
                case 'preparation_receipts':
                    return getPreparationReceipts();
                    break;
                default:
                    return false;
                    break;
            }
        }
	}

	private function getFact()
	{
		return DB::select('SELECT s.name AS service, atp.name AS animal_type, ax.name AS agesex, count(f.id) as `count` FROM facts as f
                            	LEFT JOIN services as s on f.service_id = s.id
                            	LEFT JOIN objects as o on f.object_id = o.id
                                LEFT JOIN animals as a on f.animal_id = a.id
                                LEFT JOIN agesexes as ax on a.agesex_id = ax.id
                                LEFT JOIN animal_types as atp on a.animal_type_id = atp.id
                            WHERE o.subdivision_id = ?
                            GROUP BY s.name, atp.name, ax.name
                            ORDER by s.name, atp.name, ax.name', [$this->id]);
	}

	private function getAnimals()
	{
        return DB::select('SELECT atp.name AS animal_type, ax.name AS agesex, SUM(a.count) AS `count` FROM animals AS a
                                LEFT JOIN objects AS o on a.object_id = o.id
                            	LEFT JOIN animal_types AS atp on a.animal_type_id = atp.id
                                LEFT JOIN agesexes AS ax on a.agesex_id = ax.id
                            WHERE o.subdivision_id = ?
                            GROUP BY atp.name, ax.name
                            ORDER BY atp.name, ax.name', [$this->$id]);
    }

	private function getPreparationReceipts()
	{
        return DB::select('SELECT p.name AS preparation, SUM(pr.count_containers) AS count_containers FROM preparation_receipts AS pr
                                LEFT JOIN preparations as p ON pr.preparation_id = p.id
                            WHERE pr.subdivision_id = ?
                            GROUP BY p.name
                            ORDER BY p.name', [$this->$id]);
    }
}
