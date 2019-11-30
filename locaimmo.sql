# -----------------------------------------------------------------------------
#       TABLE : TYPEBIEN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typeBien
 (
   id INTEGER(5) NOT NULL auto_increment  ,
   libelle VARCHAR(255) NULL  
   , PRIMARY KEY (id) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PAYS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS pays
 (
   id INTEGER(5) NOT NULL auto_increment ,
   nomPays VARCHAR(255) NULL  
   , PRIMARY KEY (id) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : BIEN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS bien
 (
   id INTEGER(5) NOT NULL auto_increment ,
   adresseBien VARCHAR(255) NULL  ,
   superficieBien INTEGER(4) NULL  ,
   nbPlaces INTEGER(2) NULL  
   , PRIMARY KEY (id) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PROPRIETAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS proprietaire
 (
   id INTEGER(5) NOT NULL auto_increment ,
   nomProprietaire VARCHAR(255) NULL  ,
   prenomProprietaire VARCHAR(255) NULL  ,
   mailProprietaire VARCHAR(255) NULL  ,
   mdpProprietaire VARCHAR(255) NULL  
   , PRIMARY KEY (id) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : VILLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ville
 (
   id INTEGER(5) NOT NULL auto_increment ,
   nomVille VARCHAR(255) NULL  ,
   codePostal VARCHAR(32) NULL  
   , PRIMARY KEY (id) 
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
   id INTEGER(5) NOT NULL auto_increment ,
   libelle VARCHAR(255) NULL  
   , PRIMARY KEY (id) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LOUER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS louer
 (
   id INTEGER(5) NOT NULL  ,
   dateArrivee VARCHAR(32) NULL  ,
   dateDepart VARCHAR(32) NULL  ,
   prix INTEGER(5) NULL  
   , PRIMARY KEY (id) 
 ) 
 comment = "";


