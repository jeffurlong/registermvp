<?php
// use Illuminate\Hashing\BcryptHasher;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('OrgTableSeeder');
		$this->call('PersonTableSeeder');
		$this->call('UserTableSeeder');
        $this->call('PageTableSeeder');
	}
}

class OrgTableSeeder extends Seeder {

    public function run()
    {
        DB::table('org')->delete();

        DB::table('org')->insert(array(
			'k' => 'name',
			'v'	=> 'Demo Sports League',
		));

        DB::table('org')->insert(array(
			'k' => 'slug',
			'v'	=> 'demo',
		));

        DB::table('org')->insert(array(
            'k' => 'theme',
            'v' => '',
        ));

		DB::table('org')->insert(array(
			'k' => 'payment_processor',
			'v'	=> 'authnet',
		));

        DB::table('org')->insert(array(
            'k' => 'authnet_api_login',
            'v' => 'FAKE',
        ));

        DB::table('org')->insert(array(
            'k' => 'authnet_transaction_key',
            'v' => 'FAKE',
        ));

        DB::table('org')->insert(array(
            'k' => 'email',
            'v' => 'fakeee@faker.com',
        ));

        DB::table('org')->insert(array(
            'k' => 'phone',
            'v' => '555-555-5555',
        ));

        DB::table('org')->insert(array(
            'k' => 'street',
            'v' => '',
        ));

        DB::table('org')->insert(array(
            'k' => 'city',
            'v' => '',
        ));

        DB::table('org')->insert(array(
            'k' => 'state',
            'v' => '',
        ));

        DB::table('org')->insert(array(
            'k' => 'zip',
            'v' => '',
        ));
    }

}

class PersonTableSeeder extends Seeder {

    public function run()
    {
        DB::table('people')->delete();

        Person::create(array(
			'id' 		=> 1,
			'master_id'	=> 1,
			'first_name' => 'Demo',
			'last_name'	=> 'Admin',
			'email'	=> 'jef@mvpreg.com',
			'phone' => '555-555-5555',
			'gender' => 'M'
		));
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
			'id' 		=> 1,
			'person_id'	=> 1,
			'role_id'	=> 60,
			'username'	=> 'jef@mvpreg.com',
			'password'	=> Hash::make('admindemo')
		));
    }

}

class PageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->delete();

        Page::create(array(
            'id'        => 1,
            'name'  => 'home',
            'content'  => '<h1>Home</h1>This is the home page!',
            'slug' =>'home',
            'description' => 'Home Page  This is the home page. Isn\'t it lovely?...',
            'visible' => '1',
        ));
    }

}

