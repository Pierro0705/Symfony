DROP DATABASE IF EXISTS locaimmo;

CREATE DATABASE IF NOT EXISTS locaimmo;
USE locaimmo;
# -----------------------------------------------------------------------------
#       TABLE : TYPEBIEN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typeBien
 (
   codeTypeBien INTEGER(5) NOT NULL auto_increment  ,
   libelle VARCHAR(255) NULL  
   , PRIMARY KEY (codeTypeBien) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PAYS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS pays
 (
   idPays INTEGER(5) NOT NULL auto_increment ,
   nomPays VARCHAR(255) NULL  
   , PRIMARY KEY (IDPAYS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : BIEN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS bien
 (
   idBien INTEGER(5) NOT NULL auto_increment ,
   idVille INTEGER(5) NOT NULL  ,
   codeTypeBien INTEGER(5) NOT NULL  ,
   idProprietaire INTEGER(5) NOT NULL  ,
   adresseBien VARCHAR(255) NULL  ,
   superficieBien INTEGER(4) NULL  ,
   nbPlaces INTEGER(2) NULL  
   , PRIMARY KEY (idBien) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PROPRIETAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS proprietaire
 (
   idProprietaire INTEGER(5) NOT NULL auto_increment ,
   codeTypeProprietaire INTEGER(5) NOT NULL  ,
   nomProprietaire VARCHAR(255) NULL  ,
   prenomProprietaire VARCHAR(255) NULL  ,
   mailProprietaire VARCHAR(255) NULL  ,
   mdpProprietaire VARCHAR(255) NULL  
   , PRIMARY KEY (idProprietaire) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : VILLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ville
 (
   idVille INTEGER(5) NOT NULL auto_increment ,
   idPays INTEGER(5) NOT NULL  ,
   nomVille VARCHAR(255) NULL  ,
   codePostal VARCHAR(32) NULL  
   , PRIMARY KEY (idVille) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS client
 (
   id INTEGER(5) NOT NULL auto_increment ,
   nom VARCHAR(255) NULL  ,
   prenom VARCHAR(255) NULL  ,
   mail VARCHAR(255) NULL  ,
   mdp VARCHAR(255) NULL  
   , PRIMARY KEY (id) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : TYPEPROPRIETAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typeProprietaire
 (
   codeTypeProprietaire INTEGER(5) NOT NULL auto_increment ,
   libelle VARCHAR(255) NULL  
   , PRIMARY KEY (codeTypeProprietaire) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LOUER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS louer
 (
   idBien INTEGER(5) NOT NULL  ,
   id INTEGER(5) NOT NULL  ,
   dateArrivee VARCHAR(32) NULL  ,
   dateDepart VARCHAR(32) NULL  ,
   PRIX INTEGER(5) NULL  
   , PRIMARY KEY (idBien,id) 
 ) 
 comment = "";


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE bien 
  ADD FOREIGN KEY fk_bien_ville (idVille)
      REFERENCES ville (idVille) ;


ALTER TABLE bien 
  ADD FOREIGN KEY fk_bien_typeBien (codeTypeBien)
      REFERENCES typeBien (codeTypeBien) ;


ALTER TABLE bien 
  ADD FOREIGN KEY fk_bien_proprietaire (idProprietaire)
      REFERENCES proprietaire (idProprietaire) ;


ALTER TABLE proprietaire 
  ADD FOREIGN KEY fk_proprietaire_typeProprietaire (codeTypeProprietaire)
      REFERENCES typeProprietaire (codeTypeProprietaire) ;


ALTER TABLE ville 
  ADD FOREIGN KEY fk_ville_pays (idPays)
      REFERENCES pays (idPays) ;


ALTER TABLE louer 
  ADD FOREIGN KEY fk_louer_bien (idBien)
      REFERENCES bien (idBien) ;


ALTER TABLE louer 
  ADD FOREIGN KEY fk_louer_client (id)
      REFERENCES client (id) ;

