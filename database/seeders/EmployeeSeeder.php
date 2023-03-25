<?php
 
 namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Arr;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plantilla_employees = [
            [ 'employee_name' => 'Alcala, John Philip', 'employee_id' => '064' ],
            [ 'employee_name' => 'Arceo, Allyson Lorraine', 'employee_id' => '103' ],
            [ 'employee_name' => 'Austria, Melody Grace', 'employee_id' => '082' ],
            [ 'employee_name' => 'Balisi, Anthony John', 'employee_id' => '044' ],
            [ 'employee_name' => 'Balladares, Mitchelle', 'employee_id' => '089' ],
            [ 'employee_name' => 'Beringuela, Jodell', 'employee_id' => '039' ],
            [ 'employee_name' => 'Bermudes, Gemma', 'employee_id' => '006' ],
            [ 'employee_name' => 'Bober, Edcel', 'employee_id' => '078' ],
            [ 'employee_name' => 'Bober, Eguille', 'employee_id' => '104' ],
            [ 'employee_name' => 'Calisin-Baste, Cristelyn', 'employee_id' => '111' ],
            [ 'employee_name' => 'Campollo, Julie Ann', 'employee_id' => '070' ],
            [ 'employee_name' => 'Capuchino, Charmaine Concepcion', 'employee_id' => '063' ],
            [ 'employee_name' => 'Celis, Anthonete', 'employee_id' => '105' ],
            [ 'employee_name' => 'Dacumos, Maria Beatrice', 'employee_id' => '106' ],
            [ 'employee_name' => 'De Paz, Juzeal', 'employee_id' => '102' ],
            [ 'employee_name' => 'Dean, Kathrine', 'employee_id' => '057' ],
            [ 'employee_name' => 'Dearos, Maria Sofia Ysabel', 'employee_id' => '090' ],
            [ 'employee_name' => 'Dela Cruz, Rodel', 'employee_id' => '009' ],
            [ 'employee_name' => 'Dy, Kevin Ansel', 'employee_id' => '081' ],
            [ 'employee_name' => 'Escobar, Carlos Miguel', 'employee_id' => '084' ],
            [ 'employee_name' => 'Esteban, Ryan', 'employee_id' => '027' ],
            [ 'employee_name' => 'Fabula, Jane Blessilda', 'employee_id' => '112' ],
            [ 'employee_name' => 'Ferrer, Dennisse Abigail', 'employee_id' => '092' ],
            [ 'employee_name' => 'Garcia, Jayvee', 'employee_id' => '099' ],
            [ 'employee_name' => 'Gomez, Marie Grace', 'employee_id' => '087' ],
            [ 'employee_name' => 'Ilagan, Kim Edward', 'employee_id' => '072' ],
            [ 'employee_name' => 'Isuga, Jozell', 'employee_id' => '110' ],
            [ 'employee_name' => 'Magdael, Lorna', 'employee_id' => '012' ],
            [ 'employee_name' => 'Magtulis, Rencie', 'employee_id' => '041' ],
            [ 'employee_name' => 'Maguddayao, Abigail', 'employee_id' => '054' ],
            [ 'employee_name' => 'Manalese, Lara Maika', 'employee_id' => '058' ],
            [ 'employee_name' => 'Manglal-lan, Lyka', 'employee_id' => '108' ],
            [ 'employee_name' => 'Mariano, Daniel', 'employee_id' => '094' ],
            [ 'employee_name' => 'Matula, Andy', 'employee_id' => '109' ],
            [ 'employee_name' => 'Medija, Ricky', 'employee_id' => '066' ],
            [ 'employee_name' => 'Murillo, Alda Mae', 'employee_id' => '031' ],
            [ 'employee_name' => 'Narra, Dean Alfred', 'employee_id' => '096' ],
            [ 'employee_name' => 'Nicodemus, Virgie', 'employee_id' => '085' ],
            [ 'employee_name' => 'Ocampo, Mark Bryan', 'employee_id' => '074' ],
            [ 'employee_name' => 'Orda, Catherine', 'employee_id' => '097' ],
            [ 'employee_name' => 'Pangan, Maria Christina', 'employee_id' => '079' ],
            [ 'employee_name' => 'Pino, Nikkie Boie', 'employee_id' => '098' ],
            [ 'employee_name' => 'Pobre, Addie Eleanor', 'employee_id' => '086' ],
            [ 'employee_name' => 'Prochina, Dennis', 'employee_id' => '068' ],
            [ 'employee_name' => 'Quinto, Rita', 'employee_id' => '014' ],
            [ 'employee_name' => 'Ramirez, Yuri Rio', 'employee_id' => '107' ],
            [ 'employee_name' => 'Ramos, Jayson', 'employee_id' => '036' ],
            [ 'employee_name' => 'Salgado, Grant', 'employee_id' => '075' ],
            [ 'employee_name' => 'Sembrano, Maricon', 'employee_id' => '077' ],
            [ 'employee_name' => 'Sia, Arvin', 'employee_id' => '083' ],
            [ 'employee_name' => 'Solano, John Patrick', 'employee_id' => '113' ],
            [ 'employee_name' => 'Tabinas, Jason', 'employee_id' => '034' ],
            [ 'employee_name' => 'Tapia, Maria Carolina', 'employee_id' => '053' ],
            [ 'employee_name' => 'Tomonong, Celedonio', 'employee_id' => '017' ],
            [ 'employee_name' => 'Tugade, Charisse', 'employee_id' => '002' ],
            [ 'employee_name' => 'Ybañez, Jennylyn', 'employee_id' => '093' ]
        ];

        $jo_employees = [
            [ 'employee_name' => 'Añasco, Miles Justin', 'employee_id' => 'JO ID No. 22-031' ],
            [ 'employee_name' => 'Andres, Cathlene', 'employee_id' => 'JO ID No. 22-035' ],
            [ 'employee_name' => 'Calusa, Julie Anne', 'employee_id' => 'JO ID No. 22-049' ],
            [ 'employee_name' => 'Caro, Pia Lorraine', 'employee_id' => 'JO ID No. 22-047' ],
            [ 'employee_name' => 'Cruz, Asher Grace', 'employee_id' => 'JO ID No. 22-039' ],
            [ 'employee_name' => 'Marquez, Mark Noesis', 'employee_id' => 'JO ID No. 22-045' ],
            [ 'employee_name' => 'Micua, Florelyn', 'employee_id' => 'JO ID No. 22-050' ],
            [ 'employee_name' => 'Nazareth, Mark', 'employee_id' => 'JO ID No. 22-032' ],
            [ 'employee_name' => 'Nicodemus, Nico', 'employee_id' => 'JO ID No. 22-051' ],
            [ 'employee_name' => 'Pulido, Ruthcel', 'employee_id' => 'JO ID No. 22-030' ],
            [ 'employee_name' => 'Reyes, Rommel', 'employee_id' => 'JO ID No. 22-040' ],
            [ 'employee_name' => 'Rosero, Reginald', 'employee_id' => 'JO ID No. 22-043' ],
            [ 'employee_name' => 'Santiago, Aileen', 'employee_id' => 'JO ID No. 22-033' ],
            [ 'employee_name' => 'Tobes, Lionell', 'employee_id' => 'JO ID No. 22-046' ],
            [ 'employee_name' => 'Tomas, Elyss Jennai', 'employee_id' => 'JO ID No. 22-048' ],
            [ 'employee_name' => 'Uka, Camille', 'employee_id' => 'JO ID No. 22-034' ]
        ];

        foreach ($plantilla_employees as $plantilla_employee) {
            list($last_name, $first_name) = explode(",", $plantilla_employee['employee_name']);
            Employee::create([
                'employee_id' => ltrim($plantilla_employee['employee_id'], '0'),
                'first_name' => $first_name,
                'middle_name' => null,
                'last_name' => $last_name,
                'email' => fake()->unique()->safeEmail(),
                'division' => Arr::random([ 'BTTD', 'PRED', 'AFSD', 'CITD' ]),
                'date_hired' => now(),
                'date_separated' => null,
                'personnel_type' => 'Plantilla',
                'is_active' => 1
            ]);
        }

        foreach ($jo_employees as $jo_employee) {
            list($last_name_jo, $first_name_jo) = explode(",", $jo_employee['employee_name']);
            $employee_id_jo = ltrim( str_ireplace("-", "", str_ireplace("JO ID No. ","", $jo_employee['employee_id'])), '0');
            Employee::create([
                'employee_id' => $employee_id_jo,
                'first_name' => $first_name_jo,
                'middle_name' => null,
                'last_name' => $last_name_jo,
                'email' => fake()->unique()->safeEmail(),
                'division' => Arr::random([ 'BTTD', 'PRED', 'AFSD', 'CITD' ]),
                'date_hired' => now(),
                'date_separated' => null,
                'personnel_type' => 'COS/JO',
                'is_active' => 1
            ]);
        }
    }
}
