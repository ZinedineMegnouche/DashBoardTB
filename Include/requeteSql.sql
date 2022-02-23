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
