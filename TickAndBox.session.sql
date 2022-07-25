SELECT *
FROM Client
    inner join SecteurActivite on Client.idSecteur = SecteurActivite.idSecteur inner join Forfait on Client.idForfait = Forfait.idForfait
WHERE idClient = 2