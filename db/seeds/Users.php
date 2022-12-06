<?php


use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
  /**
   * Run Method.
   *
   * Write your database seeder using this method.
   *
   * More information on writing seeders is available here:
   * https://book.cakephp.org/phinx/0/en/seeding.html
   */
  public function run()
  {
    $data = array(
      array(
        'user_name' => 'Kasir',
        'email' => 'ahmadmaha@email.com',
        'address' => 'malang',
        'is_active' => true,
        'role' => 'admin',
        'password' => password_hash('ahmadmaha', PASSWORD_DEFAULT)
      ),
      array(
        'user_name' => 'seller',
        'email' => 'seller@email.com',
        'address' => 'malang',
        'is_active' => true,
        'role' => 'seller',
        'password' => password_hash("ahmadmaha", PASSWORD_BCRYPT)
      ),
      array(
        'user_name' => 'user seller',
        'email' => 'userseller@gmail.com',
        'address' => 'malang',
        'is_active' => true,
        'role' => 'seller',
        'password' => password_hash("ahmadmaha", PASSWORD_BCRYPT)
      ),
    );

    $user = $this->table('users');
    $user->insert($data)->save();
  }
}
