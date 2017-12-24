<?php

use Illuminate\Database\Seeder;
use App\States;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('states')->truncate();

      States::create(['name' => 'Alaska', 'code' => 'AK']);
      States::create(['name' => 'Alabama', 'code' => 'AL']);
      States::create(['name' => 'American Samoa', 'code' => 'AS']);
      States::create(['name' => 'Arizona', 'code' => 'AZ']);
      States::create(['name' => 'Arkansas', 'code' => 'AR']);
      States::create(['name' => 'California', 'code' => 'CA']);
      States::create(['name' => 'Colorado', 'code' => 'CO']);
      States::create(['name' => 'Connecticut', 'code' => 'CT']);
      States::create(['name' => 'Delaware', 'code' => 'DE']);
      States::create(['name' => 'District of Columbia', 'code' => 'DC']);
      States::create(['name' => 'Federated States of Micronesia', 'code' => 'FM']);
      States::create(['name' => 'Florida', 'code' => 'FL']);
      States::create(['name' => 'Georgia', 'code' => 'GA']);
      States::create(['name' => 'Guam', 'code' => 'GU']);
      States::create(['name' => 'Hawaii', 'code' => 'HI']);
      States::create(['name' => 'Idaho', 'code' => 'ID']);
      States::create(['name' => 'Illinois', 'code' => 'IL']);
      States::create(['name' => 'Indiana', 'code' => 'IN']);
      States::create(['name' => 'Iowa', 'code' => 'IA']);
      States::create(['name' => 'Kansas', 'code' => 'KS']);
      States::create(['name' => 'Kentucky', 'code' => 'KY']);
      States::create(['name' => 'Louisiana', 'code' => 'LA']);
      States::create(['name' => 'Maine', 'code' => 'ME']);
      States::create(['name' => 'Marshall Islands', 'code' => 'MH']);
      States::create(['name' => 'Maryland', 'code' => 'MD']);
      States::create(['name' => 'Massachusetts', 'code' => 'MA']);
      States::create(['name' => 'Michigan', 'code' => 'MI']);
      States::create(['name' => 'Minnesota', 'code' => 'MN']);
      States::create(['name' => 'Mississippi', 'code' => 'MS']);
      States::create(['name' => 'Missouri', 'code' => 'MO']);
      States::create(['name' => 'Montana', 'code' => 'MT']);
      States::create(['name' => 'Nebraska', 'code' => 'NE']);
      States::create(['name' => 'Nevada', 'code' => 'NV']);
      States::create(['name' => 'New Hampshire', 'code' => 'NH']);
      States::create(['name' => 'New Jersey', 'code' => 'NJ']);
      States::create(['name' => 'New Mexico', 'code' => 'NM']);
      States::create(['name' => 'New York', 'code' => 'NY']);
      States::create(['name' => 'North Carolina', 'code' => 'NC']);
      States::create(['name' => 'North Dakota', 'code' => 'ND']);
      States::create(['name' => 'Northern Mariana Islands', 'code' => 'MP']);
      States::create(['name' => 'Ohio', 'code' => 'OH']);
      States::create(['name' => 'Oklahoma', 'code' => 'OK']);
      States::create(['name' => 'Oregon', 'code' => 'OR']);
      States::create(['name' => 'Palau', 'code' => 'PW']);
      States::create(['name' => 'Pennsylvania', 'code' => 'PA']);
      States::create(['name' => 'Puerto Rico', 'code' => 'PR']);
      States::create(['name' => 'Rhode Island', 'code' => 'RI']);
      States::create(['name' => 'South Carolina', 'code' => 'SC']);
      States::create(['name' => 'South Dakota', 'code' => 'SD']);
      States::create(['name' => 'Tennessee', 'code' => 'TN']);
      States::create(['name' => 'Texas', 'code' => 'TX']);
      States::create(['name' => 'Utah', 'code' => 'UT']);
      States::create(['name' => 'Vermont', 'code' => 'VT']);
      States::create(['name' => 'Virgin Islands', 'code' => 'VI']);
      States::create(['name' => 'Virginia', 'code' => 'VA']);
      States::create(['name' => 'Washington', 'code' => 'WA']);
      States::create(['name' => 'West Virginia', 'code' => 'WV']);
      States::create(['name' => 'Wisconsin', 'code' => 'WI']);
      States::create(['name' => 'Wyoming', 'code' => 'WY']);
      States::create(['name' => 'Armed Forces Africa', 'code' => 'AE']);
      States::create(['name' => 'Armed Forces Americas (except Canada)', 'code' => 'AA']);
      States::create(['name' => 'Armed Forces Canada', 'code' => 'AE']);
      States::create(['name' => 'Armed Forces Europe', 'code' => 'AE']);
      States::create(['name' => 'Armed Forces Middle East', 'code' => 'AE']);
      States::create(['name' => 'Armed Forces Pacific', 'code' => 'AP']);
    }
}
