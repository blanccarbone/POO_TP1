<?php 
	/**
	* 
	*/
	class PersonnageManager
	{
		
		privade $_db;

		public function __construct($db)
		{
			$this->setDb($db);
		}



		public function add(Personnage $perso)
		{
			// Preparation de la requète d'insertion
			$q = $this->_db->prepare('INSERT INTO personnages SET nom = :nom')
			// Assignation des valeurs
			$q->bindValue(':nom', $perso->nom());
			// Execution de la requète
			$q->execute();

			// Hydratation de l'objet
			$perso->hydrate([
					'id'=>$this=>$_db->lastInsertId(),
					'degats'=> 0
				])
		}



		public function count()
		{
			return $this->_db->query('SELECT COUNT(*) FROM personnages')->fetchColumn();
		}



		public function delete($perso)
		{
			$this->_db->exec('DELETE FROM personnages WHERE id = '$perso->id());
		}



		public function exists($info)
		{
			// Si le paramètre est un entier c'est qu'on à fourni un identifiant
				// On execute alors une requete COUNT() avec une clause WHERE est on retourne un booleen
			if (is_int($info)) {
				return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id ='. $info)
			}

			// Sinon ce qu'on à passé un est nom 
				// On execute alors une requete COUNT() avec une clause WHERE est on retourne un booleen
			$q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
			$q->execute([':nom'=>$info]);

			return (bool) $q->fetchColumn();
		}




		public function get($info)
		{
			// Si le paramètre est un entier, on veut récupérer le personnage avec son identifiant.
  				// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
			if (is_int($info)) {
				$this->_db->query('SELECT id, nom, degats FROM personnages WHERE id =' $info);
				$donnees = $q->fetch(PDO::FETCH_ASSOC);
				return new Personnage($donnees);
			}
			else
			{

			    // Sinon, on veut récupérer le personnage avec son nom.
			    	// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
			 	
				
			}
		}



		public function getList($nom)
		{
		    // Retourne la liste des personnages dont le nom n'est pas $nom.
    			// Le résultat sera un tableau d'instances de Personnage.
		}



	  	public function update(Personnage $perso)
		{
			// Prépare une requête de type UPDATE.
			// Assignation des valeurs à la requête.
			// Exécution de la requête.
		}



		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
	}
 ?>