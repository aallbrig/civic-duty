<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->command->info('User table seeded!');
		$this->call('ActivitiesTableSeeder');
		$this->command->info('Activities table seeded!');
		$this->call('UsersActivitesSeeder');
		$this->command->info('Users_Activities table seeded!');
	}

}
class UsersTableSeeder extends Seeder {
 
  public function run()
  {
  	DB::table('users')->delete();
  	$faker = Faker\Factory::create();
  	for ($i = 0; $i < 10; $i++){
  	  echo("user: $i\n");
	  $user = User::create([
	    'username' => 'test'.$i,
	    'password' => Hash::make('test'),
	    'zip' => $faker->randomNumber(46001,47997),
	    'points' => 0,
	    'morality' => 0,
	    'reputation' => 0,
      'flavorText' => $faker->text(50),
      'img' => 'imgs/' . $faker->randomNumber(0, 9) . '.png'
	  ]);
	}
  }
 
}
class ActivitiesTableSeeder extends Seeder {
 
  public function run()
  {
  	DB::table('activities')->delete();
  	$faker = Faker\Factory::create();
  	for ($i = 0; $i < 100; $i++){
  	  echo("activity: $i\n");
	  $activity = Activity::create([
	  	'points'=>$faker->randomNumber(0, 5),
	  	'morality'=>$faker->randomNumber(-15,15),
	  	'title'=> $faker->sentence(5),
	  	'description'=> $faker->text(200)
	  ]);
	  // User::find(1)->activities()->attach($activity->id);
	}
  }
 
}
class UsersActivitesSeeder extends Seeder {
 
  public function run()
  {
  	DB::table('users_activities')->delete();
  	$faker = Faker\Factory::create();
  	$user = User::find(1);
  	// $user->activities()->sync([1,2,3,4,5]);
  	foreach (Activity::all() as $activity) {
  		# code...
  		echo("$activity->points");
  		$user->activities()->attach($activity->id);
  		$user->points += $activity->points;
  		$user->morality += $activity->morality;
      $user->reputation += 1;
  		$user->save();
  	}
  	// for ($i=0; $i < 10; $i++) { 
  	// 	// $
  	// 	// $user = User::find(1)->activities()->save(Activity::find($i));
  	// }
  }
 
}