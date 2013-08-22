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

        Org::create(array(
			'k' => 'name',
			'v'	=> 'Demo Sports League',
		));


        Org::create(array(
			'k' => 'slug',
			'v'	=> 'demo',
		));

        Org::create(array(
            'k' => 'theme',
            'v' => '',
        ));

        Org::create(array(
            'k' => 'website',
            'v' => 'http://demo.com',
        ));

		Org::create(array(
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
            'content'  => '<h1>Home</h1>'
        ));
    }

}

