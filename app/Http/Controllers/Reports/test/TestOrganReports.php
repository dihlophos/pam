<?
namespace App\Http\Controllers\Reports;

use Illuminate\Support\Facades\DB;

class TestOrganReports implements ReportsFactory
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
        return DB::select('SELECT atp.name AS animal_type, ax.name AS agesex, SUM(a.count) AS `count` FROM animals AS a
                                LEFT JOIN objects AS o on a.object_id = o.id
                            	LEFT JOIN animal_types AS atp on a.animal_type_id = atp.id
                                LEFT JOIN agesexes AS ax on a.agesex_id = ax.id
                            WHERE o.organ_id = ?
                            GROUP BY atp.name, ax.name
                            ORDER BY atp.name, ax.name', [$id]);
    }

    public function getPreparationReceipts($id)
    {
        return DB::select('SELECT p.name AS preparation, SUM(pr.count_containers) AS count_containers FROM preparation_receipts AS pr
                            	LEFT JOIN subdivisions AS sd ON pr.subdivision_id = sd.id
                                LEFT JOIN institutions AS i ON sd.institution_id = i.id
                                LEFT JOIN preparations as p ON pr.preparation_id = p.id
                            WHERE i.organ_id = ?
                            GROUP BY p.name
                            ORDER BY p.name', [$id]);
    }
}
