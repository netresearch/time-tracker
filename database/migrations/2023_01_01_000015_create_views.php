<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW `v_Datenexport` AS
            SELECT e.id, e.day AS Datum, e.start AS Start, e.end AS Ende, u.username AS Mitarbeiter
                , c.name AS Kunde, p.name AS Projekt, a.name AS `Tätigkeit`
                , e.description AS Beschreibung, e.ticket AS Fall
                , SEC_TO_TIME(ABS(e.duration * 60)) AS Dauer
                , 'x' AS `JIRA-Buchung`
            FROM entries e
            LEFT JOIN users u
                ON u.id = e.user_id
            LEFT JOIN customers c
                ON c.id = e.customer_id
            LEFT JOIN projects p
                ON p.id = e.project_id
            LEFT JOIN activities a
                ON a.id= e.activity_id
            ORDER BY u.id ASC, e.day ASC, e.start ASC;
        ");

        DB::statement("
            CREATE VIEW `v_DatenexportDieserMonat` AS
            SELECT * FROM v_Datenexport
            WHERE Datum >= DATE_FORMAT(CURDATE(), '%Y-%m-01');
        ");

        DB::statement("
            CREATE VIEW `v_DatenexportLetzterMonat` AS
            SELECT * FROM v_Datenexport
            WHERE Datum >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -1 MONTH), '%Y-%m-01')
            AND Datum < DATE_FORMAT(CURDATE(), '%Y-%m-01');
        ");

        DB::statement("
            CREATE VIEW `v_Projektsummen` AS
            SELECT YEAR(e.day) AS Jahr, MONTH(e.day) AS Monat, t.name AS Team
                , c.name AS Kunde, p.name AS Projekt
                , SEC_TO_TIME(SUM(ABS(e.duration * 60))) AS Gesamtdauer
            FROM entries e
            LEFT JOIN users u ON u.id = e.user_id
            LEFT JOIN teams_users tu ON tu.user_id = u.id
            LEFT JOIN teams t ON t.id=tu.team_id
            LEFT JOIN customers c ON c.id=e.customer_id
            LEFT JOIN projects p ON p.id=e.project_id
            WHERE (u.type='DEV' OR u.id = t.lead_user_id)
            GROUP BY YEAR(e.day), MONTH(e.day), e.customer_id, e.project_id, t.id;
        ");

        DB::statement("
            CREATE VIEW `v_DistinkteTagesProjekte` AS
            SELECT DISTINCT e.user_id, e.day, e.customer_id, e.project_id
            FROM entries e
            WHERE e.activity_id NOT IN (0, 9, 23, 25, 26,30,31,32,35);
        ");

        DB::statement("
            CREATE VIEW `v_ProjekteProTag` AS
            SELECT a.day AS Tag, u.username AS Mitarbeiter, COUNT(*) AS Projekte
            FROM v_DistinkteTagesProjekte a
            LEFT JOIN users u ON u.id=a.user_id
            WHERE u.id IS NOT NULL
            GROUP BY a.user_id, a.day;
        ");

        DB::statement("
            CREATE VIEW `v_ProjekteProTagJeMonat` AS
            SELECT YEAR(b.Tag) AS Jahr, MONTH(b.Tag) AS Monat, b.Mitarbeiter, AVG(b.Projekte) AS Projekte
            FROM v_ProjekteProTag b
            GROUP BY b.Mitarbeiter, YEAR(b.Tag), MONTH(b.Tag)
            ORDER BY Jahr DESC, Monat DESC, Mitarbeiter ASC;
        ");

        DB::statement("
            CREATE VIEW `v_ProjekteProTagJeMonatUndTeam` AS
            SELECT t.name AS Team, Jahr,Monat, AVG(Projekte) FROM `v_ProjekteProTagJeMonat` m
            LEFT JOIN users u ON m.Mitarbeiter=u.username
            LEFT JOIN teams_users tu ON tu.user_id=u.id
            LEFT JOIN teams t ON t.id=tu.team_id
            WHERE u.type = 'DEV'
            GROUP BY Team, Jahr,Monat ORDER BY Jahr ASC, Monat ASC, Team ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_ProjekteProTagJeMonatUndTeam`;");
        DB::statement("DROP VIEW IF EXISTS `v_ProjekteProTagJeMonat`;");
        DB::statement("DROP VIEW IF EXISTS `v_ProjekteProTag`;");
        DB::statement("DROP VIEW IF EXISTS `v_DistinkteTagesProjekte`;");
        DB::statement("DROP VIEW IF EXISTS `v_Projektsummen`;");
        DB::statement("DROP VIEW IF EXISTS `v_DatenexportLetzterMonat`;");
        DB::statement("DROP VIEW IF EXISTS `v_DatenexportDieserMonat`;");
        DB::statement("DROP VIEW IF EXISTS `v_Datenexport`;");
    }
};
