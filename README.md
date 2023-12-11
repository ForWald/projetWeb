Cloner à partir du dernier commit de la branche Main.

Installation :
Créer une base de données ‘projetweb’ (nom par défaut dans le .env)
Importer le fichier projetweb.sql
Dans le terminal du projet :
composer install
npm install --global yarn
yarn install
yarn add @symfony/webpack-encore -- dev
yarn add bootstrap
yarn add sass-loader@^13.0.0 sass --dev
yarn add file-loader@^6.0.0 --dev
yarn run build 
symfony serve

La procédure stockée n'est pas fonctionnelle avec MySql, uniquement avec PostGres, on est donc pas sûr de son fonctionnement avec le projet, mais en théorie elle devrait si elle était convertie en langage mysql. 
CREATE TRIGGER supp_seance BEFORE DELETE
ON seance
FOR EACH ROW
EXECUTE FUNCTION SuppSeanceAsso(); 
CREATE OR REPLACE FUNCTION SuppSeanceAsso() RETURNS TRIGGER AS $$
DECLARE
    programID INT;
    seanceID INT;
    restprog INT;
BEGIN
    -- Id du programme / seance
    SELECT p.id INTO programID
    FROM seance 
    INNER JOIN ordre_seance o ON OLD.id = o.seance_id
    INNER JOIN programme p ON o.programme_id = p.id;

    -- Supp ordres seance
    seanceID := OLD.id;
    DELETE FROM ordre_seance WHERE seance_id = seanceID;

    -- Supp ordres exercice/seance
    DELETE FROM ordre_exercice WHERE seance_id = seanceID;

    -- Vérif prog non vide
    restprog := 0;
    SELECT COUNT(*) INTO restprog
    FROM seance
    INNER JOIN ordre_seance o ON OLD.id = o.seance_id
    WHERE o.programme_id IS NOT NULL;

    IF restprog = 0 THEN
        DELETE FROM programme p
        WHERE p.id = programID;
    END IF;

    RETURN OLD;
END;
$$ LANGUAGE plpgsql;
