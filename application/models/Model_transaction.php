<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Model_transaction extends CI_Model
{
	public $table         = 'transactions';
	public $column_order  = ['transactions.transaction_id'];
	public $column_search = ['transactions.product_name'];
	public $order         = ['transactions.transaction_id' => 'DESC'];

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] !== -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();

			return $query->result();
		}
	}

	public function create_order($data)
	{
		return $this->db->insert($this->table, $data);
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->join('products', 'products.product_id = transactions.product_id');
		$this->db->join('users', 'users.user_id = transactions.created_by');
		$i = 0;

		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 === $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} elseif (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);

		return $this->db->count_all_results();
	}

	public function get_data_laba()
	{
		$this->_get_data_laba_query();
		if ($_POST['length'] !== -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();

			return $query->result();
		}
	}

	private function _get_data_laba_query()
	{
		$this->db->from($this->table);
		$this->db->join('barang', 'barang.id = penjualan.kode_barang');
		$i = 0;

		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 === $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} elseif (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function sum_daily()
	{
		$query = $this->db->query('select sum(price) as total from transactions where day(created_at)=' . date('d') . '');

		return $query->row()->total;
	}

	public function sum_monthly()
	{
		$query = $this->db->query('select sum(price) as total from transactions where month(created_at)=' . date('m') . '');

		return $query->row()->total;
	}
}
