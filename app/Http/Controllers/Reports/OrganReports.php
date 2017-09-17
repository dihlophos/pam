<?
namespace App\Http\Controllers\Reports;

use Illuminate\Support\Facades\DB;

class OrganReports implements ReportsFactory
{
    public function getFact($id)
    {
        return DB::select('SELECT s.name AS service, atp.name AS animal_type, ax.name AS agesex, count(f.id) as `count` FROM facts as f
                    	LEFT JOIN services as s on f.service_id = s.id
                    	LEFT JOIN objects as o on f.object_id = o.id
                        LEFT JOIN animals as a on f.animal_id = a.id
                        LEFT JOIN agesexes as ax on a.agesex_id = ax.id
                        LEFT JOIN animal_types as atp on a.animal_type_id = atp.id
                    WHERE o.organ_id = ?
                    GROUP BY s.name, atp.name, ax.name
                    ORDER by s.name, atp.name, ax.name', [$id]);
    }

    public function getAnimals($id)
    {

    }

    public function getPreparationReceipts($id)
    {

    }
}
