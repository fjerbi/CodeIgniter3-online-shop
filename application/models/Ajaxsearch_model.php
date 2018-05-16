<?php
class Ajaxsearch_model extends CI_Model
{
	function fetch_data($query)
	{
		$this->db->select("*");
		$this->db->from("produits");
		if($query != '')
		{
			$this->db->like('nom_produit', $query);
			$this->db->or_like('quantite_produit', $query);
			$this->db->or_like('status', $query);
			$this->db->or_like('prix_produit', $query);
			$this->db->or_like('ancien_prix', $query);
		}
		$this->db->order_by('id', 'DESC');
		return $this->db->get();
	}
}
?>