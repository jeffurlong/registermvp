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
	}
}

class OrgTableSeeder extends Seeder {

    public function run()
    {
        DB::table('org')->delete();

        Organization::create(array(
			'k' => 'name',
			'v'	=> 'Demo Sports League',
		));


        Organization::create(array(
			'k' => 'slug',
			'v'	=> 'demo',
		));

        Organization::create(array(
            'k' => 'theme',
            'v' => '',
        ));

        Organization::create(array(
            'k' => 'website',
            'v' => 'http://demo.com',
        ));

		Organization::create(array(
			'k' => 'payment_processor',
			'v'	=> 'authnet',
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
			'email'	=> 'admin@demo.com',
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
			'username'	=> 'admin@demo.com',
			'password'	=> Hash::make('admindemo')
		));
    }

}

