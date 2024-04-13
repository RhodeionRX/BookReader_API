<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION define_image_status_procedure() RETURNS trigger AS $$
            BEGIN
                IF (TG_OP = 'INSERT') THEN
                    IF EXISTS (SELECT 1 FROM book_images WHERE book_id = NEW.book_id AND status = 'Primary') AND NEW.status = 'Primary' THEN
                        UPDATE book_images
                        SET status = 'Additional'
                        WHERE book_id = NEW.book_id AND status = 'Primary';
                    ELSIF NOT EXISTS (SELECT 1 FROM book_images WHERE book_id = NEW.book_id AND status = 'Primary') AND NEW.status = 'Additional' THEN
                        NEW.status := 'Primary';
                    END IF;
                    RETURN NEW;
                END IF;

                IF (tg_op = 'UPDATE') THEN
                    IF (NEW.status = 'Primary' AND NEW.status IS DISTINCT FROM OLD.status) THEN
                        UPDATE book_images
                        SET status = 'Additional'
                        WHERE book_id = NEW.book_id AND status = 'Primary' AND id != NEW.id;
                    ELSIF (NEW.status = 'Additional' AND NEW.status IS DISTINCT FROM OLD.status) THEN
                        UPDATE book_images
                        SET status = 'Primary'
                        WHERE id = (
                            SELECT id
                            FROM book_images
                            WHERE book_id = NEW.book_id AND status = 'Additional' AND id != NEW.id
                            ORDER BY id
                            LIMIT 1
                        );
                    END IF;
                    RETURN NEW;
                END IF;

                IF (tg_op = 'DELETE') THEN
                    IF (OLD.status = 'Primary') THEN
                        UPDATE book_images
                        SET status = 'Primary'
                        WHERE id = (
                            SELECT id
                            FROM book_images
                            WHERE book_id = OLD.book_id AND status != 'Primary'
                            ORDER BY id
                            LIMIT 1
                        );
                    END IF;
                    RETURN OLD;
                END IF;
                RETURN NULL;
            END
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER define_image_status
                BEFORE INSERT OR DELETE OR UPDATE OF status ON book_images
                FOR EACH ROW
                WHEN (pg_trigger_depth() < 1)
                EXECUTE PROCEDURE define_image_status_procedure();"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS define_image_status ON book_images;
            DROP FUNCTION IF EXISTS define_image_status_procedure();"
        );
    }
};
