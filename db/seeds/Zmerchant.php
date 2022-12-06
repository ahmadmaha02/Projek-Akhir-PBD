<?php


use Phinx\Seed\AbstractSeed;

class Zmerchant extends AbstractSeed
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
        'merchant_name' => 'UB MArt',
        'merchant_telephone' => '08222222',
        'merchant_address' => 'Malng',
        'merchant_description' => 'UMKM yang difasilitasi oleh universitas brawijaya.',
        'created_by' => 1,
      ),
    );

    $merchant = $this->table('merchants');
    $merchant->insert($data)->save();
  }
}
