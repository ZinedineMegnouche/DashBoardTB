--- Ajout des postes 

INSERT INTO Poste(poste)
VALUES
('Commercial'),
('Producteur'),
('Chef de projet'),
('Ressource Humaines'),
('Administrateur')

--- Test ajout d'un membre du personnel

INSERT into TandB(nomComplet,mail,telephone,adresse,typeContrat,DateSignature,modeRestraint,idPoste)
VALUES ('Aissa Ouazine','aissa.ouazine@tickandbox.com','0766064694','rue Valenton','Alternance','2021/1/1',DEFAULT,5)

-- Entrer dans la session d'un membre du personnel
SELECT nomComplet FROM TandB WHERE idTB = 1

-- test Ajout d'un forfait
INSERT INTO Forfait(nomForfait,tarif,description)
VALUES('Visibilité',250,'Ofrre de base avec creation du site, image de marque, gestion des Réseaux sociaux')

--Test ajout de secteur d'activité
Insert INTO SecteurActivite(secteurActivite)
VALUES('Bar/Restaurant'),('Numérique'),('Automobile'),('Agriculteur'),('Bien-être'),('Loisir'),('Transport'),('Santé')

-- Test ajout d'un client
INSERT into Client(nomComplet,nomEntreprise,mail,telephone,localisation,adresse,dateSignature,dureeEngagement,MandatSEPA,CNI,RIB,contrat,siret,idForfait,idSecteur,idTB) 
values('Jean-Michel LECLIENT','JM ENTERPRISE','jean@michel.com','0601020304','Paris','1 avenue Champs-Elisée','2022/02/5',24,'lemandatsepa','lacni','lerib','lecontrat','12345678909876',1,2,1)

-- Test ajout connexion du client 1
INSERT INTO connexionClient(mailConnexion,motDePasse,idClient)
VALUES('jean@michel.com','12345',1)
