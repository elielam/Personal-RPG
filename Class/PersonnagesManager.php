<?php

class PersonnagesManager {

	private $_db;

  	public function __construct ($db) {
  		$this->setDb($db);
  	}	

  	public function setDb (PDO $db) {
  		$this->_db = $db;
  	}

  	public function add (Personnage $perso) {
  		$q = $this->_db->prepare('INSERT INTO characters(name, life, armor, degat, type) VALUES(:name, :life, :armor, :degat, :type)');
	    $q->execute(array(
            ':name' => $perso->name(),
            ':life' => $perso->getLife(),
            ':armor' => $perso->getArmor(),
            ':degat' => $perso->getDegat(),
            ':type' => $perso->type(),
        ));
	    
	    $perso->hydrate([
	      'id' => $this->_db->lastInsertId(),
	    ]);
  	}

  	public function delete (Personnage $perso) {
  		$this->_db->exec('DELETE FROM characters WHERE id = '.$perso->id());
  	}

  	public function count () {
  		return $this->_db->query('SELECT COUNT(*) FROM characters')->fetchColumn();
  	}

  	public function exist ($info) {
  		if (is_int($info))
	    {
	      return (bool) $this->_db->query('SELECT COUNT(*) FROM characters WHERE id = '.$info)->fetchColumn();
	    }
	    
	    $q = $this->_db->prepare('SELECT COUNT(*) FROM characters WHERE name = :name');
	    $q->execute([':name' => $info]);
	    
    	return (bool) $q->fetchColumn();
  	}

  	public function get ($info) {
  		if (is_int($info)) {
          $q = $this->_db->query('SELECT id, name, type FROM characters WHERE id = '.$info);
          $donnees = $q->fetch(PDO::FETCH_ASSOC);

          return new $donnees["type"]($donnees);

	    } else {
	        $q = $this->_db->prepare('SELECT id, name, type, life, degat, armor FROM characters WHERE name = :name');
            $q->execute([':name' => $info]);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);

            $character = new $donnees["type"]($donnees);
            $character->setLife($donnees["life"]);
            $character->setDegat($donnees["degat"]);
            $character->setArmor($donnees["armor"]);

            return $character;

	    }

  	}

  	public function getList ($name) {
  		$persos = [];

	    $q = $this->_db->prepare('SELECT id, name, type, life, degat, armor FROM characters ORDER BY name');
	    $q->execute([':name' => $name]);

	    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	    {
	      if($donnees["name"] != $name) {
	        $persos[] = new $donnees["type"]($donnees);
          }
	    }
	
	    return $persos;

  	}

  	public function update (Personnage $perso) {
  		$q = $this->_db->prepare('UPDATE characters SET name, life, armor, degat = :name, :life, :armor, :degat WHERE id = :id');
    
	    $q->bindValue(':nom', $perso->name(), PDO::PARAM_INT);
	    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
	    $q->bindValue(':life', $perso->getLife(), PDO::PARAM_INT);
	    $q->bindValue(':armor', $perso->getArmor(), PDO::PARAM_INT);
	    $q->bindValue(':degat', $perso->getDegat(), PDO::PARAM_INT);

	    $q->execute();
  	}

}