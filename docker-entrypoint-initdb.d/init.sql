DO
$$
BEGIN
   IF NOT EXISTS (
      SELECT
      FROM   pg_catalog.pg_user
      WHERE  usename = 'october') THEN

      CREATE USER october WITH PASSWORD 'happyoctober';
   END IF;
END
$$;

DO
$$
BEGIN
   IF NOT EXISTS (
      SELECT
      FROM   pg_catalog.pg_database
      WHERE  datname = 'product_catalog') THEN

      CREATE DATABASE product_catalog OWNER october;
   END IF;
END
$$;